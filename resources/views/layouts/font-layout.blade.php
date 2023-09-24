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
    <style>
        .btn-whatsapp-pulse {
            background: #25d366;
            color: white;
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 0;
            height: 0;
            padding: 35px;
            text-decoration: none;
            border-radius: 50%;
            animation-name: pulse;
            animation-duration: 1.5s;
            animation-timing-function: ease-out;
            animation-iteration-count: infinite;
            z-index: 99999;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
            }
            80% {
                box-shadow: 0 0 0 14px rgba(37, 211, 102, 0);
            }
        }

        .btn-whatsapp-pulse-border {
            bottom: 120px;
            right: 20px;
            animation-play-state: paused;
        }

        .btn-whatsapp-pulse-border::before {
            content: "";
            position: absolute;
            border-radius: 50%;
            padding: 25px;
            border: 5px solid #25d366;
            opacity: 0.75;
            animation-name: pulse-border;
            animation-duration: 1.5s;
            animation-timing-function: ease-out;
            animation-iteration-count: infinite;
        }

        @keyframes pulse-border {
            0% {
                padding: 25px;
                opacity: 0.75;
            }
            75% {
                padding: 50px;
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }

    </style>
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


<a href="https://wa.me/201006215138" class="btn-whatsapp-pulse btn-whatsapp-pulse-border">
    <i class="fa fa-whatsapp"></i>
</a>

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
