<div class="card mb-3">
    <div class="card-header bg-primary">
        <h5 class="mb-0 text-white">@lang('Investment Information')</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <!-- Invest No -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Invest No')
                        <span class="fw-bold">{{ $invest->invest_no }}</span>
                    </li>
                    <!-- Total Invest -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Total Invest')
                        <span class="fw-bold">{{ showAmount($invest->total_price) }}</span>
                    </li>
                    <!-- Payment Type -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment Type')
                        {!! $invest->paymentTypeBadge !!}
                    </li>
                    <!-- Payment Method -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment')
                        @if ($invest->payment_type == Status::PAYMENT_ONLINE)
                            <span class="fw-bold">{{ __(@$invest->deposit->gateway->name) }} @lang('payment gateway')</span>
                        @else
                            <span class="fw-bold">@lang('Wallet')</span>
                        @endif
                    </li>
                    <!-- Payment TRX -->
                    @if (@$invest->deposit->trx)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Payment TRX')
                            <span class="fw-bold">{{ @$invest->deposit->trx }}</span>
                        </li>
                    @endif
                    <!-- Payment Status -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment Status')
                        {!! $invest->paymentStatusBadge !!}
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <!-- Investor Address -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Investor Address')
                        <span class="fw-bold">
                            {{ __(@$invest->user->address) }}, {{ @$invest->user->city }}, {{ @$invest->user->state }},
                            {{ @$invest->user->country_name }}
                        </span>
                    </li>
                    <!-- Share Available -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Share Available')
                        <span class="fw-bold">{{ getAmount($invest->project->available_share) }}</span>
                    </li>
                    <!-- Order Date -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Order Date')
                        <span class="fw-bold">{{ showDateTime($invest->created_at) }}</span>
                    </li>
                    <!-- Order Status -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Order Status')
                        {!! $invest->statusBadge !!}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="project-details">
    <div class="row">
        <!-- Project Details -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white">@lang('Project Details')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- Project Name -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Project Name'):</span>
                            <a href="{{ route('admin.project.edit', $invest->project->id) }}" class="fw-bold">
                                {{ __(strLimit($invest->project->title, 25)) }}
                            </a>
                        </li>
                        <!-- Quantity -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Quantity'):</span>
                            <span class="fw-bold">{{ $invest->quantity }}</span>
                        </li>
                        <!-- Price -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Price'):</span>
                            <span class="fw-bold">{{ showAmount($invest->unit_price) }}</span>
                        </li>
                        <!-- Subtotal -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Subtotal'):</span>
                            <span class="fw-bold">{{ showAmount($invest->total_price) }}</span>
                        </li>
                        <!-- Project Type -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Type'):</span>
                            <span class="fw-bold">
                                @if ($invest->project->return_type == Status::LIFETIME)
                                    @lang('Lifetime')
                                @else
                                    @lang('Repeat')
                                @endif
                            </span>
                        </li>
                        <!-- Conditional Display of Return Repeat Times or Project Duration -->
                        @if ($invest->project->return_type != Status::LIFETIME)
                            <!-- Return Repeat Times -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>@lang('Return Repeat Times'):</span>
                                <span class="fw-bold">{{ $invest->project->repeat_times }}
                                    {{ __($invest->project->time->name) }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>

        <!-- Investment Details -->
        <div class="col-md-6">
            @php
                // Calculate Total Earnings and Profit
                $quantity = $invest->quantity;
                $roiAmount = $invest->roi_amount;
                $roiPercentage = $invest->roi_percentage;
                $capitalBack = $invest->project->capital_back;
                $returnType = $invest->project->return_type;
                $projectDuration = $invest->project->project_duration;
                $repeatTimes = $invest->repeat_times;
                $timeName = $invest->project->time->name;
                $currencySymbol = gs('cur_sym');

                $totalEarnings = 0;

                if ($returnType == Status::LIFETIME) {
                    $totalMonths = $projectDuration;
                    $payHours = $invest->project->time->hours;
                    $payAmount = $roiAmount;

                    $totalHours = $totalMonths * 720;

                    $totalPayments = floor($totalHours / $payHours);

                    $totalEarnings = $totalPayments * $payAmount * $quantity;
                } else {
                    $payAmount = $roiAmount;
                    $totalEarnings = $payAmount * $repeatTimes * $quantity;
                }

                // Profit Earning (excluding capital back)
                $profitEarning = $totalEarnings;

                // Total Earning (including capital back if applicable)
                $totalEarning = $profitEarning;
                if ($capitalBack == Status::YES) {
                    $totalEarning += $invest->total_price;
                }

                // Earning ROI Amount per interval
                $earningROIAmount = $roiAmount * $quantity;
            @endphp
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white">@lang('Investment Details')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- ROI Percentage -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('ROI Percentage'):</span>
                            <span class="fw-bold">{{ getAmount($roiPercentage) }}@lang('%')</span>
                        </li>
                        <!-- Earning ROI Amount -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Earning ROI Amount'):</span>
                            <span class="fw-bold">{{ showAmount($earningROIAmount) }} /
                                {{ __($timeName) }}</span>
                        </li>
                        <!-- Profit Earning -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Profit Earning'):</span>
                            @if ($invest->project->return_type != Status::LIFETIME)
                                <span class="fw-bold">{{ showAmount($profitEarning) }}</span>
                            @else
                                <span class="fw-bold">{{ showAmount($earningROIAmount) }} /
                                    {{ __($timeName) }}</span>
                            @endif
                        </li>
                        <!-- Total Earning -->
                        @if ($invest->project->return_type != Status::LIFETIME)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>@lang('Total Earning'):</span>
                                <span class="fw-bold">{{ showAmount($totalEarning) }}</span>
                            </li>
                        @endif
                        <!-- Capital Back -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Capital Back'):</span>
                            <span class="fw-bold">
                                @if ($capitalBack == Status::YES)
                                    @lang('Yes')
                                @else
                                    @lang('No')
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
