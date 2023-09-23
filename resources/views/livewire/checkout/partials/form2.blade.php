@if ($ship_to_different)
    <div class="col-lg-8 col-md-6">
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>First Name<span>*</span></p>
                    <input name="d_firstname" type="text" wire:model="d_firstname">
                    @error('d_firstname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Last Name<span>*</span></p>
                    <input name="d_lastname" type="text" wire:model="d_lastname">
                    @error('d_lastname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="checkout__input">
            <p>Country<span>*</span></p>
            <input name="d_country" type="text" wire:model="d_country">
            @error('d_country') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="checkout__input">
            <p>Address<span>*</span></p>
            <input name="d_address" type="text" placeholder="Street Address" class="checkout__input__add" wire:model="d_address">
            @error('d_address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="checkout__input">
            <p>Town/City<span>*</span></p>
            <input name="d_city" type="text" wire:model="d_city">
            @error('d_city') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="checkout__input">
            <p>Country/State<span>*</span></p>
            <input name="d_state" type="text" wire:model="d_state">
            @error('d_state') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="checkout__input">
            <p>Postcode / ZIP<span>*</span></p>
            <input name="d_zipcode" type="text" wire:model="d_zipcode">
            @error('d_zipcode') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Phone<span>*</span></p>
                    <input name="d_mobile" type="text" wire:model="d_mobile">
                    @error('d_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Email<span>*</span></p>
                    <input name="d_email" type="text" wire:model="d_email">
                    @error('d_email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="checkout__input__checkbox">
            <label for="d-acc">
                Create an account for different address?
                <input type="checkbox" id="d-acc">
                <span class="checkmark"></span>
            </label>
        </div>
{{--        <p>Create an account for the different address by entering the information below.</p>--}}
{{--        <div class="checkout__input">--}}
{{--            <p>Account Password<span>*</span></p>--}}
{{--            <input name="d_password" type="password" wire:model="d_password">--}}
{{--            @error('d_password') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--        </div>--}}

{{--        <div class="checkout__input">--}}
{{--            <p>Order notes for different address<span>*</span></p>--}}
{{--            <input name="d_order_notes" type="text" placeholder="Notes about your order, e.g. special notes for delivery." wire:model="d_order_notes">--}}
{{--            @error('d_order_notes') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--        </div>--}}
    </div>
@endif
