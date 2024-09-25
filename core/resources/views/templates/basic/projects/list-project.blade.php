<div class="row gy-4">
    @foreach ($projects as $project)
        <div class="col-sm-12">
            <article class="card card--offer card--list-view style-two">
                <div class="card-left">
                    <a class="card-thumb" href="{{ route('project.details', $project->slug) }}">
                        <img
                            src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                            alt="@lang('Project Image')">
                    </a>

                    <div class="card-offer">
                        <span class="card-offer__label">@lang('ROI')</span>
                        <span
                            class="card-offer__percentage">{{ __(getAmount($project->roi_percentage)) }}@lang('%')</span>
                    </div>
                </div>

                <div class="card-right">
                    <div class="card-top">
                        <img class="card-thumb-sm"
                             src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                             alt="">
                        <h6 class="card-title">
                            <a
                                href="{{ route('project.details', $project->slug) }}">{{ __($project->title) }}
                            </a>
                        </h6>
                        <div class="card-buttons">
                            <a class="btn btn--xsm btn--outline" href="{{ route('project.details', $project->slug) }}">
                                @lang('Book Now')
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
                                <div
                                    class="card-meta-item__value">{{ __(getAmount($project->roi_percentage)) }}@lang('%')</div>
                            </li>
                        </ul>

                        <div class="card-buttons">
                            <a class="btn btn--xsm btn--outline book-now"
                               href="{{ route('project.details', $project->slug) }}">
                                @lang('Book Now')
                            </a>
                        </div>
                    </div>

                    <div class="card-bottom">
                        <span
                            class="card-bottom__unit">@lang('Remaining:') {{ __($project->available_share) }} @lang('Units')</span>
                        <span class="card-bottom__duration">{{ __(diffForHumans($project->end_date)) }}</span>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>

@if($projects->hasPages())
    <ul class="pagination">
        {{ paginateLinks($projects) }}
    </ul>
@endif
