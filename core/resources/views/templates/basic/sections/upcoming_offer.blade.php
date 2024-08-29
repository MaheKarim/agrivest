@php
    $offerContent = getContent('upcoming_offer.content', true);
@endphp
<section class="upcoming-offers py-120 bg--white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Content')">
                        <span>{{__(@$offerContent->data_values->small_heading)}}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Content')">
                    </div>
                    <h3 class="section-heading__title">{{__(@$offerContent->data_values->heading)}}</h3>
                    <p class="section-heading__desc">{{__(@$offerContent->data_values->subheading)}}</p>
                </div>
            </div>
        </div>

        <div class="offer-slider">
            <div class="offer-slider__item">
                <a class="offer-card" href="offer-details.html">
                    <img class="offer-card__thumb" src="{{ asset($activeTemplateTrue.'images/thumbs/comming-soon-card-thumb-1.jpg') }}" alt="">
                    <div class="offer-card__content">
                        <h5 class="offer-card__title">Prawn Farm</h5>
                        <div class="offer-card__wrapper">
                            <div class="offer-card-info price">
                                <span class="offer-card-info__label">Per Share</span>
                                <div class="offer-card-info__value">$30,000.00</div>
                            </div>
                            <div class="offer-card-info roi">
                                <span class="offer-card-info__label">ROI</span>
                                <div class="offer-card-info__value">7.5%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="offer-slider__item">
                <a class="offer-card" href="offer-details.html">
                    <img class="offer-card__thumb" src="{{ asset($activeTemplateTrue.'images/thumbs/comming-soon-card-thumb-2.jpg') }}" alt="">
                    <div class="offer-card__content">
                        <h5 class="offer-card__title">Ox Farm</h5>
                        <div class="offer-card__wrapper">
                            <div class="offer-card-info price">
                                <span class="offer-card-info__label">Per Share</span>
                                <div class="offer-card-info__value">$30,000.00</div>
                            </div>
                            <div class="offer-card-info roi">
                                <span class="offer-card-info__label">ROI</span>
                                <div class="offer-card-info__value">7.5%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="offer-slider__item">
                <a class="offer-card" href="offer-details.html">
                    <img class="offer-card__thumb" src="{{ asset($activeTemplateTrue.'images/thumbs/comming-soon-card-thumb-3.jpg') }}" alt="">
                    <div class="offer-card__content">
                        <h5 class="offer-card__title">Goat Farming</h5>
                        <div class="offer-card__wrapper">
                            <div class="offer-card-info price">
                                <span class="offer-card-info__label">Per Share</span>
                                <div class="offer-card-info__value">$30,000.00</div>
                            </div>
                            <div class="offer-card-info roi">
                                <span class="offer-card-info__label">ROI</span>
                                <div class="offer-card-info__value">7.5%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="offer-slider__item">
                <a class="offer-card" href="offer-details.html">
                    <img class="offer-card__thumb" src="{{ asset($activeTemplateTrue.'images/thumbs/comming-soon-card-thumb-4.jpg') }}" alt="">
                    <div class="offer-card__content">
                        <h5 class="offer-card__title">Local Duck Farming</h5>
                        <div class="offer-card__wrapper">
                            <div class="offer-card-info price">
                                <span class="offer-card-info__label">Per Share</span>
                                <div class="offer-card-info__value">$30,000.00</div>
                            </div>
                            <div class="offer-card-info roi">
                                <span class="offer-card-info__label">ROI</span>
                                <div class="offer-card-info__value">7.5%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="offer-slider__item">
                <a class="offer-card" href="offer-details.html">
                    <img class="offer-card__thumb" src="{{ asset($activeTemplateTrue.'images/thumbs/comming-soon-card-thumb-1.jpg') }}" alt="">
                    <div class="offer-card__content">
                        <h5 class="offer-card__title">Prawn Farm</h5>

                        <div class="offer-card__wrapper">
                            <div class="offer-card-info price">
                                <span class="offer-card-info__label">Per Share</span>
                                <div class="offer-card-info__value">$30,000.00</div>
                            </div>

                            <div class="offer-card-info roi">
                                <span class="offer-card-info__label">ROI</span>
                                <div class="offer-card-info__value">7.5%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.offer-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                speed: 1000,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            dots: true
                        }
                    }
                ],
            })
        })(jQuery);
    </script>
@endpush
@if(!app()->offsetExists('slick_load'))
    @push('style-lib')
        <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
    @endpush
    @push('script-lib')
        <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
    @endpush
    @php app()->offsetSet('slick_load', true) @endphp
@endif
