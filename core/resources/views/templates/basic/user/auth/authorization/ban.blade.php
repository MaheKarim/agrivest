@php
    $banContent = getContent('banned.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="user-section py-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banned-content">
                        <h2 class="text--danger fw-bold mb-3">@lang('Banned Account')</h2>
                        <p class="mb-4">@lang('Your account has been banned due to the following reason:')</p>
                        <div class="alert alert-danger custom-alert p-3 mb-4">
                            <p class="fw-bold mb-1">@lang('Reason'):</p>
                            <p class="mb-0">{{ __($user->ban_reason) }}</p>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn--lg btn--base">@lang('Go To Home')</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ frontendImage('banned', @$banContent->data_values->image, '1920x646') }}"
                        alt="@lang('Banned')" class="img-fluid ban-image">
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .banned-content {
            padding-right: 20px;
        }

        .ban-image {
            max-width: 100%;
            height: auto;
        }

        .custom-alert {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 8px;
            text-align: left;
        }

        .text--danger {
            color: #dc3545;
        }

        .user-section {
            background: #f3f4f7;
            padding: 60px 0;
        }
    </style>
@endpush
