<div>
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
</div>
