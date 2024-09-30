@php
    $whyWeContent = getContent('choose_us.content', true);
    $whyWeElement = getContent('choose_us.element', orderById: true);
@endphp
<section class="why-invest bg--white pt-120 pb-120">
    <div class="container">
        <div class="row gy-5 gy-lg-0 justify-content-center">
            <div class="col-md-10 col-lg-6 col-xxl-7">
                <div class="why-invest__thumb">
                    <img src="{{ frontendImage('choose_us', @$whyWeContent->data_values->image, '666x556') }}"
                        alt="@lang('Image')">

                    <div class="why-invest__thumb-overlay">
                        <a class="play-btn" href="{{ @$whyWeContent->data_values->video_link }}">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-lg-6 col-xxl-5">
                <div class="why-invest__content">
                    <div class="section-heading style-left">
                        <div class="section-heading__sec-name">
                            <img class="me-2"
                                src="{{ frontendImage('choose_us', @$whyWeContent->data_values->icon_image) }}"
                                alt="@lang('Icon')">
                            <span>{{ __(@$whyWeContent->data_values->small_heading) }}</span>
                        </div>
                        <h3 class="section-heading__title">{{ __(@$whyWeContent->data_values->heading) }}</h3>
                        <p class="section-heading__desc">{{ __(@$whyWeContent->data_values->subheading) }}</p>
                    </div>

                    <ul class="why-invest-points">
                        @foreach ($whyWeElement as $element)
                            <li class="why-invest-points__item">{{ __(@$element->data_values->text) }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ @$whyWeContent->data_values->button_url }}"
                        class="btn btn--lg btn--outline">{{ __(@$whyWeContent->data_values->button_name) }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.play-btn').magnificPopup({
                type: 'iframe',
            });
        })(jQuery);
    </script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/magnific-popup.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/magnific-popup.min.js') }}"></script>
@endpush
