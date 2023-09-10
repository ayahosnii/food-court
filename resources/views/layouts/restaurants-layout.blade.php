<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">


    <!-- Favicons -->
    <link href="{{asset('assets/restaurant-assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/restaurant-assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/restaurant-assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/restaurant-assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/restaurant-assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/restaurant-assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/restaurant-assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/restaurant-assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/restaurant-assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/restaurant-assets/css/style.css')}}" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
    @livewireStyles
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
<!-- Vendor JS Files -->
<script src="{{asset('assets/restaurant-assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('assets/restaurant-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/restaurant-assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/restaurant-assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/restaurant-assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('assets/restaurant-assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('assets/restaurant-assets/js/main.js')}}"></script>


<!-- Js Plugins -->
{{--<script src="{{asset('assets/js/fontawesome/all.min.js')}}"></script>--}}
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
@livewireScripts
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('assets/js/mixitup.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
{{--<script>--}}
{{--    $('#flash-overlay-modal').modal();--}}
{{--</script>--}}
</body>

</html>
