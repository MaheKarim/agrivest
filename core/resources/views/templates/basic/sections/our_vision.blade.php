@php
    $ourVisionContent = getContent('our_vision.content', true);
    $ourVisionElement = getContent('our_vision.element', orderById: true);
@endphp
<section class="our-vision bg--white pt-70 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                        <span>{{ __(@$ourVisionContent->data_values->small_heading) }}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                    </div>
                    <h3 class="section-heading__title">{{ __(@$ourVisionContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{ __(@$ourVisionContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>

        <div class="row gy-4 justify-content-center justify-content-sm-start">
            @foreach ($ourVisionElement as $element)
                <div class="col-11 col-xsm-6 col-sm-6 col-lg-3">
                    <div class="our-vision-card">
                        <div class="our-vision-card__icon">
                            <img src="{{ frontendImage('our_vision', @$element->data_values->image, '40x40') }}"
                                alt="@lang('Vision Icon Image')">
                        </div>

                        <h6 class="our-vision-card__title">{{ __(@$element->data_values->text) }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
