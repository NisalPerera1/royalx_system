<!-- theme main manu start-->
<header class="theme-main-menu theme-menu-one position-relative">
    <div class="top__header d-none d-lg-flex">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-xxl-inline-block">
                    <div class="top__left__header">
                        <ul>
                            <li><p><a  href="{{route('about.index')}}" >Company History</a></p></li>
                            <li><a href="mailto:synolabsitmail@gmail.com"><i class="bi bi-envelope"></i><span>synolabsitmail@gmail.com</span></a></li>
                            <li><a href="{{route('contact_us.index')}}"><i class="bi bi-geo-alt-fill"></i><span>Synolabs IT Pvt Ltd. 455/C/11, Katubedda, Sri Lanka</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-xxl-inline-block">
                    <div class="top__right__header text-start text-lg-end">
                        <ul>
                            <li><a href="{{route('about.index')}}"><span>Careers</span></a></li>
                            <li><a href="{{route('about.index')}}"><span>Faq’s </span></a></li>
                            <li><a href="{{route('about.index')}}"><span>Business Policy</span></a></li>
                            <li>
                                <a href="{{route('about.index')}}">
                                    <span>About</span></a></li>
                        </ul>
                        <ul>
                            <li><div class="border-left"></div></li>
                            <li><a href="https://web.facebook.com/synolabs"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/synolabs-it-solutions/"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xxl-2 col-xl-2 d-none d-xl-inline-block">
                    <div class="logo-area">
                        <a class="front" href="{{route('site.home')}}"><img src="{{ asset('assets/img/logo/site_logo.jpg') }}" alt="Header-logo"></a>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-6 col-6 d-flex align-items-center">
                    <div class="logo-area d-xl-none d-md-inline-block">
                        <a class="front" href="{{route('site.home')}}"><img src="{{ asset('assets/img/logo/site_logo.jpg') }}" alt="Header-logo"></a>
                    </div>
                    <div class="main-menu d-none d-xl-block">
                        <nav id="mobile-menu">
                            <ul class="menu-list ps-0">
                                <li>
                                    <a href="{{route('site.home')}}">
                                        Home
                                    </a>

                                </li>
                                <li>
                                    <a href="{{route('about.index')}}">
                                        About
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('services.index')}}">

                                        Services</a>

                                </li>
                                <li>
                                    <a href="{{route('projects.index')}}">
                                        Projects
                                    </a>
                                </li>

                                <li>
                                    <a href="{{route('contact_us.index')}}">
                                        Contact
                                    </a>

                                </li>

                                <li>
                                    <a href="{{route('cloudbiz_erp')}}">
                                       CloudBiz
                                    </a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-4 col-6 d-flex align-items-center justify-content-end">
                    <div class="right-nav d-flex align-items-center justify-content-end">
                        <div class="d-none d-xxl-inline-block">
                            <div class="contact__info d-flex align-items-center">

                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/manu__two__01.png') }}" alt="" class="">
                                </div>
                                <div class="info">
                                    <p>Get in touch</p>
                                    <span>+94 71 586 7189</span>
                                </div>
                                <div class="nav__shape ml-30 mr-20"></div>
{{--                                <div class="icon">--}}
{{--                                    <div class="search-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">--}}
{{--                                        <a href="#" class=""><img src="assets/img/icon/manu__two__02.png" alt="" class=""></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="quote__btn d-none d-xl-inline-block">
                            <a href="https://phplaravel-1256041-4536717.cloudwaysapps.com/" class="ht_btn nav__two__btn">
                                <span>Get a Quote</span>
                            </a>
                        </div>
                        <div class="hamburger-menu d-xl-none">
                            <a class="round-menu" href="javascript:void(0);">
                                <i class="far fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.theme-main-menu -->
</header>
<!-- theme main manu end-->
