<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;

class CouponComponent extends Component
{
    public $couponCode;

    public $discount = 0;
    public $haveCouponCode;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;


    public function applyCouponCode()
    {

        $coupon = Coupon::where('code', $this->couponCode)->first();

        if (!$coupon) {
            notify()->error('Invalid coupon code.');

            return;
        }

        if (!$coupon->isValid(Cart::instance('cart'))) {
            $this->addError('couponCode', 'This coupon cannot be applied to the current cart.');
            return;
        }

        if (session()->get('coupon_applied')) {
            return;
        }

        $discount = $coupon->discount(Cart::instance('cart')->subtotal());

        Cart::instance('cart')->content()->each(function ($item) use ($discount) {
            $item->price -= $discount / Cart::instance('cart')->count();
        });

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::instance('cart')->subtotal()),
        ]);

        session()->put('coupon_applied', true);

        $this->emit('couponApplied');
    }

    public function render()
    {
        return view('livewire.coupon-component');
    }
}
