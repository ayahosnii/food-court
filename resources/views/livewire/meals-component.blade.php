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
    @livewire('hero-section', ['title' => 'All Meals', 'pageName' => 'Meals'])

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5"  style="padding-top: 30px">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>SortBy: Provider</h4>
                            <ul>
                                @foreach($providers as $provider)
                                    <li>
                                        <input wire:model="filterProviders" value="{{$provider->id}}" type="checkbox">{{$provider->name}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>SortBy: Categories</h4>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <input type="checkbox" wire:model="categoryInputs" value="{{$category->id}}">
                                        {{$category->name}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-filter">
                                <div class="sidebar-widget price_range range">
                                    <div class="widget-header position-relative mb-20 pb-10">
                                        <h5 class="widget-title mb-10">Filter by price</h5>
                                        <div class="bt-1 border-color-1"></div>
                                    </div>
                                    <div class="price-filter">
                                        <div class="price-filter-inner">
                                            <div id="slider-range" wire:model="price_range" wire:change="filterByPrice" wire:ignore></div>
                                            <div class="price_slider_amount">
                                                <div class="label-input">
                                                    <span>Range:</span>
                                                    <div class="row">
                                                        <div class="col-md-3 mx-2 px-2">
                                                            <input class="text-warning" wire:model="min_price" readonly>
                                                        </div>
                                                        <div class="col-md-3 mx-2">
                                                            <input class="text-warning" wire:model="max_price" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <livewire:latest-products-component />
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select wire:model="sorting">
                                        <option value="featured">Featured</option>
                                        <option value="bestseller">Best selling</option>
                                        <option value="alphabet">Alphabetically, A-Z</option>
                                        <option value="alphabet-desc">Alphabetically, Z-A</option>
                                        <option value="price">Price, low to high</option>
                                        <option value="price-desc">Price, high to low</option>
                                        <option value="date-desc">Date new to old</option>
                                        <option value="date">Date old to new</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{$meals->count()}}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($meals as $meal)
                            <div class="col-lg-4 col-md-4 col-sm-6 mb-5 h-100 mix {{$meal->category->slug}} fresh-meat">
                                <div class="card card-span h-100 rounded-3">
                                    <li
                                        id="favorite-toggle-{{$meal->slug}}"
                                        wire:click="toggleFavorite('{{$meal->slug}}')"
                                        class="fa fa-heart {{$meal->isInFavorites() ? 'favorite' : ''}}"
                                        data-slug="{{$meal->slug}}"
                                    ></li>
                                    <a href="{{route('meals.details', ['slug'=>$meal->slug])}}">
                                        <img class="img-fluid rounded-3 h-100" src="{{$meal->image}}" alt="..." />
                                    </a>
                                    <div class="card-body ps-0">
                                        <a href="{{route('meals.details', ['slug'=>$meal->slug])}}">
                                        <h5 class="fw-bold text-1000 text-truncate mb-1">{{$meal->name}}</h5>
                                        </a>
                                        <div><span class="text-warning me-2">
                                        <i class="fas fa-map-marker-alt"></i></span>
                                            <a href="{{route('restaurant.details', ['slug'=> Str::slug($meal->provider->name)])}}">
                                            <span class="text-primary">{{$meal->provider->name}}</span>
                                            </a>
                                        </div>
                                        @if ($meal->sales->isNotEmpty())
                                            <span class="text-1000 fw-bold"><del>${{$meal->price}}</del></span>
                                            <span class="text-1000 fw-bold">${{ number_format($meal->price * (100 - $meal->sales->first()->percentage) / 100, 2) }}</span>
                                        @else
                                            <span class="text-1000 fw-bold">${{$meal->price}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <a class="btn btn-lg btn-danger" href="#" role="button" wire:click.prevent="addToCart('{{$meal->slug}}')">
                                        Order now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="product__pagination">
                        {{ $meals->links() }}
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-notify::notify />
</div>
@push('scripts')
    <script>
        var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 0,
                max: 1000,
                values: [0, 1000],
                slide: function(event, ui) {
                @this.set('min_price', ui.values[0]);
                @this.set('max_price', ui.values[1]);
                }
            });
        });
    </script>

@endpush

