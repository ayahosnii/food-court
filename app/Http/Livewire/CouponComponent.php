<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Models\Coupon;
use App\Models\providers\Meal;
use App\Support\Storage\SessionStorage;
use Livewire\Component;

class CouponComponent extends Component
{
    public $couponCode;
    public $discount = 0;
    public $haveCouponCode;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function applyCouponCode(Meal $meal)
    {
        $coupon = Coupon::where('code', $this->couponCode)->first();

        if (!$coupon) {
            notify()->error('Invalid coupon code.');
            return;
        }

        $meals = $coupon->meals;
        $cart = new Cart(new SessionStorage('cart'), $meal, $coupon);

        if ($meals->isEmpty()) {
            notify()->error('Invalid product associated with the coupon.');
            return;
        }

        // Add the coupon to the cart with an optional coupon ID
        $result = $cart->addCoupon($coupon, $coupon->id);

        if ($result) {
            $this->subTotal = $cart->subTotal();
            $this->cartItems = $cart->all();
            $this->discount = $coupon->discount_amount;

            // Notify that the coupon was applied successfully
            notify()->success('Coupon applied successfully.');
        } else {
            notify()->error('Coupon could not be applied.');
        }

        $this->emit('couponApplied');
    }

    public function render()
    {
        return view('livewire.coupon-component');
    }
}
