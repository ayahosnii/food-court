<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Models\Coupon;
use App\Models\providers\Meal;
use App\Support\Storage\Contracts\StorageInterface;
use Livewire\Component;

class YourOrderComponent extends Component
{
    protected $cart;
    public $cartItems;

    public function mount(StorageInterface $storage, Meal $meal, Coupon $coupon)
    {
        $this->cart = new Cart($storage, $meal, $coupon);

        $this->subTotal = $this->cart->subTotal();

        $this->cartItems = $this->cart->all();
    }
    public function render()
    {
        return view('livewire.your-order-component');
    }
}
