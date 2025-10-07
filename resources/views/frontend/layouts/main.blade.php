<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@stack('title', '9XBox Photobooth')</title>

    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @else
        <meta name="description" content="Chào mừng bạn đến với 9XBOX – nơi chúng tôi biến những khoảnh khắc đáng nhớ thành những bức ảnh đầy cảm xúc!">
    @endif

    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')">
    @else
        <meta name="keywords" content="photobooth, khung hình, sự kiện">
    @endif
    <meta name="author" content="9xbox photobooth">
    <meta name="robots" content="index, follow">

    {{-- Các thẻ meta khác --}}
    @stack('meta')
    
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
</head>
<!-- Fixed Contact Buttons -->
<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" 
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0" 
    nonce="9xboxSDK"></script>
    
<div class="fixed-contact-wrap d-none d-md-block">
    <div class="fixed-contact">
        <a href="https://www.facebook.com/9xbox/" target="_blank" rel="nofollow" class="s-btn-icon">
            <i class="fab fa-facebook-f"></i>
        </a>

        <a href="https://zalo.me/0765079049" target="_blank" class="s-btn-icon">
            <img src="{{ asset('frontend/img/zalo.webp') }}" alt="Zalo">
        </a>

        <a href="https://maps.app.goo.gl/g892vfzBr4BKhTDq7" target="_blank" rel="nofollow" class="s-btn-icon">
            <i class="fas fa-map-marker-alt"></i>
        </a>
    </div>
</div>
<!-- /Fixed Contact Buttons -->

<body>
    <!--::header part start::-->
    @include('frontend.partials.header')
    <!-- Header part end-->

    @yield('content')

    <!--::footer_part start::-->
    @include('frontend.partials.footer')
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="{{ asset('frontend/js/jquery-1.12.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('frontend/js/jquery.filterizr.min.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/contact.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mail-script.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    @yield('scripts')
</body>

</html>