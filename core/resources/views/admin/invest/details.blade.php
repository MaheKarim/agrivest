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
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.invest.index') }}" />
@endpush
