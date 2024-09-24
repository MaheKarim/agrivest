@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-inner__block">
        <div class="notice"></div>
        <div class="row gy-3">
            @if (auth()->user()->kv != Status::KYC_UNVERIFIED)
                <div class="col-xsm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none">
                    @else
                        <div class="col-xsm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            @endif
                            @php
                                $kyc = getContent('kyc.content', true);
                            @endphp
                            @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
                                <div class="kyc-cards">
                                    <div class="kyc-rejection-alert">
                                        <div class="kyc-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="kyc-content">
                                            <h6>@lang('KYC Documents Rejected')</h6>
                                            <p>{{ __(@$kyc->data_values->reject) }}</p>
                                            <div class="kyc-actions">
                                                <a href="{{ route('user.kyc.form') }}"
                                                   class="btn btn-sm btn-primary">@lang('Re-submit Documents')</a>
                                                <a href="{{ route('user.kyc.data') }}"
                                                   class="btn btn-sm btn-secondary">@lang('View KYC Data')</a>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#kycRejectionReason">@lang('Show Reason')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif(auth()->user()->kv == Status::KYC_UNVERIFIED)
                                <div class="kyc-cards">
                                    <div class="kyc-verification-required">
                                        <div class="kyc-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="kyc-content">
                                            <h6>@lang('KYC Verification Required')</h6>
                                            <p>{{ __(@$kyc->data_values->required) }}</p>
                                            <a href="{{ route('user.kyc.form') }}"
                                               class="btn btn-sm btn-primary">@lang('Submit Documents')</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif(auth()->user()->kv == Status::KYC_PENDING)
                                <div class="kyc-cards">
                                    <div class="kyc-verification-pending">
                                        <div class="kyc-icon">
                                            <i class="fas fa-hourglass-half"></i>
                                        </div>
                                        <div class="kyc-content">
                                            <h6>@lang('KYC Verification pending')</h6>
                                            <p>{{ __(@$kyc->data_values->pending) }}</p>
                                            <a href="{{ route('user.kyc.data') }}"
                                               class="btn btn-sm btn-warning">@lang('See KYC Data')</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-xsm-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="dashboard-analytics-card">
                                <div class="dashboard-analytics-card__top">
                                    <div class="dashboard-analytics-card__thumb">
                                        @include('components.balance-svg')
                                    </div>
                                </div>

                                <div class="dashboard-analytics-card__content">
                                    <span class="dashboard-analytics-card__name">@lang('Total Balance')</span>
                                    <h5 class="dashboard-analytics-card__total">{{ __(showAmount($user->balance)) }}</h5>
                                </div>

                                <div class="dashboard-analytics-card__overlay-icon">
                                    @include('components.balance-overlay-svg')
                                </div>
                            </div>
                        </div>

                        <div class="col-xsm-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="dashboard-analytics-card">
                                <div class="dashboard-analytics-card__top">
                                    <div class="dashboard-analytics-card__thumb">
                                        @include('components.project-svg')
                                    </div>
                                    <a class="btn btn--xsm btn--outline"
                                       href="{{ route('user.projects') }}">@lang('See all')</a>
                                </div>

                                <div class="dashboard-analytics-card__content">
                                    <span class="dashboard-analytics-card__name">@lang('Total Invested Projects')</span>
                                    <h5 class="dashboard-analytics-card__total">{{ __($investData['invest_count']) }}</h5>
                                </div>

                                <div class="dashboard-analytics-card__overlay-icon">
                                    @include('components.project-overlay-svg')
                                </div>
                            </div>
                        </div>

                        <div class="col-xsm-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="dashboard-analytics-card">
                                <div class="dashboard-analytics-card__top">
                                    <div class="dashboard-analytics-card__thumb">
                                        @include('components.invest-svg')
                                    </div>
                                    <a class="btn btn--xsm btn--outline"
                                       href="{{ route('user.transactions') }}">@lang('See all')</a>
                                </div>

                                <div class="dashboard-analytics-card__content">
                                    <span class="dashboard-analytics-card__name">@lang('Total Invest')</span>
                                    <h5 class="dashboard-analytics-card__total">{{ __(showAmount($investData['total_invest'])) }}</h5>
                                </div>

                                <div class="dashboard-analytics-card__overlay-icon">
                                    @include('components.invest-overlay-svg')
                                </div>
                            </div>
                        </div>

                        <div class="col-xsm-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="dashboard-analytics-card">
                                <div class="dashboard-analytics-card__top">
                                    <div class="dashboard-analytics-card__thumb">
                                        @include('components.profit-svg')
                                    </div>
                                    <a class="btn btn--xsm btn--outline"
                                       href="{{ route('user.transactions') }}">@lang('See all')</a>
                                </div>

                                <div class="dashboard-analytics-card__content">
                                    <span class="dashboard-analytics-card__name">@lang('My Profit Amount')</span>
                                    <h5 class="dashboard-analytics-card__total">{{ __(showAmount($investData['total_earning'])) }}
                                    </h5>
                                </div>

                                <div class="dashboard-analytics-card__overlay-icon">
                                    @include('components.profit-overlay-svg')
                                </div>
                            </div>
                        </div>

                        <div class="col-xsm-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="dashboard-analytics-card">
                                <div class="dashboard-analytics-card__top">
                                    <div class="dashboard-analytics-card__thumb">
                                        @include('components.deposit-svg')
                                    </div>
                                    <a class="btn btn--xsm btn--outline"
                                       href="{{ route('user.deposit.history') }}">@lang('See all')</a>
                                </div>

                                <div class="dashboard-analytics-card__content">
                                    <span class="dashboard-analytics-card__name">@lang('Total Deposit')</span>
                                    <h5 class="dashboard-analytics-card__total">{{ __(showAmount($investData['total_deposit'])) }}
                                    </h5>
                                </div>

                                <div class="dashboard-analytics-card__overlay-icon">
                                    @include('components.deposit-overlay-svg')
                                </div>
                            </div>
                        </div>

                        <div class="col-xsm-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="dashboard-analytics-card">
                                <div class="dashboard-analytics-card__top">
                                    <div class="dashboard-analytics-card__thumb">
                                        @include('components.withdraw-svg')
                                    </div>
                                    <a class="btn btn--xsm btn--outline"
                                       href="{{ route('user.withdraw.history') }}">@lang('See all')</a>
                                </div>

                                <div class="dashboard-analytics-card__content">
                                    <span class="dashboard-analytics-card__name">@lang('Total Withdraw')</span>
                                    <h5 class="dashboard-analytics-card__total">{{ __(showAmount($investData['total_withdraw'])) }}
                                    </h5>
                                </div>

                                <div class="dashboard-analytics-card__overlay-icon">
                                    @include('components.withdraw-overlay-svg')
                                </div>
                            </div>
                        </div>
                </div>
        </div>
        @include($activeTemplate . 'partials.invest_data')

        @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
            <div class="modal fade" id="kycRejectionReason">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">@lang('KYC Document Rejection Reason')</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ auth()->user()->kyc_rejection_reason }}</p>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@endsection
