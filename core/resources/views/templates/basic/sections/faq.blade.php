@php
    $faqContent = getContent('faq.content', true);
    $faqElement = getContent('faq.element', orderById: true);
@endphp
<section class="faq-section bg-img py-120"
    data-background-image="{{ frontendImage('faq', @$faqContent->data_values->image), '1920x646' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-heading style-left">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Global Icon')">
                        <span>{{ __(@$faqContent->data_values->small_heading) }}</span>
                    </div>
                    <h3 class="section-heading__title">{{ __(@$faqContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{ __(@$faqContent->data_values->subheading) }}</p>
                </div>
                <a class="btn btn--lg btn--base d-none d-lg-inline-block"
                    href="{{ @$faqContent->data_values->button_url }}">{{ __(@$faqContent->data_values->button_name) }}</a>
            </div>

            <div class="col-lg-7">
                <div id="faq-accordion" class="accordion custom--accordion style-two">
                    @foreach ($faqElement as $element)
                        <div class="accordion-item  {{ $loop->last ? 'active' : '' }}">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-accordion-question-{{ $loop->index + 1 }}"
                                    aria-expanded="false" aria-controls="faq-accordion-question-{{ $loop->index + 1 }}">
                                    {{ __(@$element->data_values->question) }}
                                </button>
                            </h2>
                            <div id="faq-accordion-question-{{ $loop->index + 1 }}"
                                class="accordion-collapse collapse {{ $loop->last ? 'show' : '' }}"
                                data-bs-parent="#faq-accordion">
                                <div class="accordion-body">
                                    <p class="accordion-text">
                                        {{ __(@$element->data_values->answer) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-60 d-lg-none">
                    <a class="btn btn--lg btn--base"
                        href="{{ @$faqContent->data_values->button_url }}">{{ __(@$faqContent->data_values->button_name) }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
