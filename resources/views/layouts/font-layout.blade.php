<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Court Template">
    <meta name="keywords" content="Court, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Court</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/flag-icon-css/css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">

    @if(app()->getLocale() == 'ar')
    <style>
        nav.header__menu ul{
            direction: rtl;
            text-align: right;
            float: right;
            display: flex;
            justify-content: flex-end;
            list-style: none;
            padding: 0;
        }
        nav.header__menu ul li{
            direction: rtl;
            margin-left: 20px;
        }
        body section.hero.hero__categories {
            direction: rtl;
        }
        body section.hero.hero-normal {
            direction: rtl;
            padding-right: 20px;
        }
        body .hero__search__form {
            direction: ltr;
            float: right;
            padding-right: 20px;
        }
        body .hero__search__phone {
            direction: ltr;
            float: left;
            padding-right: 20px;
        }
        body section.product.spad {
            direction: rtl;
            text-align: initial;
        }
       body .blog.spad {
            direction: rtl;
            text-align: initial;
        }
       body .shoping-cart.spad {
            direction: rtl;
            text-align: initial;
        }
        body .shoping-cart.spad .shoping__cart__table table thead th.shoping__product {
            text-align: right;
        }
        body .shoping-cart.spad .shoping__cart__table table tbody tr td.shoping__cart__item {
            width: 630px;
            text-align: right;
        }
       body .shoping__checkout {
           text-align: end;
        }

        body .shoping__checkout h5 {
            text-align: right;
        }

        body .shoping__checkout ul li {
            text-align: right;
        }

        body .shoping__checkout ul li span {
            text-align: left;
            float: left;
        }
    </style>
    @endif
    @stack('styles')
    @livewireStyles
    @notifyCss
</head>

<body>
<!-- Page Preloder -->
{{--<div id="preloder">--}}
{{--    <div class="loader"></div>--}}
{{--</div>--}}

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
@include('includes.menu')
<!-- Humberger End -->

<!-- Header Section Begin -->
@include('includes.header')

@include('flash::message')

<!-- Header Section End -->
{{$slot}}
@include('includes.footer')
<!-- Js Plugins -->
{{--<script src="{{asset('assets/js/fontawesome/all.min.js')}}"></script>--}}
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
@livewireScripts
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('assets/js/mixitup.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
{{--<script>--}}
{{--    $('#flash-overlay-modal').modal();--}}
{{--</script>--}}

@stack('scripts')
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/64fef989b1aaa13b7a76309a/1ha1vtgms';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
@notifyJs
</body>

</html>
