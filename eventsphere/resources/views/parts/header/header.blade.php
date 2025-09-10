<header class="main-header">
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/resources/logo-1.png') }}" alt="Site Logo">
                        </a>
                    </div>
                    <div class="main-menu__login-box">
                        <div class="icon">
                            <span class="icon-user"></span>
                        </div>
                        <div class="select-box">
                            <select class="wide">
                                <option data-display="Join With Us">Join With Us</option>
                                <option value="1">Login</option>
                                <option value="2">Register</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="main-menu__main-menu-box">
                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        @include('parts.header.menu')
                    </div>
                    <div class="main-menu__social-and-search-box">
                        <div class="main-menu__social">
                            <a href="#"><span class="fab fa-facebook-f"></span></a>
                            <a href=""><span class="fab fa-twitter"></span></a>
                            <a href=""><span class="fab fa-linkedin-in"></span></a>
                        </div>
                        <div class="main-menu__search-box">
                            <a href="#" class="main-menu__search search-toggler">
                                <span class="icon-loupe"></span>
                                <p class="main-menu__search-text">Search</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->