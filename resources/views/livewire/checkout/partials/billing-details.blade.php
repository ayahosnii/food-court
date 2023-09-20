<div class="col-lg-4 col-md-6">
    <div class="checkout__order">
        <h4>Your Order</h4>
        <div class="checkout__order__products">Products <span>Total</span></div>
        <ul>
            <livewire:your-order-component />
        </ul>
        <div class="checkout__order__subtotal">Subtotal <span>${{ $subTotal }}</span></div>
        <div class="checkout__order__total">Total <span>${{ $subTotal }}</span></div>
        <div class="checkout__input__checkbox">
            <label for="acc-or">
                Create an account?
                <input type="checkbox" id="acc-or">
                <span class="checkmark"></span>
            </label>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
            ut labore et dolore magna aliqua.</p>
        <div class="checkout__input__checkbox">
            <label for="payment">
                Check Payment
                <input type="checkbox" id="payment">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="checkout__input__checkbox">
            <label for="paypal">
                Paypal
                <input type="checkbox" id="paypal">
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
</div>
