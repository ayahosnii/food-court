<?php

namespace App\Http\Controllers\admin;

use App\Cart\Cart;
use App\Exports\InvoicesExport;
use App\Http\Controllers\Controller;
use App\Models\admin\MealRawMaterial;
use App\Models\admin\RawMaterial;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\providers\Meal;
use App\Models\RawMaterialInventory;
use App\Responses\ViewResponses\TrackOrderViewResponse;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function __construct(StorageInterface $storage, Meal $meal, Coupon $coupon)
    {
        $this->cart = new Cart($storage, $meal, $coupon);
    }

    public function recordOrderForm()
    {
        $default_lang = get_default_language();
        $products = Meal::select()->paginate(3);
        return view('admin.orders.record-form',  compact('products'));
    }

    public function addToCart(Request $request, Meal $meal, Coupon $coupon)
    {
        $cart = new Cart(new SessionStorage('cart'), $meal, $coupon);
        try {
            $cart->add($request->meal_id, $request->input('quantity', 1));
        }catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function recordOrder(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            ]);

        // Create a new order record
        $order = new Order($data);
        $order->status = 'ordered';
        $order->order_type = 'offline';
        $order->is_shipping_different = false;
        $order->user_id = Auth::user()->id;
        $order->subtotal = $this->subTotal ?? 0;
        $order->discount = session()->get('checkout')['discount'] ?? 0;
        $order->tax = 0;
        $order->total = $this->subTotal ?? 0;

        $order->firstname = 'ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $order->lastname = 'offline client';
        $order->email = $request->email;
        $order->mobile = $request->mobile;
        $order->latitude = $request->latitude;
        $order->longitude = $request->longitude;
        $order->status = 'ordered';
        $order->order_type = 'online';
        $order->is_shipping_different = $this->ship_to_different ? 1 : 0;
        $order->save();

        return redirect()->route('order.success')->with('success', 'Order recorded successfully!');
    }
    public function details($id)
    {
        $order = Order::find($id);
        return view('admin.orders.details', compact('order'));
    }

    public function exportInvoice($orderId)
    {
        $order = Order::find($orderId);
        $pdf = PDF::loadView('admin.orders.details', ['order' => $order]);

        return $pdf->download('invoice.pdf');
    }
    public function exportPendingInvoice(Request $request)
    {
        return Excel::download(new InvoicesExport($request->month), 'invoices.xlsx');
    }


    public function pended()
    {
        $orders = Order::where('status', 'ordered')->paginate();
        return view('admin.orders.pended', compact('orders'));
    }

    public function confirmAccount($id)
    {
        $order = Order::where('status', 'cooked')->with('orderItems')->find($id);

        if (!$order) {
            return 'There is no order to confirm';
        }

        if ($order->confirm_account === 1){

            dd('You already confirmed');
        }else{
            $mealRawMaterials = collect(); // Initialize an empty collection

            foreach ($order->orderItems as $item) {
                $mealRawMaterialsForItem = MealRawMaterial::with('meal', 'rawMaterial')->where('meal_id', $item->meal_id)->get();
                $mealRawMaterials = $mealRawMaterials->concat($mealRawMaterialsForItem);
            }

            $rawMaterials = [];

            foreach ($mealRawMaterials as $mealRawMaterial) {
                $mealId = $mealRawMaterial->meal_id;
                $rawMaterial = RawMaterial::with(['mealRawMaterials' => function ($query) use ($mealId) {
                    $query->where('meal_id', $mealId);
                }])->find($mealRawMaterial->raw_material_id);

                if ($rawMaterial) {
                    $rawMaterials[] = $rawMaterial;
                }
            }
        }

        return view('admin.orders.confirm-account', compact('order', 'rawMaterials', 'mealRawMaterials', 'id'));
    }

    public function confirmAccountPost(Request $request)
    {
        $orderId = $request->input('orderId');
        $rawMaterialIds = $request->input('rawMaterialId');
        $newTotalWeights = $request->input('new_total_weight');

        $order = Order::find($orderId);

        if (!$order) {
            // Handle the case where the order is not found.
        }

        // Update the "confirm_account" value to true.
        $order->confirm_account = true;
        $order->save();

        // Update the "total_weight" in RawMaterialInventory for each raw material.
        foreach ($rawMaterialIds as $key => $rawMaterialId) {
            $rawMaterial = RawMaterial::find($rawMaterialId);

            if ($rawMaterial) {
                $rawMaterial->inventory->total_weight = $newTotalWeights[$key];
                $rawMaterial->inventory->save();
            }
        }
    }


    public function cooked()
    {
        $orders = Order::where('status', 'cooked')->where('confirm_account', 0)->paginate();
        return view('admin.orders.cooked', compact('orders'));
    }
    public function confirmedAccountOrders()
    {
        $orders = Order::where('status', 'cooked')->where('confirm_account', 1)->paginate();
        return view('admin.orders.conformed-orders', compact('orders'));
    }
      public function delivered()
    {
        $orders = Order::where('status', 'delivered')->paginate();
        return view('admin.orders.delivered', compact('orders'));
    }
      public function shipped()
    {
        $orders = Order::where('status', 'shipped')->paginate();
        return view('admin.orders.shipped', compact('orders'));
    }
    public function canceled()
    {
        $orders = Order::where('status', 'canceled')->paginate();
        return view('admin.orders.canceled', compact('orders'));
    }

    public function all()
    {
        $orders = Order::paginate();
        return view('admin.orders.all', compact('orders'));
    }

    public function trackOrder(string $token): Responsable
    {
        return app(TrackOrderViewResponse::class, ['token' => $token]);
    }

    public function show()
    {
        return view('admin.orders.show');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        $status = $request->input('status');
        $order->status = $status;
      $order->save();

      return response()->json(['success' => 'true']);
    }
}
