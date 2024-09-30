@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30 text-center">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <img src="{{ getImage(getFilePath('userProfile') . '/' . @$invest->user->image, getFileSize('userProfile')) }}"
                                    alt="@lang('Profile Image')" class="b-radius--10" style="max-width: 100px;">
                            </div>
                            <div>
                                <h4 class="mb-1">
                                    <a href="{{ route('admin.users.detail', $invest->user->id) }}"
                                        class="text--primary">{{ @$invest->user->fullname }}</a>
                                </h4>
                                <p class="mb-0">{{ @$invest->user->email }}</p>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text--small">@lang('Name')</span>
                                <span class="text--small"><strong>{{ @$invest->user->fullname }}</strong></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text--small">@lang('Username')</span>
                                <span class="text--small"><strong>{{ @$invest->user->username }}</strong></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text--small">@lang('Email')</span>
                                <span class="text--small"><strong>{{ @$invest->user->email }}</strong></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text--small">@lang('Invest ID')</span>
                                <span class="text--small"><strong>{{ $invest->invest_no }}</strong></span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('admin.users.notification.single', $invest->user->id) }}"
                                class="btn btn-outline--primary btn-sm w-100"><i class="las la-paper-plane"></i>
                                @lang('Send Notification')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            @include('admin.partials.invest_details')
        </div>

        <div class="col-12">
            <h5 class="my-2">@lang('All Interests')</h5>
            <div class="card mb-5">
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
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}
                                        </td>
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
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.invest.index') }}" />

    <!-- Stop/Start Returns Button -->
    @if ($invest->project->return_type == Status::LIFETIME && $invest->status == Status::INVEST_RUNNING)
        <!-- Button for stopping returns -->
        <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure you want to stop the returns for this investment?')"
            data-action="{{ route('admin.invest.stop.returns', $invest->id) }}">
            <i class="las la-times"></i>
            @lang('Stop Returns')
        </button>
    @elseif ($invest->project->return_type == Status::LIFETIME && $invest->status == Status::INVEST_CLOSED)
        <!-- Button for starting returns -->
        <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-question="@lang('Are you sure you want to start the returns for this investment?')"
            data-action="{{ route('admin.invest.start.returns', $invest->id) }}">
            <i class="las la-play-circle"></i>
            @lang('Start Returns')
        </button>
    @endif
@endpush
