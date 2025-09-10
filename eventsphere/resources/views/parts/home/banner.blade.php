<!--Main Slider Start-->
<section class="main-slider">
    <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
        "effect": "fade",
        "pagination": {
        "el": "#main-slider-pagination",
        "type": "bullets",
        "clickable": true
        },
        "navigation": {
        "nextEl": "#main-slider__swiper-button-next",
        "prevEl": "#main-slider__swiper-button-prev"
        },
        "autoplay": {
            "delay": 8000
        } 
    }'>
        <div class="swiper-wrapper">

            @foreach([1, 2, 3] as $slide)
            <div class="swiper-slide">
                <div class="main-slider__bg"
                    style="background-image: url({{ asset('assets/images/backgrounds/slider-1-' . $slide . '.jpg') }});"></div>
                <div class="main-slider__img">
                    <img src="{{ asset('assets/images/resources/main-slider-img-1-' . $slide . '.jpg') }}" alt="Harmonia 2024 Slide {{ $slide }}">
                </div>
                <div class="main-slider__shape-1"></div>
                <div class="main-slider__shape-2">
                    <img src="{{ asset('assets/images/shapes/main-slider-shape-2.png') }}" alt="Slider Shape">
                </div>
                <div class="main-slider__shape-3"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-slider__content">
                                <p class="main-slider__sub-title">musicfest</p>
                                <h2 class="main-slider__title">Harmonia <br> 2024</h2>
                                <a href="#" class="main-slider__curved-circle">
                                    <div class="curved-circle">
                                        Discover more our work
                                    </div><!-- /.curved-circle -->
                                    <div class="main-slider__arrow-icon-box">
                                        <div class="main-slider__arrow-icon">
                                            <span class="icon-down-right"></span>
                                        </div>
                                    </div>
                                </a><!-- /.curved-circle -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="swiper-pagination" id="main-slider-pagination"></div>
        <!-- If we need navigation buttons -->

    </div>
</section>
<!--Main Slider End-->