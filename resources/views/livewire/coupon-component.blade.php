<div>
    <div class="shoping__discount">
        <h5>Discount Codes</h5>
        <form action="#">
            <input wire:model="couponCode" type="text" placeholder="Enter your coupon code">
            <button wire:click.prevent="applyCouponCode" class="site-btn">APPLY COUPON</button>
        </form>
    </div>
    <x-notify::notify />
</div>
