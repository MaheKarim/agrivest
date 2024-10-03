<div class="row gy-4">
    @forelse ($projects as $project)
        <div class="col-sm-12">
            <article class="card card--offer card--list-view style-two">
                <div class="card-left">
                    <a class="card-thumb" href="{{ route('project.details', $project->slug) }}">
                        <img src="{{ getImage(getFilePath('project') . '/' . $project->image) }}" alt="@lang('Project Image')">
                    </a>

                    <div class="card-offer">
                        <span class="card-offer__label">@lang('ROI')</span>
                        <span
                            class="card-offer__percentage">{{ getAmount($project->roi_percentage) }}@lang('%')</span>
                    </div>
                </div>

                <div class="card-right">
                    <div class="card-top">
                        <img class="card-thumb-sm" src="{{ getImage(getFilePath('project') . '/' . $project->image) }}"
                            alt="">
                        <h6 class="card-title">
                            <a href="{{ route('project.details', $project->slug) }}">{{ __($project->title) }}
                            </a>
                        </h6>
                        <div class="card-buttons">
                            <a class="btn btn--xsm btn--outline" href="{{ route('project.details', $project->slug) }}">
                                @lang('Invest Now')
                            </a>
                        </div>
                    </div>

                    <div class="card-content">
                        <ul class="card-meta">
                            <li class="card-meta-item">
                                <span class="card-meta-item__label">@lang('Per Share')</span>
                                <div class="card-meta-item__value">{{ __(showAmount($project->share_amount)) }}</div>
                            </li>

                            <li class="card-meta-item">
                                <span class="card-meta-item__label">@lang('ROI')</span>
                                <div class="card-meta-item__value">
                                    {{ __(getAmount($project->roi_percentage)) }}@lang('%')</div>
                            </li>
                        </ul>

                        <div class="card-buttons">
                            <a class="btn btn--xsm btn--outline book-now"
                                href="{{ route('project.details', $project->slug) }}">
                                @lang('Invest Now')
                            </a>
                        </div>
                    </div>

                    <div class="card-bottom">
                        <span class="card-bottom__unit">
                            <i class="las la-boxes"></i>
                            {{ __($project->available_share) }} @lang('units')
                        </span>
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
