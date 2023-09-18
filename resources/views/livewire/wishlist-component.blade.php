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
    @livewire('hero-section', ['title' => 'Wishlist', 'pageName' => 'Wishlist'])
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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($UserFavorites as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style="width: 80px; height: 100px" src="{{ asset($item->meal->image) }}" alt="{{ $item->meal->name }}">
                                        <h5>{{ $item->meal->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ $item->meal->price }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <button wire:click="removeFromCart({{ $item->meal->id }})" class="btn btn-outline-success mx-5">Add To Cart <li class="fa fa-truck"></li></button>
                                        <button wire:click="removeFromCart({{ $item->meal->id }})" class="fa fa-trash"></button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <x-notify::notify />
</div>
