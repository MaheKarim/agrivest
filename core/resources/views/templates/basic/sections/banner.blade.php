@php
    $bannerContent = getContent('banner.content', true);
    $bannerElement = getContent('banner.element', null, orderById: true);
@endphp
<section class="banner-section bg-img"
    data-background-image="{{ frontendImage('banner', @$bannerContent->data_values->image, '1920x950') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-9 col-xl-8 col-xxl-7">
                <div class="banner-content">
                    <h1 class="banner-content__title">{{ __(@$bannerContent->data_values->heading) }}</h1>
                    <p class="banner-content__desc">
                        <span>{{ __(@$bannerContent->data_values->color_text) }}</span>
                        {{ __(@$bannerContent->data_values->subheading) }}
                    </p>

                    <div class="banner-content__button">
                        <a class="btn btn--xl btn--base"
                            href="{{ @$bannerContent->data_values->left_button_url }}">{{ __(@$bannerContent->data_values->left_button_name) }}</a>
                        <a class="btn btn--xl btn-outline--white"
                            href="{{ @$bannerContent->data_values->right_button_url }}">{{ __(@$bannerContent->data_values->right_button_name) }}</a>
                    </div>

                    <ul class="counterup-list">
                        @foreach ($bannerElement as $element)
                            <li class="counterup-list-item">
                                <h4 class="counterup-list-item__number">
                                    <div class="odometer" data-odometer-stop="{{ __(@$element->data_values->number) }}">
                                    </div>
                                </h4>
                                <span class="counterup-list-item__text">{{ __(@$element->data_values->text) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            function InitOdometer() {
                $('.odometer').each(function(index, element) {

                    var odometer = new Odometer({
                        el: element,
                        value: 0,
                    })

                    odometer.update($(element).data('odometer-stop'))

                    $(element).isInViewport(function(status) {

                        if (status === 'entered') {
                            odometer.update($(element).data('odometer-stop'))
                        }

                        if (status === 'leaved') {
                            odometer.update(0)
                        }
                    })
                });
            }

            $(window).on('load', InitOdometer);
        })(jQuery);
    </script>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
@endpush
