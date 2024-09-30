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
                        <div class="custom-alert mb-4 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <p class="fw-bold mb-0">@lang('Reason'):</p>
                                <span class="text-dark date" style="font-size: 0.85rem;">
                                    {{ now()->format('l, dS F Y @ h:i a') }}
                                </span>
                            </div>
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
            border-left: 4px solid #dc3545;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            max-width: 454px;
        }

        .custom-alert p {
            margin-bottom: 8px;
        }

        .custom-alert .fw-bold {
            font-weight: bold;
        }

        .custom-alert .text-muted {
            font-size: 0.85rem;
        }

        .user-section {
            background: #f3f4f7;
            padding: 60px 0;
        }

        .text--danger {
            color: #dc3545;
        }

        .date {
            color: #828282 !important
        }

        @media only screen and (max-width: 768px) {
            .date {
                display: none
            }
        }
    </style>
@endpush
