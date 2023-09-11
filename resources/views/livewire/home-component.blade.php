@push('styles')
    <style>
        .single-banner-slide {
            height: 470px;
            width: 851px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }
        .single-banner-slide span {
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
        }
        .single-banner-slide h2 {
            color: #fff;
            text-transform: uppercase;
            font-size: 60px;
        }
        .single-banner-slide::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
            width: 100%;
            height: 100%;
        }
        .single-banner-slide p {
            color: #fff;
            font-size: 15px;
            max-width: 50%;
            margin: 0 auto;
            text-align: center;
        }
        .single-banner-slide a {
            color: #000;
            background: #fff;
            padding: 10px 45px;
            border-radius: 100px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            margin-top: 30px;
            transition: 0.3s;
        }
        .single-banner-slide a:hover {
            color: #fff;
            background: #000;
        }
        .owl-dots {
            display: none !important;
        }
    </style>
@endpush
<div>

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Courts</span>
                        </div>
                        <ul>
                            @foreach($providers as $provider)
                                <li><a href="{{route('restaurant.details', ['slug'=> Str::slug($provider->name)])}}">{{$provider->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+20 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero__item set-bg"{{-- data-setbg="{{asset('assets/img/hero/main.jpg')}}"--}}>
                        <section class="banner-area">
                            <div class="container">
                                <div class="all-banner-slide owl-carousel">
                                    <div class="single-banner-slide" style="background-image: url(assets/img/hero/main.jpg);">
                                        <span>Discover The Colorful World</span>
                                        <h2>New Experience</h2>
                                        <p>the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                        <a href="#">Discover Now</a>
                                    </div>
                                    <div class="single-banner-slide" style="background-image: url(assets/img/hero/hero-2.jpg);">
                                        <span>Discover The Colorful World</span>
                                        <h2>New Experience</h2>
                                        <p>the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                        <a href="#">Discover Now</a>
                                    </div>
                                    <div class="single-banner-slide" style="background-image: url(assets/img/hero/hero-3.jpg);">
                                        <span>Discover The Colorful World</span>
                                        <h2>New Experience</h2>
                                        <p>the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                        <a href="#">Discover Now</a>
                                    </div>
                                    <div class="single-banner-slide" style="background-image: url(assets/img/hero/hero-4.jpg);">
                                        <span>Discover The Colorful World</span>
                                        <h2>New Experience</h2>
                                        <p>the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                        <a href="#">Discover Now</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        {{--<div class="hero__text">
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($providers as $provider)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{asset($provider->logo)}}">
                                <h5><a href="{{route('restaurant.details', ['slug'=> Str::slug($provider->name)])}}"">{{$provider->name}}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Meal</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach($providers as $provider)
                                <li data-filter=".{{Str::slug($provider->name)}}">{{$provider->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($meals as $meal)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5 h-100 mix {{Str::slug($meal->provider->name)}}">
                        <div class="card card-span h-100 rounded-3">
                            <a href="{{route('meals.details', ['slug'=>$meal->slug])}}">
                                <img class="img-fluid rounded-3 h-100" src="{{$meal->image}}" alt="..." />
                            </a>
                            <div class="card-body ps-0">
                                <a href="{{route('meals.details', ['slug'=>$meal->slug])}}">
                                <h5 class="fw-bold text-1000 text-truncate mb-1">Cheese Burger</h5>
                                </a>
                                <div><span class="text-warning me-2">
                                        <i class="fas fa-map-marker-alt"></i></span>
                                    <span class="text-primary">
                                        <a href="{{route('restaurant.details', ['slug'=> Str::slug($meal->provider->name)])}}">
                                        {{$meal->provider->name}}
                                        </a>
                                    </span>

                                </div>
                                <span class="text-1000 fw-bold">$3.88</span>
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
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('assets/img/banner/main.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <livewire:latest-products-component />
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

</div>
@push('scripts')
    <script>
        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: false,
            dots: true
        });

    </script>

@endpush
