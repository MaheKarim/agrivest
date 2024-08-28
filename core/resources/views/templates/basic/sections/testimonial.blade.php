@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElement = getContent('testimonial.element', orderById: true);
@endphp
<section class="investor-feedback py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Site Favicon')">
                        <span>{{ __(@$testimonialContent->data_values->small_heading) }}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Site Favicon')">
                    </div>
                    <h3 class="section-heading__title">{{ __(@$testimonialContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{ __(@$testimonialContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="feedback-slider">
            @foreach($testimonialElement as $content)
            <div class="feedback-slider__item">
                <div class="feedback-card">
                    <div class="feedback-card__header">
                        <div class="feedback-card__thumb">
                            <img src="{{ frontendImage('testimonial', @$content->data_values->image, '80x80') }}" alt="@lang('Client Image')">
                        </div>

                        <div class="feedback-card__info">
                            <h6 class="feedback-card__name">{{__(@$content->data_values->name)}}</h6>
                            <p class="feedback-card__designation">{{__(@$content->data_values->designation)}} @lang('from') <span>{{__(@$content->data_values->country)}}</span></p>

                            <div class="feedback-card__icon">
                                <img src="{{ asset($activeTemplateTrue.'images/icons/quote.png') }}" alt="@lang('Quote Image')">
                            </div>
                        </div>
                    </div>

                    <div class="feedback-card__body">
                        <p class="feedback-card__text">
                          {{__(@$content->data_values->description)}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
