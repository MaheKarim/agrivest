@php
    $brandContent = getContent('brand.element', orderById: true);
@endphp
<section class="brands py-60 bg--white">
    <div class="container">
        <div class="brands-slider">
            @foreach ($brandContent as $element)
                <div class="brands-slider__item">
                    <img src="{{ frontendImage('brand', $element->data_values->image, '140x40') }}"
                         alt="@lang('Brand Image')">
                </div>
            @endforeach
        </div>
    </div>
</section>
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.brands-slider').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                speed: 1000,
                dots: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 1000,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 5,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
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
