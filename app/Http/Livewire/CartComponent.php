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
    public $itemQuantities = [];



    public function mount(StorageInterface $storage, Meal $meal, Coupon $coupon)
    {
        $this->cart = new Cart($storage, $meal, $coupon);

            $this->subTotal = $this->cart->subTotal();
            $this->totalPriceAfterDiscount = $this->cart->totalPriceAfterDiscount();
            $this->calculateTotalDiscount = $this->cart->calculateTotalDiscount();

            $this->cartItems = $this->cart->all();
        foreach ($this->cartItems as $item) {
            $this->itemQuantities[$item->id] = $item->quantity;
        }
    }

    public function updateItemQuantity($itemId, $quantity)
    {
        $this->itemQuantities[$itemId] = $quantity;
    }

    public function itemTotalPrice($item)
    {
        $coupon = \App\Models\Coupon::find($item->coupon);

        if ($coupon) {
            if ($coupon->type === 'fixed') {
                return number_format($item->price * $item->quantity - $coupon->value, 2);
            } elseif ($coupon->type === 'percent') {
                return number_format($item->price * $item->quantity - ($coupon->value / 100) * ($item->price * $item->quantity), 2);
            }
        }

        return number_format($item->price * $item->quantity, 2);
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

    public function increaseQuantity($mealId, Coupon $coupon)
    {
        $meal = Meal::find($mealId);
        $cart = new Cart(new SessionStorage('cart'), $meal, $coupon);

        // Retrieve the meal from the cart
        $cartMeal = $cart->get($meal);

        // Update the quantity
        $updateItemResult = $cart->updateQty($meal, $cartMeal['quantity'] + 1);


        if ($updateItemResult) {
            $this->subTotal = $cart->subTotal();
            $this->cartItems = $cart->all();
        }
        if ($updateItemResult) {
            // Emit an event to update the quantity in real-time
            $this->emit('updateQuantity', $mealId, $cartMeal['quantity']);
        }
    }
    public function decreaseQuantity($mealId, Coupon $coupon)
    {
        $meal = Meal::find($mealId);
        $cart = new Cart(new SessionStorage('cart'), $meal, $coupon);

        // Retrieve the meal from the cart
        $cartMeal = $cart->get($meal);

        // Update the quantity
        $updateItemResult = $cart->updateQty($meal, $cartMeal['quantity'] - 1);


        if ($updateItemResult) {
            $this->subTotal = $cart->subTotal();
            $this->cartItems = $cart->all();
        }
        if ($updateItemResult) {
            // Emit an event to update the quantity in real-time
            $this->emit('updateQuantity', $mealId, $cartMeal['quantity']);
        }
    }







    public function render()
    {

        return view('livewire.cart-component')->layout('layouts.font-layout');
    }
}
