@php
    $investContent = getContent('invest.content', true);
    $investElement = getContent('invest.element', orderById: true);
@endphp
<section class="how-to-invest bg--white pt-70 pb-120">
    <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-start">
            <div class="col-md-10 col-lg-6">
                <div class="how-to-invest__thumb">
                    <img src="{{ frontendImage('invest', @$investContent->data_values->image, '507x669') }}"
                        alt="@lang('Investment Image')">
                </div>
            </div>
            <div class="col-md-10 col-lg-6">
                <div class="how-to-invest__content">
                    <div class="section-heading style-left">
                        <div class="section-heading__sec-name">
                            <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Site Favicon')">
                            <span>{{ __(@$investContent->data_values->small_heading) }}</span>
                            <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Site Favicon')">
                        </div>
                        <h3 class="section-heading__title">{{ __(@$investContent->data_values->heading) }}</h3>
                        <p class="section-heading__desc">{{ __(@$investContent->data_values->subheading) }} </p>
                    </div>
                    <ul class="how-to-invest-steps">

                        @foreach ($investElement as $element)
                            <li class="how-to-invest-steps__item">
                                <div class="how-to-invest-steps__icon">
                                    <img src="{{ frontendImage('invest', @$element->data_values->icon) }}"
                                        alt="@lang('Invest Icon Image')">
                                </div>

                                <div class="how-to-invest-steps__content">
                                    <h6 class="how-to-invest-steps__title">{{ __(@$element->data_values->title) }}</h6>
                                    <p class="how-to-invest-steps__desc">{{ __(@$element->data_values->description) }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
