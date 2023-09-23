<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Models\admin\Admin;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\providers\Meal;
use App\Models\Shipping;
use App\Notifications\NewOrderForProviderNotify;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Mockery\Exception;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class CheckoutComponent extends Component
{
    public $firstname;
    public $lastname;
    public $province;
    public $address;
    public $city;
    public $latitude;
    public $longitude;
    public $zipcode;
    public $mobile;
    public $email;
    public $subTotal;

    public $discount;
    public $payMethod;
    public $ship_to_different;

    public $showInput = false;
    public $paymentIntentId;




    public $d_firstname;
    public $d_lastname;
    public $d_province;
    public $d_address;
    public $d_city;
    public $d_zipcode;
    public $d_mobile;
    public $d_email;

    protected $listeners = ['placeOrder'];

    protected $cart;
    public $cartItems;
    public $removeItem;


    public function mount(StorageInterface $storage, Meal $meal, Coupon $coupon)
    {
        $this->cart = new Cart($storage, $meal, $coupon);

        $this->subTotal = $this->cart->subTotal();

        $this->cartItems = $this->cart->all();
    }


    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ];
    }



    public function updatedPayMethod($value)
    {
        if ($value === 'cash') {
            $this->showInput = false;
        } else {
            $this->showInput = true;
        }
    }

    public function placeOrder(Meal $meal, Coupon $coupon)
    {

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $amountInCents = intval($this->subTotal * 100);

            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amountInCents,
                'currency' => 'usd',
            ]);
            $this->paymentIntentId = $intent->client_secret;
        } catch (ApiErrorException $e) {
            session()->flash('stripe_error', $e->getMessage());
        }

        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);


        $this->createOrder();

        if($this->ship_to_different)
        {
            $this->shipToDifferent();
        }

        $cart = new Cart(new SessionStorage('cart'), $meal, $coupon);

        $this->processPayment($cart);
        notify()->success('Checkout successfully message');
        $this->resetForm();
    }
    private function createOrder()
    {
        try {

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->subtotal = $this->subTotal ?? 0;
            $order->discount = session()->get('checkout')['discount'] ?? 0;
            $order->tax = 0;
            $order->total = $this->subTotal;
            $order->firstname = $this->firstname;
            $order->lastname = $this->lastname;
            $order->province = $this->province;
            $order->address = $this->address;
            $order->city = $this->city;
            $order->zipcode = $this->zipcode;
            $order->email = $this->email;
            $order->mobile = $this->mobile;
            $order->latitude = $this->latitude;
            $order->longitude = $this->longitude;
            $order->status = 'ordered';
            $order->is_shipping_different = $this->ship_to_different ? 1 : 0;
            $order->save();
            $data = ['order_id' => $order->id];
            //Pusher::trigger('order-orders', 'new-order', $data);

            $admin = Admin::where('id', 1)->first();


            foreach ($this->cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->meal_id = $item['id'] ?? ''; // Access 'id' from the array
                $orderItem->order_id = $order->id;
                $orderItem->price = $item['price']; // Access 'price' from the array
                $orderItem->quantity = $item['quantity']; // Access 'quantity' from the array

                $orderItem->save();
                if ($orderItem) {
                    $admin->notify(new NewOrderForProviderNotify($orderItem));
                }
            }

        }catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return $exception;
        }
    }

    private function shipToDifferent()
    {
        $shipping = new Shipping();
        $shipping->firstname = $this->d_firstname;
        $shipping->lastname = $this->d_lastname;
        $shipping->province = $this->d_province;
        $shipping->address = $this->d_address;
        $shipping->city = $this->d_city;
        $shipping->zipcode = $this->d_zipcode;
        $shipping->email = $this->d_email;
        $shipping->mobile = $this->d_mobile;
    }

    private function processPayment($cart)
    {
        try {

            $cart->clear();
            if (session()->has('coupon')) {
                $coupon = Coupon::where('code', session()->get('coupon')['name'])->first();
                if ($coupon) {
                    $coupon->times_used = $coupon->times_used + 1;
                    $coupon->save();
                }
            }
        }catch (Exception $e){
            return $e;
        }
    }

    public function resetForm()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->province = '';
        $this->address = '';
        $this->city = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->zipcode = '';
        $this->mobile = '';
        $this->email = '';

        if ($this->ship_to_different) {
            $this->d_firstname = '';
            $this->d_lastname = '';
            $this->d_province = '';
            $this->d_address = '';
            $this->d_city = '';
            $this->d_zipcode = '';
            $this->d_mobile = '';
            $this->d_email = '';
        }
    }

    public function render()
    {
        return view('livewire.checkout-component')->layout('layouts.font-layout');
    }
}
