@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-xxl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 has-link b-radius--5 bg--info">
                <div class="widget-two__content">
                    <h2 class="text-white">{{ $totalInvestCount }}</h2>
                    <p class="text-white">@lang('Total Invest Count')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xxl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--success has-link">
                <div class="widget-two__content">
                    <h2 class="text-white">{{ showAmount($totalInvestAmount) }}</h2>
                    <p class="text-white">@lang('Total Invest')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xxl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--7 has-link">
                <div class="widget-two__content">
                    <h2 class="text-white">{{ showAmount($totalPaid) }}</h2>
                    <p class="text-white">@lang('Total Paid')</p>
                </div>
            </div><!-- widget-two end -->
        </div>


        <div class="col-lg-12">
            <div class="show-filter mb-3 text-end">
                <button class="btn btn-outline--primary showFilterBtn btn-sm" type="button"><i
                        class="las la-filter"></i> @lang('Filter')</button>
            </div>
            <div class="card responsive-filter-card mb-4">
                <div class="card-body">
                    <form>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label>@lang('Project/Username')</label>
                                <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Return Type')</label>
                                <select class="form-control select2" name="type" data-minimum-results-for-search="-1">
                                    <option value="">@lang('All')</option>
                                    <option
                                        value="repeat" @selected(request()->type == 'repeat')>@lang('Repeat')</option>
                                    <option
                                        value="lifetime" @selected(request()->type == 'lifetime')>@lang('Lifetime')</option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Status')</label>
                                <select class="form-control select2" name="status" data-minimum-results-for-search="-1">
                                    <option value="">@lang('All')</option>
                                    <option value="1" @selected(request()->status == '1')>@lang('Live')</option>
                                    <option value="2" @selected(request()->status == '2')>@lang('Canceled')</option>
                                    <option value="0" @selected(request()->status == '0')>@lang('Closed')</option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Date')</label>
                                <x-search-date-field :icon="false"/>
                            </div>
                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn--primary w-100 h-45"><i
                                        class="fas fa-filter"></i> @lang('Filter')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Project Name')</th>
                                <th>@lang('Quantity')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Profit')</th>
                                <th>@lang('To Pay')</th>
                                <th>@lang('Paid')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($invests as $invest)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $invest->user->fullname }}</span>
                                        <br>
                                        <span class="small"> <a
                                                href="{{ appendQuery('search', $invest->user->username) }}"><span>@</span>{{ $invest->user->username }}</a> </span>
                                    </td>
                                    <td>{{ __($invest->project->title) }}</td>
                                    <td>{{ $invest->quantity }} @lang('Pcs')</td>
                                    <td>{{ showAmount($invest->total_price) }}</td>
                                    <td>{{ showAmount($invest->total_earning) }}</td>
                                    <td>{{ $invest->should_pay != -1 ? showAmount($invest->recuring_pay) : '**' }}</td>
                                    <td>{{ showAmount($invest->paid) }}</td>
                                    <td>
                                        @php echo $invest->statusBadge @endphp
                                    </td>
                                    <td>
                                        <div class="button--group">
                                            <a class="btn btn-outline--primary btn-sm"
                                               href="{{ route('admin.report.invest.details', $invest->id) }}"><i
                                                    class="las la-desktop"></i>@lang('Details')</a>
                                            <button class="btn btn-outline--danger btn-sm cancelBtn"
                                                    data-invest_id="{{ $invest->id }}" @disabled($invest->status != Status::INVEST_RUNNING)>
                                                <i class="las la-times"></i>@lang('Cancel')</button>
                                        </div>
                                    </td>
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
                @if ($invests->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($invests) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    {{--    <div class="modal fade" id="cancelModal">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h4 class="modal-title">@lang('Cancel Investment')</h4>--}}
    {{--                    <button class="close" data-bs-dismiss="modal" type="button"><span><i--}}
    {{--                                class="las la-times"></i></span></button>--}}
    {{--                </div>--}}
    {{--                <form method="post" action="{{ route('admin.project.invest.cancel') }}">--}}
    {{--                    @csrf--}}
    {{--                    <div class="modal-body">--}}
    {{--                        <input name="invest_id" type="hidden">--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label>@lang('Action')</label>--}}
    {{--                            <select class="form-control select2" name="action" data-minimum-results-for-search="-1"--}}
    {{--                                    required>--}}
    {{--                                <option value="" hidden>@lang('Select One')</option>--}}
    {{--                                <option value="1">@lang('Capital Back & Interest remains in the user balance')</option>--}}
    {{--                                <option--}}
    {{--                                    value="2">@lang('Capital Back & Interest is deducted from the user balance')</option>--}}
    {{--                                <option--}}
    {{--                                    value="3">@lang('No Capital Back & Interest remains in the user balance')</option>--}}
    {{--                                <option--}}
    {{--                                    value="4">@lang('No Capital Back & Interest is deducted from the user balance')</option>--}}
    {{--                            </select>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button class="btn btn--primary w-100 h-45" type="submit"><i--}}
    {{--                                class="fa fa-send"></i> @lang('Submit')</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.cancelBtn').on('click', function () {
                let modal = $('#cancelModal');
                $('[name=invest_id]').val($(this).data('invest_id'));
                modal.modal('show');
            });
        })(jQuery)
    </script>
@endpush
