<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        @if ( auth()->user() && auth()->user()->hasRole('admin'))

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                            class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
                </li>

                <li class="nav-item"><a href=""><i class="la la-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">اللغات </span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">5</span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive">
                            <a class="menu-item" href="{{route('admin.languages')}}"
                               data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.languages.create')}}" data-i18n="nav.dash.crypto">أضافة
                                لغة جديد </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.Main-Categories') </span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">أضافة
                                قسم </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.Sub-Categories') </span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.subcategories')}}"
                                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.subcategories.create')}}" data-i18n="nav.dash.crypto">أضافة
                                قسم </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"><a href=""><i class="la la-male"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.meals')  </span>
                        <span
                            class="badge badge badge-success badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.meals')}}"
                                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.meals.create')}}" data-i18n="nav.dash.crypto">أضافة
                                منتج </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item"><a href=""><i class="la la-male"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.Restaurants')  </span>
                        <span
                            class="badge badge badge-warning  badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.restaurants')}}"
                                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li><a class="menu-item" href="" data-i18n="nav.dash.crypto">أضافة
                                طالب </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{route('admin.coupons')}}"><i class="la la-male"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.coupons')   </span>
                        <span
                            class="badge badge badge-danger  badge-pill float-right mr-2">0</span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.coupons')}}"
                                                data-i18n="nav.dash.ecommerce"> @lang('messages.all-coupons') </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.roles')}}"><i class="la la-male"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.roles')   </span>
                        <span
                            class="badge badge badge-danger  badge-pill float-right mr-2">0</span>
                    </a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.roles')}}"
                                                data-i18n="nav.dash.ecommerce"> @lang('messages.all-roles') </a>
                        </li>
                    </ul>
                </li>


                <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                                                                                        data-i18n="nav.templates.main">@lang('messages.sales')</span></a>
                    <ul class="menu-content">
                        <li class="inactive"><a class="menu-item" href="{{route('admin.sales')}}"
                                                data-i18n="nav.dash.ecommerce"> @lang('messages.all-sales') </a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="nav.category.layouts">Clients</span>
                    <i class="la la-ellipsis-h ft-minus"
                       data-toggle="tooltip"
                       data-placement="right"
                       data-original-title="Layouts"></i>
                </li>
                <li class=" nav-item">
                    <a href="{{route('admin.orders.all')}}">
                        <i class="la la-columns"></i><span class="menu-title"
                                                           data-i18n="nav.page_layouts.main">
                        The orders</span><span
                            class="badge badge badge-pill badge-danger float-right mr-2">New</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{route('admin.orders.shipped')}}" data-i18n="nav.page_layouts.1_column">
                                Shipping
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{route('admin.orders.pended')}}" data-i18n="nav.page_layouts.1_column">
                                Pended
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{route('admin.orders.delivered')}}" data-i18n="nav.page_layouts.1_column">
                                Delivered
                            </a>
                        </li>

                        <li>
                            <a class="menu-item" href="{{route('admin.orders.canceled')}}" data-i18n="nav.page_layouts.1_column">
                                Canceled
                            </a>
                        </li>

                        <li>
                            <a class="menu-item" href="{{route('admin.orders.all')}}" data-i18n="nav.page_layouts.1_column">
                                All
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="menu-item" href="#" data-i18n="nav.page_layouts.3_columns_detached.main">
                        Sliders
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="layout-content-detached-left-sidebar.html"
                               data-i18n="nav.page_layouts.3_columns_detached.detached_left_sidebar">Detached left
                                sidebar</a>
                        </li>
                        <li><a class="menu-item" href="layout-content-detached-left-sticky-sidebar.html"
                               data-i18n="nav.page_layouts.3_columns_detached.detached_sticky_left_sidebar">Detached
                                sticky left sidebar</a>
                        </li>
                        <li><a class="menu-item" href="layout-content-detached-right-sidebar.html"
                               data-i18n="nav.page_layouts.3_columns_detached.detached_right_sidebar">Detached right
                                sidebar</a>
                        </li>
                        <li><a class="menu-item" href="layout-content-detached-right-sticky-sidebar.html"
                               data-i18n="nav.page_layouts.3_columns_detached.detached_sticky_right_sidebar">Detached
                                sticky right sidebar</a>
                        </li>
                    </ul>
                </li>
            </ul>











        @elseif (auth()->guard('providers')->check() && auth()->guard('providers')->user()->hasRole('providers')) {

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('providers.why-choose-restaurant')  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\providers\WhyChooseRestaurant::where('provider_id', auth()->guard('providers')->user()->id)->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="inactive">
                        <a class="menu-item" href="{{route('why-choose-restaurant.index')}}"
                                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('why-choose-restaurant.create')}}" data-i18n="nav.dash.crypto">
                            @lang('providers.add_why_choose_our_restaurant')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('providers.tables')  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\providers\Table::where('provider_id', auth()->guard('providers')->user()->id)->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="inactive">
                        <a class="menu-item" href="{{route('providers.tables')}}"
                                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('providers.tables.create')}}" data-i18n="nav.dash.crypto">
                            Add Tables
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('messages.meals')  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\providers\Meal::where('provider_id', auth()->guard('providers')->user()->id)->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="inactive">
                        <a class="menu-item" href="{{route('provider.meals')}}"
                                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('provider.meals.create')}}" data-i18n="nav.dash.crypto">أضافة
                            منتج </a>
                    </li>
                </ul>
            </li>

        </ul>

        @else
            <p>Welcome User!</p>
        @endif
    </div>
</div>
