<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title ">@lang('Invest detail of') {{ $invest->invest_no }}</h5>
        {{--        <a href="{{ route('admin.order.invoice', $invest->id) }}" class="btn btn-outline--primary " target="_blank">--}}
        {{--            <i class="las la-print"></i>--}}
        {{--            @lang('Print Invoice')--}}
        {{--        </a>--}}
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
                            <span
                                class="fw-bold">{{ __(@$invest->deposit->gateway->name) }} @lang('payment gateway')</span>
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
                            {{ __(@$invest->user->address)}},{{ @$invest->user->city}},{{@$invest->user->state}}, {{@$invest->user->country_name}}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Share Available')
                        <span
                            class="fw-bold"> {{ getAmount($invest->project->available_share) }}</span>
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

        <div class="table-responsive--md  table-responsive">
            <table class="table table--light style--two">
                <thead>
                <tr>
                    <th>@lang('Project Name')</th>
                    <th>@lang('Quantity')</th>
                    <th>@lang('Price')</th>
                    <th>@lang('Subtotal')</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a href="{{ route('admin.project.edit', $invest->id) }}">
                            {{ __(strLimit($invest->project->title, 25)) }}
                        </a>
                    </td>

                    <td>
                        <strong>{{ $invest->quantity }}</strong>
                    </td>

                    <td>
                        <strong>{{ showAmount($invest->unit_price) }} </strong>
                    </td>

                    <td>
                        <strong>{{ showAmount($invest->total_price) }} </strong>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <span>@lang('ROI Percentage :')</span><strong> {{ getAmount($invest->roi_percentage) }} @lang('%')</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <span>@lang('ROI Amount:')</span><strong> {{ showAmount($invest->roi_amount * $invest->quantity) }} </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td><span>@lang('Total Earning:')</span><strong> {{ showAmount($invest->total_earning) }}</strong>
                    </td>
                </tr>
                </tfoot>
            </table>
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
