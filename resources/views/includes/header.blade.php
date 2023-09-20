<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> food-court@site.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>
                                <i class="{{app()->getLocale() == 'en' ? 'flag-icon flag-icon-gb' : 'flag-icon flag-icon-eg'}}"></i>
                            </div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a style="color: #f9fafd;" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        <i class="{{$localeCode == 'en'? 'flag-icon flag-icon-gb' : 'flag-icon flag-icon-eg'}}"></i>
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            @guest
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (Route::has('login'))
                                            <a href="{{route('login')}}">
                                                Login</a>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}">
                                                Register
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            @else
                                <div class="header__top__right__language">
                                    {{ Auth::user()->name }}
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{route('home')}}">@lang('site.home')</a></li>
                        <li><a href="{{route('meals')}}">@lang('site.meals')</a></li>
                        <li><a href="{{route('reservation')}}">@lang('site.reservation')</a></li>
                        {{--<li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>--}}
                        <li><a href="{{route('blog')}}">@lang('site.blogs')</a></li>
                        <li><a href="{{route('contact')}}">@lang('site.contact')</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        @livewire('cart-count-component')
                        @livewire('wishlist-count-component')
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
