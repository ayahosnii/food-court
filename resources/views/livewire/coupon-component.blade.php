<div>
    <div class="shoping__discount">
        <h5>@lang('site.discount-codes')</h5>
        <form action="#">
            <input wire:model="couponCode" type="text" placeholder="@lang('site.enter-coupon-code')">
            <button wire:click.prevent="applyCouponCode" class="site-btn">@lang('site.apply-coupon')</button>
        </form>
    </div>
    <x-notify::notify />
</div>
