<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Models\Coupon;
use App\Models\providers\Meal;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Livewire\Component;

class CartComponent extends Component
{
    protected $cart;
    public $qty;
    public $subTotal;
    public $cartItems;
    public $removeItem;


    public function mount(StorageInterface $storage, Meal $meal, Coupon $coupon)
    {
        $this->cart = new Cart($storage, $meal, $coupon);

            $this->subTotal = $this->cart->subTotal();

            $this->cartItems = $this->cart->all();
     }

        public function getCartProperty()
        {
            return $this->cart;
        }

    public function removeFromCart(Meal $meal, Coupon $coupon)
    {
        $cart = new Cart(new SessionStorage('cart'), $meal, $coupon);

        $removeItemResult = $cart->remove($meal);

        if ($removeItemResult) {
            $this->subTotal = $cart->subTotal();
            $this->cartItems = $cart->all();
        }
    }

    public function increaseQuantity(Meal $meal)
    {
        $cart = new Cart(new SessionStorage('cart'), $meal);
        $updateItemResult = $cart->update($meal, $cart->get($meal)['quantity'] + 1);

        if ($updateItemResult) {
            $this->subTotal = $cart->subTotal();
            $this->cartItems = $cart->all();
        }
    }

    public function decreaseQuantity(Meal $meal)
    {
        $cart = new Cart(new SessionStorage('cart'), $meal);
        $updateItemResult = $cart->update($meal, $cart->get($meal)['quantity'] - 1);

        if ($updateItemResult) {
            $this->subTotal = $cart->subTotal();
            $this->cartItems = $cart->all();
        }
    }




    public function render()
    {

        return view('livewire.cart-component')->layout('layouts.font-layout');
    }
}
