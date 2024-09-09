@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-3">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Project & User Information')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Project Name')
                            <span>{{ __($invest->project->title) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Profit')
                            <span>
                                {{ getAmount($invest->roi_percentage) }}%
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Quantity')
                            <span>{{ getAmount($invest->project->share_count) }} @lang('Qty')</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Full Name')
                            <span>{{ $invest->user->fullname }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Username')
                            <span>{{ $invest->user->username }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Mobile')
                            <span>{{ $invest->user->mobile }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Email')
                            <span>{{ $invest->user->email }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Basic Information')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Invest Quantity')
                            <span>{{ $invest->quantity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Invest Amount')
                            <span>{{ showAmount($invest->total_price) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Invested at')
                            <span>{{ showDateTime($invest->created_at) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Profit Amount')
                            <span>{{ showAmount($invest->total_earning) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Total Payable')
                            <span>
                                @if ($invest->return_type != -1)
                                    {{ $invest->repeat_times }} @lang(' times')
                                @else
                                    @lang('Lifetime')
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Interest Interval')
                            <span>@lang('Every ') {{ $invest->return_interval }} {{ $invest->project->time->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Investment Status')
                            <span>
                                @php echo $invest->statusBadge @endphp
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Other Information')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Total Paid')
                            <span>{{ showAmount($invest->paid) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Total Paid Time')
                            <span>{{ $invest->period }} @lang(' times')</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Should Pay')
                            <span>
                                @if ($invest->return_type != -1)
                                    {{ showAmount($invest->recuring_pay) }}
                                @else
                                    **
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Last Paid Time')
                            <span>{{ showDateTime($invest->last_time) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Next Pay Time')
                            <span>{{ showDateTime($invest->next_time) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            @lang('Capital Back')
                            <span>
                                @if ($invest->capital_status)
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

    <div class="row mt-4">
        <div class="col-lg-12">
            <h5 class="my-2">@lang('All Interests')</h5>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('TRX')</th>
                                <th>@lang('Transacted')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Details')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td><strong>{{ $trx->trx }}</strong></td>
                                    <td>{{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                    </td>

                                    <td class="budget">
                                            <span
                                                class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                                {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                            </span>
                                    </td>

                                    <td class="budget">
                                        {{ showAmount($trx->post_balance) }}
                                    </td>

                                    <td>{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($transactions->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($transactions) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.report.invest.history') }}"/>
@endpush
