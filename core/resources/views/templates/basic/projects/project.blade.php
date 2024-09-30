<div class="row gy-4">
    @forelse ($projects as $project)
        <div class="col-sm-6 col-xl-4 single-project">
            <article class="card card--offer style-two">
                <div class="card-header">
                    <a class="card-thumb" href="{{ route('project.details', $project->slug) }}">
                        <img src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                            alt="@lang('Project Image')">
                    </a>
                    <div class="card-offer">
                        <span class="card-offer__label">@lang('ROI')</span>
                        <span
                            class="card-offer__percentage">{{ __(getAmount($project->roi_percentage)) }}@lang('%')</span>
                    </div>
                </div>

                <div class="card-body">
                    <h6 class="card-title">
                        <a href="{{ route('project.details', $project->slug) }}">{{ __($project->title) }}</a>
                    </h6>

                    <div class="card-content">
                        <div class="card-content__wrapper">
                            <span class="card-content__label">@lang('Per Share')</span>
                            <div class="card-content__price">
                                {{ __(showAmount($project->share_amount)) }}</div>
                        </div>
                        <a href="{{ route('project.details', $project->slug) }}"
                            class="btn btn--xsm btn--outline">@lang('Invest Now')</a>
                    </div>
                    <div class="card-bottom">
                        <span class="card-bottom__unit">@lang('Remaining:') {{ __($project->available_share) }}
                            @lang('Units')</span>
                        <span class="card-bottom__duration">{{ __(diffForHumans($project->end_date)) }}</span>
                    </div>
                </div>
            </article>
        </div>
    @empty
        <div class="card border-light">
            <div class="card-body">
                <div class="empty-notification-list text-center">
                    <img src="{{ getImage('assets/images/empty.png') }}" alt="empty">
                    <p class="text-dark fw-bold">@lang('No projects found.')</p>
                </div>
            </div>
        </div>
    @endforelse
</div>


@if ($projects->hasPages())
    <ul class="pagination">
        {{ paginateLinks($projects) }}
    </ul>
@endif
