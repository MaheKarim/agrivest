@php
    $ourOfferContent = getContent('our_offer.content', true);
    $projects = \App\Models\Project::active()->featured()->available()->beforeEndDate();
    $showMoreBtn = (clone $projects)->count() > 4;
    $projects = (clone $projects)->take(4)->get();
@endphp
<section class="our-offers py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Global Icon')">
                        <span>{{ __(@$ourOfferContent->data_values->small_heading) }}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Global Icon')">
                    </div>
                    <h3 class="section-heading__title">{{ __(@$ourOfferContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{ __(@$ourOfferContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="high-offers" class="tab-pane fade show active">
                <div class="row gy-4">
                    @foreach ($projects as $project)
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <article class="card card--offer ">
                                <div class="card-header">
                                    <a class="card-thumb" href="{{ route('project.details', $project->slug) }}">
                                        <img src="{{ getImage(getFilePath('project') . '/' . $project->image, getFilePath('project')) }}"
                                            alt="{{ __($project->title) }}">
                                    </a>

                                    <div class="card-offer">
                                        <span class="card-offer__label">@lang('ROI')</span>
                                        <span
                                            class="card-offer__percentage">{{ __(getAmount($project->roi_percentage)) }}%</span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="card-title">
                                        <a
                                            href="{{ route('project.details', $project->slug) }}">{{ __($project->title) }}</a>
                                    </h6>

                                    <div class="card-content">
                                        <div class="card-content__wrapper">
                                            <span class="card-content__label">@lang('Per Share')</span>
                                            <div class="card-content__price">
                                                {{ __(showAmount($project->share_amount)) }}</div>
                                        </div>
                                        <a href="{{ route('project.details', $project->slug) }}"
                                            class="btn btn--xsm btn--outline">@lang('Book Now')</a>
                                    </div>
                                    <div class="card-bottom">
                                        <span class="card-bottom__unit">@lang('Remaining:')
                                            {{ __($project->available_share) }} @lang('Units')</span>
                                        <span
                                            class="card-bottom__duration">{{ __(diffForHumans($project->end_date)) }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if ($showMoreBtn)
            <div class="mt-70 text-center">
                <a href="{{ @$ourOfferContent->data_values->button_url }}"
                    class="btn btn--lg btn--outline">{{ __(@$ourOfferContent->data_values->button_name) }}</a>
            </div>
        @endif
    </div>
</section>
