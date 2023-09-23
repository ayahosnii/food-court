<div class="col-lg-8 col-md-6">
    <div class="row">
        <div class="col-lg-6">
            <div class="checkout__input">
                <p>First Name<span>*</span></p>
                <input name="firstname" type="text" wire:model="firstname">
                @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="checkout__input">
                <p>Last Name<span>*</span></p>
                <input name="lastname" type="text" wire:model="lastname">
                @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="checkout__input">
        <select name="province" id="province" wire:model="province" onChange="showMap(event)">
            <optgroup label="Select a province">
                <option selected="true" style='display: none'></option>
                <option value="cairo">Cairo</option>
                <option value="alexandria">Alexandria</option>
                <option value="luxor">Luxor</option>
                <option value="aswan">Aswan</option>
            </optgroup>
        </select>
        @error('province') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="checkout__input">
        <p>Address<span>*</span></p>
        <input id="address" type="text" placeholder="Street Address" class="checkout__input__add" wire:model="address">
        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="checkout__input">
        <p>Town/City<span>*</span></p>
        <input type="text" wire:model="city">
        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="checkout__input">
        <p>State<span>*</span></p>
        <input name="state" type="text" wire:model="province">
        @error('state') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="checkout__input">
        <p>Postcode / ZIP<span>*</span></p>
        <input type="text" wire:model="zipcode">
        @error('zipcode') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="checkout__input">
                <p>Phone<span>*</span></p>
                <input type="text" wire:model="mobile">
                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="checkout__input">
                <p>Email<span>*</span></p>
                <input type="text" wire:model="email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <ul class="billing-ul" onload="getLocation()">
        <div id="map" style="height: 500px; display: none;" wire:ignore></div>
        <p>
            Latitude: <span id="lati"></span>
        </p>
        <p>
            Longitude: <span id="longi"></span>
        </p>

        <input type="text" name="latitude" placeholder="Latitude" wire:model="latitude">
        @error('latitude') <span class="error">{{ $message }}</span> @enderror
        <input type="text"  name="longitude" placeholder="Longitude" wire:model="longitude">
        @error('longitude') <span class="error">{{ $message }}</span> @enderror
        <p id="address-display"></p>
        <button id="add-address-btn" type="button">Add Address</button>
    </ul>


    <div class="checkout__input__checkbox">
        <label for="acc">
            Create an account?
            <input type="checkbox" id="acc">
            <span class="checkmark"></span>
        </label>
    </div>
    <p>Create an account by entering the information below. If you are a returning customer
        please login at the top of the page</p>
{{--    <div class="checkout__input">--}}
{{--        <p>Account Password<span>*</span></p>--}}
{{--        <input type="text">--}}
{{--    </div>--}}
    <div class="checkout__input__checkbox">
        <label for="diff-acc">
            Ship to a different address?
            <input type="checkbox" id="diff-acc" wire:model="ship_to_different">
            <span class="checkmark"></span>
        </label>
    </div>
{{--    <div class="checkout__input">--}}
{{--        <p>Order notes<span>*</span></p>--}}
{{--        <input type="text"--}}
{{--               placeholder="Notes about your order, e.g. special notes for delivery.">--}}
{{--    </div>--}}
</div>
