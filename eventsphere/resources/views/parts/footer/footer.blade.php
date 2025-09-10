<!--Site Footer Start-->
<footer class="site-footer">
    <div class="site-footer__shape-1"></div>
    <div class="site-footer__bg-box">
        <div class="site-footer__bg" style="background-image: url({{ asset('assets/images/backgrounds/site-footer-bg.jpg') }});"></div>
    </div>
    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__column footer-widget__contact">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">Contact</h3>
                            </div>
                            <div class="footer-widget__contact-inner">
                                <p class="footer-widget__contact-text">80 Road Broklyn Street, 600 <br>
                                    New York, USA</p>
                                <ul class="footer-widget__contact-list list-unstyled">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-envelope"></span>
                                        </div>
                                        <div class="text">
                                            <p><a href="mailto:needhelp@company.com">needhelp@company.com</a></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-telephone-symbol-button"></span>
                                        </div>
                                        <div class="text">
                                            <p><a href="tel:926668880000">+92 666 888 0000</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__column footer-widget__link">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">Links</h3>
                            </div>
                            <ul class="footer-widget__link-list list-unstyled">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Our Team</a></li>
                                <li><a href="#">Upcoming Events</a></li>
                                <li><a href="#">Latest News</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__column footer-widget__events">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">Find Events</h3>
                            </div>
                            <ul class="footer-widget__link-list list-unstyled">
                                <li><a href="#">Virtual Events</a></li>
                                <li><a href="#">Online Webinars</a></li>
                                <li><a href="#">Legal & Finance</a></li>
                                <li><a href="#">Virtual Conferences</a></li>
                                <li><a href="#">Online Classe</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="footer-widget__column footer-widget__gallery">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">Gallery</h3>
                            </div>
                            <ul class="footer-widget__gallery-list list-unstyled clearfix">
                                <li>
                                    <div class="footer-widget__gallery-img">
                                        <img src="{{ asset('assets/images/gallery/footer-widget-gallery-1-1.jpg') }}" alt="">
                                        <a href="#">Instagram</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-widget__gallery-img">
                                        <img src="{{ asset('assets/images/gallery/footer-widget-gallery-1-2.jpg') }}" alt="">
                                        <a href="#">Instagram</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-widget__gallery-img">
                                        <img src="{{ asset('assets/images/gallery/footer-widget-gallery-1-3.jpg') }}" alt="">
                                        <a href="#">Instagram</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-widget__gallery-img">
                                        <img src="{{ asset('assets/images/gallery/footer-widget-gallery-1-4.jpg') }}" alt="">
                                        <a href="#">Instagram</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-widget__gallery-img">
                                        <img src="{{ asset('assets/images/gallery/footer-widget-gallery-1-5.jpg') }}" alt="">
                                        <a href="#">Instagram</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-widget__gallery-img">
                                        <img src="{{ asset('assets/images/gallery/footer-widget-gallery-1-6.jpg') }}" alt="">
                                        <a href="#">Instagram</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner">
                <div class="site-footer__bottom-logo-and-social">
                    <div class="site-footer__bottom-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/resources/site-footer-logo-1.png') }}" alt=""></a>
                    </div>
                    <div class="site-footer__social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#"><i class="fas fa-wifi"></i></a>
                    </div>
                </div>
                <p class="site-footer__bottom-text"> © Copyright {{ date('Y') }} by <a href="#">Company.com</a></p>
            </div>
        </div>
    </div>
</footer>
<!--Site Footer End-->