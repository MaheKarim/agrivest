@php
    @$quantity = @$quantity ?? 1;

    if ($project->return_type == Status::LIFETIME) {
        $totalEarnings = $project->roi_amount * $quantity;
        $profitMessage = showAmount($project->roi_amount * $quantity) . ' / ' . $project->time->name;
        $label = __('Profit');
    } else {
        $payAmount = $project->roi_amount;
        $totalEarnings = $payAmount * $project->repeat_times * $quantity;

        if ($project->capital_back == Status::YES) {
            $profitMessage = gs('cur_sym') . getAmount($project->share_amount + $totalEarnings);
            $label = __('Invest + Profit');
        } else {
            $profitMessage = gs('cur_sym') . getAmount($totalEarnings);
            $label = __('Profit');
        }
    }
@endphp

<aside id="offer-details-offcanvas-sidebar" class="offcanvas-sidebar offcanvas-sidebar--offer-details">
    <div class="offcanvas-sidebar__header">
        <button type="button" class="btn--close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="offcanvas-sidebar__body">
        <div class="payment-form">
            <div class="payment-form__block">
                <div class="amount-detail">
                    <div class="amount-detail-item">
                        <span class="amount-detail-item__label">@lang('Total Invest')</span>
                        <span
                            class="amount-detail-item__value">{{ gs('cur_sym') }}{{ getAmount($project->share_amount * $quantity) }}</span>
                    </div>
                    <div class="amount-detail-sperator">
                        <i class="las la-long-arrow-alt-right"></i>
                    </div>
                    <div class="amount-detail-item">
                        <span class="amount-detail-item__label">{{ $label }}</span>
                        <span class="amount-detail-item__value" id="total-earning">{{ __($profitMessage) }}</span>
                    </div>
                </div>
            </div>

            <div class="payment-form__block">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="payment-form__label">@lang('Quantity')</span>
                    <div class="product-qty">
                        <button class="product-qty__decrement qty-btn" type="button"><i
                                class="fas fa-minus"></i></button>
                        <input class="product-qty__value" type="number" min="1"
                            max="{{ $project->available_share }}" value="{{ $quantity }}">
                        <button class="product-qty__increment qty-btn" type="button"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>


            <div class="payment-form__block">
                <button type="button" class="btn btn--lg btn--base w-100 bookNow" data-bs-toggle="modal"
                    data-bs-target="#bitModal">
                    @lang('Invest Now')
                </button>
            </div>

            <div class="payment-form__block">
                <div class="detail-collpase">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#detail-collapse"
                        aria-expanded="true">
                        <span class="text text-collapsed">@lang('See Details')</span>
                        <span class="text text-open">@lang('Hide Details')</span>
                    </button>

                    <div id="detail-collapse" class="collapse show">
                        <ul class="detail-list">
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">@lang('Unit Price')</span>
                                <span class="detail-list-item__value"
                                    id="total-price">{{ __(showAmount($project->share_amount)) }}</span>
                            </li>
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">@lang('Total Invest')</span>
                                <span
                                    class="detail-list-item__value quantity-total-price">{{ gs('cur_sym') }}{{ __(getAmount($project->share_amount)) }}</span>
                            </li>
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">@lang('Earning ROI (%)')</span>
                                <span class="detail-list-item__value roi-percentage">
                                    {{ getAmount($project->roi_percentage) }}%
                                </span>
                            </li>
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">@lang('Earning ROI Amount')</span>
                                <span
                                    class="detail-list-item__value time-name">{{ __(showAmount($project->roi_amount * $quantity) . ' / ' . $project->time->name) }}</span>
                            </li>
                            @if ($project->return_type != Status::LIFETIME)
                                <li class="detail-list-item">
                                    <span class="detail-list-item__label">@lang('Return Timespan')</span>
                                    <span class="detail-list-item__value">
                                        @lang('For')
                                        {{ __($project->repeat_times) }}
                                        {{ __($project->time->name) }}
                                    </span>
                                </li>
                            @endif
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">@lang('Return Type')</span>
                                <span class="detail-list-item__value">
                                    @if ($project->return_type == Status::LIFETIME)
                                        @lang('Lifetime')
                                    @else
                                        @lang('Repeat')
                                    @endif
                                </span>
                            </li>
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">@lang('Capital Back')</span>
                                <span class="detail-list-item__value capital-back">
                                    @if ($project->capital_back)
                                        @lang('Yes')
                                    @else
                                        @lang('No')
                                    @endif
                                </span>
                            </li>
                            @if ($project->return_type != Status::LIFETIME)
                                <li class="detail-list-item">
                                    <span class="detail-list-item__label">@lang('Total Earning')</span>
                                    @if ($project->capital_back == Status::YES)
                                        <span class="detail-list-item__value total_earning" id="total-earning-last">
                                            {{ __(showAmount($project->share_amount + $totalEarnings)) }}
                                        </span>
                                    @else
                                        <span class="detail-list-item__value total_earning" id="total-earning-last">
                                            {{ __(showAmount($totalEarnings)) }}
                                        </span>
                                    @endif
                                </li>
                            @endif
                            <li class="detail-list-item">
                                <span class="detail-list-item__label">
                                    @lang('Maturity Time')
                                    <i class="las la-info-circle" data-toggle="tooltip" data-placement="top"
                                        title="@lang('Your investment will mature on this date. After that, you will begin to receive your returns.')">
                                    </i>
                                </span>
                                @php
                                    $endDate = \Carbon\Carbon::parse($project->end_date);
                                    $maturityDate = $endDate->addMonths($project->maturity_time);
                                @endphp

                                <span class="detail-list-item__value maturity_time" id="maturity-time">
                                    {{ $maturityDate->format('Y-m-d') }}
                                </span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
