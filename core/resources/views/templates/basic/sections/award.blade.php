@php
    $awardContent = getContent('award.content', true);
    $awardElement = getContent('award.element', orderById: true);
@endphp
<section class="awards-section py-120">
    <div class="container">
        <div class="row justify-content-start justify-content-xl-between">
            <div class="col-lg-6 col-xl-5">
                <div class="section-heading style-left">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                        <span>{{__(@$awardContent->data_values->small_heading)}}</span>
                    </div>
                    <h3 class="section-heading__title">{{__(@$awardContent->data_values->heading)}}</h3>
                    <p class="section-heading__desc">{{ __(@$awardContent->data_values->subheading) }}</p>
                </div>
                <a class="btn btn--lg btn--base d-none d-lg-inline-block"
                   href="{{ @$awardContent->data_values->button_url }}">
                    {{ __(@$awardContent->data_values->button_name) }}
                </a>
            </div>
            <div class="col-lg-6 col-xl-6">
                <ul class="awards-list">
                    @foreach ($awardElement as $element)
                        <li class="awards-list-item">
                            <div class="awards-list-item__thumb">
                                <img src="{{ frontendImage('award', @$element->data_values->image) }}"
                                     alt="@lang('Award Image')">
                            </div>

                            <div class="awards-list-item__content">
                                <h6 class="awards-list-item__title">{{__($element->data_values->name)}}</h6>
                                <span class="awards-list-item__date">{{__($element->data_values->date)}}</span>
                            </div>

                            <div class="awards-list-item__arrow">
                                <a href="{{ $element->data_values->url }}" target="_blank" class="awards-list-item__">
                                    <i class="las la-arrow-right"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-60 text-center d-lg-none">
                    <a class="btn btn--lg btn--base"
                       href="{{ @$awardContent->data_values->button_url }}">{{ __(@$awardContent->data_values->button_name) }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
