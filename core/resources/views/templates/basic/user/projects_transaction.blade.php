@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-inner__block">
        <div class="dashboard-card">
            <div class="table-responsive--md  table-responsive">
                <table class="table table--responsive--sm">
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
                                <td>{{ showDateTime($trx->created_at) }}
                                    <br>{{ diffForHumans($trx->created_at) }}
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
                                <td class="text-center" colspan="100%">{{ __($emptyMessage) }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($transactions->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($transactions) }}
            </div>
        @endif
    </div>
@endsection
