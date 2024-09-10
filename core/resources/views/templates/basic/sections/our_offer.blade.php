@php
    $ourOfferContent = getContent('our_offer.content', true);
@endphp
<section class="our-offers py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}"
                             alt="@lang('Global Icon')">
                        <span>{{ __(@$ourOfferContent->data_values->small_heading) }}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}"
                             alt="@lang('Global Icon')">
                    </div>
                    <h3 class="section-heading__title">{{ __(@$ourOfferContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{__(@$ourOfferContent->data_values->subheading)}}</p>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="high-offers" class="tab-pane fade show active">
                <div class="row gy-4">
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <article class="card card--offer ">
                            <div class="card-header">
                                <a class="card-thumb" href="offer-details.html">
                                    <img src="{{ asset($activeTemplateTrue.'images/thumbs/offer-card-thumb-1.jpg') }}"
                                         alt="">
                                </a>

                                <div class="card-offer">
                                    <span class="card-offer__label">ROI</span>
                                    <span class="card-offer__percentage">7.5%</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <h6 class="card-title">
                                    <a href="offer-details.html">Invest For Cow Farm</a>
                                </h6>

                                <div class="card-content">
                                    <div class="card-content__wrapper">
                                        <span class="card-content__label">Per Share</span>
                                        <div class="card-content__price">$30,000.00</div>
                                    </div>
                                    <a href="offer-details.html" class="btn btn--xsm btn--outline">Book Now</a>
                                </div>
                                <div class="card-bottom">
                                    <span class="card-bottom__unit">Remaining: 10 Units</span>
                                    <span class="card-bottom__duration">3 months</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-70 text-center">
            <a href="{{ @$ourOfferContent->data_values->button_url }}"
               class="btn btn--lg btn--outline">{{ __(@$ourOfferContent->data_values->button_name) }}</a>
        </div>
    </div>
</section>
