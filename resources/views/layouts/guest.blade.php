<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
    @livewireStyles
</head>

<body class="home-page home-01 ">

    <!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

    <!--header-->
    <header id="header" class="header header-style-1">
        <div class="container-fluid">
            <div class="row">
                <div class="topbar-menu-area">
                    <div class="container">
                        <div class="topbar-menu left-menu">
                            <ul>
                                <li class="menu-item">
                                    <a title="Hotline: (+123) 456 789" href="#"><span
                                            class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                                </li>
                            </ul>
                        </div>
                        <div class="topbar-menu right-menu">
                            <ul>
                                <li class="menu-item lang-menu menu-item-has-children parent">
                                    <a title="English" href="#"><span class="img label-before"><img
                                                src="assets/images/lang-en.png" alt="lang-en"></span>English<i
                                            class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu lang">
                                        <li class="menu-item"><a title="hungary" href="#"><span
                                                    class="img label-before"><img src="assets/images/lang-hun.png"
                                                        alt="lang-hun"></span>Hungary</a></li>
                                        <li class="menu-item"><a title="german" href="#"><span
                                                    class="img label-before"><img src="assets/images/lang-ger.png"
                                                        alt="lang-ger"></span>German</a></li>
                                        <li class="menu-item"><a title="french" href="#"><span
                                                    class="img label-before"><img src="assets/images/lang-fra.png"
                                                        alt="lang-fre"></span>French</a></li>
                                        <li class="menu-item"><a title="canada" href="#"><span
                                                    class="img label-before"><img src="assets/images/lang-can.png"
                                                        alt="lang-can"></span>Canada</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children parent">
                                    <a title="Dollar (USD)" href="#">Dollar (USD)<i class="fa fa-angle-down"
                                            aria-hidden="true"></i></a>
                                    <ul class="submenu curency">
                                        <li class="menu-item">
                                            <a title="Pound (GBP)" href="#">Pound (GBP)</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Euro (EUR)" href="#">Euro (EUR)</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Dollar (USD)" href="#">Dollar (USD)</a>
                                        </li>
                                    </ul>
                                </li>
                                @if (Route::has('login'))
                                    @auth
                                        @if (Auth::user()->user_type === 'admin')
                                            <li class="menu-item menu-item-has-children parent">
                                                <a title="My Account" href="#">My Account ({{ Auth::user()->name }})<i
                                                        class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <ul class="submenu curency">
                                                    <li class="menu-item">
                                                        <a title="Dashboard"
                                                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                    </li>
                                                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </li>
                                        @else
                                            <li class="menu-item menu-item-has-children parent">
                                                <a title="My Account" href="#">Welcome, {{ Auth::user()->name }}<i
                                                        class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <ul class="submenu curency">
                                                    <li class="menu-item">
                                                        <a title="Dashboard"
                                                            href="{{ route('user.dashboard') }}">Dashboard</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                    </li>
                                                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </li>
                                        @endif
                                    @else
                                        <li class="menu-item"><a title="Register or Login"
                                                href="{{ route('login') }}">Login</a></li>
                                        <li class="menu-item"><a title="Register or Login"
                                                href="{{ route('register') }}">Register</a></li>
                                    @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="mid-section main-info-area">

                            <div class="wrap-logo-top left-section">
                                <a href="index.html" class="link-to-home"><img
                                        src="{{ asset('assets/images/logo-top-1.png') }}" alt="mercado"></a>
                            </div>

                            <div class="wrap-search center-section">
                                <div class="wrap-search-form">
                                    <form action="#" id="form-search-top" name="form-search-top">
                                        <input type="text" name="search" value="" placeholder="Search here...">
                                        <button form="form-search-top" type="button"><i class="fa fa-search"
                                                aria-hidden="true"></i></button>
                                        <div class="wrap-list-cate">
                                            <input type="hidden" name="product-cate" value="0" id="product-cate">
                                            <a href="#" class="link-control">All Category</a>
                                            <ul class="list-cate">
                                                <li class="level-0">All Category</li>
                                                <li class="level-1">-Electronics</li>
                                                <li class="level-2">Batteries & Chargens</li>
                                                <li class="level-2">Headphone & Headsets</li>
                                                <li class="level-2">Mp3 Player & Acessories</li>
                                                <li class="level-1">-Smartphone & Table</li>
                                                <li class="level-2">Batteries & Chargens</li>
                                                <li class="level-2">Mp3 Player & Headphones</li>
                                                <li class="level-2">Table & Accessories</li>
                                                <li class="level-1">-Electronics</li>
                                                <li class="level-2">Batteries & Chargens</li>
                                                <li class="level-2">Headphone & Headsets</li>
                                                <li class="level-2">Mp3 Player & Acessories</li>
                                                <li class="level-1">-Smartphone & Table</li>
                                                <li class="level-2">Batteries & Chargens</li>
                                                <li class="level-2">Mp3 Player & Headphones</li>
                                                <li class="level-2">Table & Accessories</li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="wrap-icon right-section">
                                <div class="wrap-icon-section wishlist">
                                    <a href="#" class="link-direction">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        <div class="left-info">
                                            <span class="index">0 item</span>
                                            <span class="title">Wishlist</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="wrap-icon-section minicart">
                                    <a href="#" class="link-direction">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        <div class="left-info">
                                            <span class="index">4 items</span>
                                            <span class="title">CART</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="wrap-icon-section show-up-after-1024">
                                    <a href="#" class="mobile-navigation">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="nav-section header-sticky">
                        <div class="header-nav-section">
                            <div class="container">
                                <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info">
                                    <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span
                                            class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span
                                            class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Top new items</a><span
                                            class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span
                                            class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span
                                            class="nav-label hot-label">hot</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="primary-nav-section">
                            <div class="container">
                                <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                                    <li class="menu-item home-icon">
                                        <a href="/" class="link-term mercado-item-title"><i class="fa fa-home"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/shop" class="link-term mercado-item-title">Shop</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/cart" class="link-term mercado-item-title">Cart</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/checkout" class="link-term mercado-item-title">Checkout</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="contact-us.html" class="link-term mercado-item-title">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{ $slot }}

        <footer id="footer">
            <div class="wrap-footer-content footer-style-1">

                <div class="wrap-function-info">
                    <div class="container">
                        <ul>
                            <li class="fc-info-item">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <div class="wrap-left-info">
                                    <h4 class="fc-name">Free Shipping</h4>
                                    <p class="fc-desc">Free On Oder Over $99</p>
                                </div>

                            </li>
                            <li class="fc-info-item">
                                <i class="fa fa-recycle" aria-hidden="true"></i>
                                <div class="wrap-left-info">
                                    <h4 class="fc-name">Guarantee</h4>
                                    <p class="fc-desc">30 Days Money Back</p>
                                </div>

                            </li>
                            <li class="fc-info-item">
                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                <div class="wrap-left-info">
                                    <h4 class="fc-name">Safe Payment</h4>
                                    <p class="fc-desc">Safe your online payment</p>
                                </div>

                            </li>
                            <li class="fc-info-item">
                                <i class="fa fa-life-ring" aria-hidden="true"></i>
                                <div class="wrap-left-info">
                                    <h4 class="fc-name">Online Suport</h4>
                                    <p class="fc-desc">We Have Support 24/7</p>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
                <!--End function info-->

                <div class="main-footer-content" style="margin-bottom: 25px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="wrap-footer-item">
                                    <h3 class="item-header">Contact Details</h3>
                                    <div class="item-content">
                                        <div class="wrap-contact-detail">
                                            <ul>
                                                <li>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <p class="contact-txt">{{ $setting->address }}</p>
                                                </li>
                                                <li>
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                    <p class="contact-txt">{{ $setting->phone }}</p>
                                                </li>
                                                <li>
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    <p class="contact-txt">{{ $setting->email }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

                                <div class="wrap-footer-item">
                                    <h3 class="item-header">Hot Line</h3>
                                    <div class="item-content">
                                        <div class="wrap-hotline-footer">
                                            <span class="desc">Contact us</span>
                                            <b class="phone-number">{{ $setting->phone }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 box-twin-content">
                                <div class="row">
                                    <div class="wrap-footer-item">
                                        <h3 class="item-header">We Are Using Safe Payments:</h3>
                                        <div class="item-content">
                                            <div class="wrap-list-item wrap-gallery">
                                                <img src="assets/images/payment.png" style="max-width: 260px;">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="wrap-footer-item">
                                        <h3 class="item-header">Social network</h3>
                                        <div class="item-content">
                                            <div class="wrap-list-item social-network">
                                                <ul>
                                                    <li><a href="{{ $setting->twitter }}" class="link-to-item"
                                                            title="twitter"><i class="fa fa-twitter"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="{{ $setting->instagram }}" class="link-to-item"
                                                            title="instagram"><i class="fa fa-instagram"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="{{ $setting->linkedin }}" class="link-to-item"
                                                            title="linkedin"><i class="fa fa-linkedin"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="{{ $setting->github }}" class="link-to-item"
                                                            title="github"><i class="fa fa-github"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                    <li><a href="{{ $setting->youtube }}" class="link-to-item"
                                                            title="youtube"><i class="fa fa-youtube"
                                                                aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="coppy-right-box">
                    <div class="container">
                        <div class="coppy-right-item item-left">
                            <p class="coppy-right-text text-center">Copyright © 2022 Christian Halim. All rights reserved
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
        <script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('assets/js/functions.js') }}"></script>
        @livewireScripts
    </body>

    </html>
