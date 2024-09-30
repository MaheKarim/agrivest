<div class="card mb-3">
    <div class="card-header bg-info">
        <h5 class="mb-0 text-white">@lang('Investment Information')</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Invest No')
                        <span class="fw-bold">{{ $invest->invest_no }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Total Price')
                        <span class="fw-bold">{{ showAmount($invest->total_price) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment Type')
                        @php
                            echo $invest->paymentTypeBadge;
                        @endphp
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment')
                        @if ($invest->payment_type == Status::PAYMENT_ONLINE)
                            <span class="fw-bold">{{ __(@$invest->deposit->gateway->name) }}
                                @lang('payment gateway')</span>
                        @else
                            <span class="fw-bold">@lang('Wallet')</span>
                        @endif
                    </li>
                    @if (@$invest->deposit->trx)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Payment TRX')
                            <span class="fw-bold">{{ @$invest->deposit->trx }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment Status')
                        @php
                            echo $invest->paymentStatusBadge;
                        @endphp
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Investor Address')
                        <span class="fw-bold">
                            {{ __(@$invest->user->address) }},{{ @$invest->user->city }},{{ @$invest->user->state }},
                            {{ @$invest->user->country_name }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Share Available')
                        <span class="fw-bold"> {{ getAmount($invest->project->available_share) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Order Date')
                        <span class="fw-bold">{{ showDateTime($invest->created_at) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Order Status')
                        @php
                            echo $invest->statusBadge;
                        @endphp
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="project-details">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white">@lang('Project Details')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Project Name'):</span>
                            <a href="{{ route('admin.project.edit', $invest->project->id) }}" class="fw-bold">
                                {{ __(strLimit($invest->project->title, 25)) }}
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Quantity'):</span>
                            <span class="fw-bold">{{ $invest->quantity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Price'):</span>
                            <span class="fw-bold">{{ showAmount($invest->unit_price) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Subtotal'):</span>
                            <span class="fw-bold">{{ showAmount($invest->total_price) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success">
                    <h5 class="mb-0 text-white">@lang('Investment Details')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('ROI Percentage'):</span>
                            <span class="fw-bold">{{ getAmount($invest->roi_percentage) }}@lang('%')</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('ROI Amount'):</span>
                            <span class="fw-bold">{{ showAmount($invest->roi_amount * $invest->quantity) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>@lang('Total Earning'):</span>
                            <span class="fw-bold">{{ showAmount($invest->total_earning) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('style')
    <style>
        span {
            text-align: right;
        }
    </style>
@endpush
