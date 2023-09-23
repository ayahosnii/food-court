<div>
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                 @livewire('all-courts')
                <div class="col-lg-9">
                    @livewire('header-search-component')
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    @livewire('hero-section', ['title' => 'Shopping Cart', 'pageName' => 'Shopping Cart'])
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style="width: 80px; height: 100px" src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                                        <h5>{{ $item->name }} {{ \App\Models\Coupon::find($item->coupon)->value ?? 0 }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ $item->price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <a href="javascript:void(0)" class="minus-btn text-black" wire:click.prevent="decreaseQuantity({{ $item }})">-</a>
                                            <input style="background-color: #f5f5f5;" readonly value="{{ $item['quantity'] }}" type="text" name="quantity">
                                            <a href="javascript:void(0)" class="plus-btn text-black" wire:click.prevent="increaseQuantity({{ $item }})">+</a>
                                        </div>
                                    </td>


                                    <td class="shoping__cart__total">
                                        {{$this->itemTotalPrice($item)}}

                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <button wire:click="removeFromCart({{ $item }})" class="icon_close">
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <livewire:coupon-component />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{ $subTotal }}</span></li>
                            <li>Discount <span>${{ $calculateTotalDiscount }}</span></li>
                            <li>Total <span>${{ $totalPriceAfterDiscount }}</span></li>
                        </ul>
                        <a href="{{route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <x-notify::notify />
</div>
