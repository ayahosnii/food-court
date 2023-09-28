<?php

namespace App\Http\Controllers\admin;

use App\Exports\InvoicesExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
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
    public function exportPendingInvoice()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }


    public function pended()
    {
        $orders = Order::where('status', 'ordered')->paginate();
        return view('admin.orders.pended', compact('orders'));
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

    public function track()
    {
        return view('admin.orders.track');
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
