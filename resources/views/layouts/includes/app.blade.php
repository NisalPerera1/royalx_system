<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords"
          content="agency, app landing, bootstrap 5, business, corporate, creative, doc, documentation, landing page, mobile app, sass, software, survey, trending">
    <meta name="description"
          content="Ntec - Saas & Software HTML5 Template for all kinds of agency, app landing, bootstrap 5, business, corporate, creative, doc, documentation, landing page, mobile app, sass, software, survey">
    <title>Synolabs IT Solutions</title>
    <meta property="og:site_name" content="Ntec">
    <meta property="og:url" content="">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Ntec - Saas & Software HTML5 Template">
    <meta name='og:image' content='images/assets/ogg.png'>
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#FC3C59">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#00040B">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#00040B">

    <!-- <link rel="manifest" href="site.webmanifest" /> -->
{{--    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">--}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/bootstrap-icons/font-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>

<body>
<!-- main-page-wrapper start -->
<div class="main-page-wrapper">
    <!--[if lte IE 9]> <p class="browserupgrade"> You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security. </p> <![endif]-->

    <!-- Add your site or application content here -->
    <!-- preloader -->

    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader end  -->

    <!-- offcanvas start  -->
    <div class="offcanvas offcanvas-top theme-bg" tabindex="-1" id="offcanvasTop">
        <div class="offcanvas-header">
            <a data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times search-close" id="search-close"></i>
            </a>
        </div>
        <div class="offcanvas-body">
            <!-- Fullscreen search -->
            <div class="search-wrap">
                <form method="get">
                    <input type="search" class="main-search-input" placeholder="Search Your Keyword...">
                </form>
            </div>
            <!-- end fullscreen search -->
        </div>
    </div>
    <!-- offcanvas end  -->

    <!-- slide-bar start -->
    <aside class="slide-bar">
        <div class="close-mobile-menu">
            <a href="javascript:void(0);">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <!-- offset-sidebar start -->
        <div class="offset-sidebar">
            <div class="offset-widget offset-logo mb-30">
                <a href="index.html">
                    <img src="assets/img/logo/header-logo-02.png" alt="logo">
                </a>
            </div>
            <div class="mobile-menu"></div>
            <div class="offset-widget mb-40">
                <div class="info-widget">
                    <h4 class="offset-title mb-20">About Us</h4>
                    <p class="mb-30">
                        But I must explain to you how all this mistaken idea of denouncing pleasure and
                        praising pain was born and will give you a complete account of the system and
                        expound the actual teachings of the great explore
                    </p>
                </div>
            </div>
            <div class="offset-widget mb-30 pr-10">
                <div class="info-widget info-widget2">
                    <h4 class="offset-title mb-20">Contact Info</h4>
                    <p>
                        <i class="fal fa-address-book"></i>
                        23/A, Miranda City Likaoli Prikano, Dope</p>
                    <p>
                        <i class="fal fa-phone"></i>
                        +0989 7876 9865 9
                    </p>
                    <p>
                        <i class="fal fa-envelope-open"></i>
                        info@example.com
                    </p>
                </div>
            </div>
            <!-- <div class="login-btn text-center">
                <a class="ht_btn w-100" href="login.html">Login</a>
            </div> -->
        </div>
        <!-- offset-sidebar end -->

    </aside>
    <div class="body-overlay"></div>
    <!-- slide-bar end -->

    @include('layouts.includes.header')
    @yield('content')
    @include('layouts.includes.footer')
</div>
<!-- main-page-wrapper end -->



<!-- JS here -->

<script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.meanmenu.js')}}"></script>
<script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/aos.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>


<!--Custom JS here -->
<script src="{{asset('assets/js/main.js')}}"></script>


</body>

</html>
