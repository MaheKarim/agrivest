@php
    $projectContent = getContent('project.content', true);
@endphp
<section class="our-projects pt-120 pb-60 bg--white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                        <span>{{__(@$projectContent->data_values->small_heading)}}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                    </div>
                    <h3 class="section-heading__title">{{ __(@$projectContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{__(@$projectContent->data_values->subheading)}}</p>
                </div>
            </div>
            <div class="project-slider">
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue.'images/thumbs/project-thumb-1.png') }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Local Poultry Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue.'images/thumbs/project-thumb-2.png') }}" alt="">
                        </a>
                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Fish Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue.'images/thumbs/project-thumb-3.png') }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Banna Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue."images/thumbs/project-thumb-4.png") }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Vegetable  Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue."images/thumbs/project-thumb-1.png") }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Local Poultry Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue.'images/thumbs/project-thumb-2.png') }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Fish Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue.'images/thumbs/project-thumb-3.png') }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Banna Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="project-slider__item">
                    <div class="project-card">
                        <a href="#" class="project-card__thumb">
                            <img src="{{ asset($activeTemplateTrue.'images/thumbs/project-thumb-4.png') }}" alt="">
                        </a>

                        <div class="project-card__content">
                            <h6 class="project-card__title">
                                <a href="#">Vegetable  Farming</a>
                            </h6>
                            <div class="project-card__review">
                                <span class="rating">4.0 <i class="fas fa-star"></i></span>
                                <span class="total">(25)</span>
                            </div>
                            <p class="project-card__desc">
                                Contrary to popular belief. Lorem Ipsum is not simply random text.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.project-slider').slick({
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
