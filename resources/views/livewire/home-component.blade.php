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
            font-size: 30px;
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

        /* deal of the day css */
        .home-countdown1 .back-img{
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            align-items: center;
            display: flex;
            height: 450px;
        }
        .home-countdown1 .back-img .deal-content{
            max-width: 427px;
        }
        .home-countdown1 .back-img .deal-content h2{
            color: #040404;
            line-height: 1;
        }
        .home-countdown1 .back-img .deal-content span.deal-c{
            color: #040404;
        }
        .home-countdown1 .back-img .deal-content span.deal-c{
            color: #fff;
            font-size: 16px;
            margin-top: 19px;
            font-weight: 500;
        }
        /* timer */
        .home-countdown1 .back-img .deal-content ul.contdown_row{
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: 23px;
        }
        .home-countdown1 .back-img .deal-content ul.contdown_row li.countdown_section{
            background-color: #55724f;
            position: relative;
            width: 70px;
            height: 70px;
            margin-right: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .home-countdown1 .back-img .deal-content ul.contdown_row li.countdown_section:after{
            content: ":";
            position: absolute;
            right: -13px;
            bottom: 50%;
            transform: translateY(50%);
            color: #fff;
            font-size: 22px;
            font-weight: 600;
        }
        .home-countdown1 .back-img .deal-content ul.contdown_row li.countdown_section:last-child:after{
            display: none;
        }
        .home-countdown1 .back-img .deal-content ul.contdown_row li.countdown_section span.countdown_timer{
            color: #fff;
            font-size: 22px;
            font-weight: 600;
        }
        .home-countdown1 .back-img .deal-content ul.contdown_row li.countdown_section span.countdown_title{
            color: #fff;
            text-align: center;
            font-size: 12px;
            font-weight: 400;
            text-transform: uppercase;
            display: inline-block;
        }
        .home-countdown1 .back-img .deal-content a{
            margin-top: 30px;
        }
        .home-countdown1 .back-img .deal-content a:hover {
            color: #fff;
        }

        home-countdown1 .back-img .deal-content h2 {
            font-size: 30px;
            color: #040404;
            line-height: 1;
        }

        .btn-style1 {
            color: #fff;
            font-size: 14px;
            padding: 10px 30px;
            background-color: #735845;
            font-weight: 600;
            border: 2px solid #735845;
            border-radius: 25px;
        }
    </style>
@endpush
<div>


    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                @livewire('all-courts')
                <div class="col-lg-9">
                    @livewire('header-search-component')

                    <div class="hero__item set-bg"{{-- data-setbg="{{asset('assets/img/hero/main.jpg')}}"--}}>
                        <section class="banner-area">
                            <div class="container">
                                <div class="all-banner-slide owl-carousel">
                                    @foreach($banners as $banner)
                                        <div class="single-banner-slide" style="background-image: url({{ asset('assets/img/hero/' . $banner->background_image) }});">
                                            <h2>{{$banner->title}}</h2>
                                            <p>
                                                {{$banner->description}}
                                            </p>
                                            <a href="{{route('reservation')}}">Book Now!</a>
                                        </div>
                                    @endforeach
                                    </div>
                            </div>
                        </section>
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
                    @foreach($mainCategories as $mainCategory)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{asset($mainCategory->photo)}}">
                                <h5><a href="{{route('main.category', ['slug'=> $mainCategory->slug])}}">{{$mainCategory->name}}</a></h5>
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
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5 h-100 mix {{$meal->category->slug}} fresh-meat">
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
                                <span class="text-1000 fw-bold">${{$meal->price}}</span>
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

    <section class="home-countdown1">
        <div class="back-img" style="background-color: rgb(206 200 200)">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="deal-content">
                            @if($sale && $ends_at > \Carbon\Carbon::now())
                                <h2>{{$sale->name}}</h2>
                                <span class="deal-c" style="color: #0a001f">We offer a hot deal offer every festival</span>
                                <ul class="contdown_row">
                                    <li class="countdown_section">
                                        <span id="days" class="countdown_timer" wire:key="days">{{ $days }}</span>
                                        <span class="countdown_title">Days</span>
                                    </li>
                                    <li class="countdown_section">
                                        <span id="hours" class="countdown_timer" wire:key="hours">{{ $hours }}</span>
                                        <span class="countdown_title">Hours</span>
                                    </li>
                                    <li class="countdown_section">
                                        <span id="minutes" class="countdown_timer" wire:key="minutes">{{ $minutes }}</span>
                                        <span class="countdown_title">Minutes</span>
                                    </li>
                                    <li class="countdown_section">
                                        <span id="seconds" class="countdown_timer" wire:key="seconds">{{ $seconds }}</span>
                                        <span class="countdown_title">Seconds</span>
                                    </li>
                                </ul>
                                <a href="{{-- route('restaurant.index') --}}" class="btn btn-style1">Shop collection</a>
                            @else
                                <h2>Wait for new sale soon</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
