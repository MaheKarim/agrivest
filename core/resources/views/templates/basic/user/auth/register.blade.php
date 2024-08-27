@extends($activeTemplate . 'layouts.app')
@section('main-content')
    @if (gs('registration'))
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <div class="text-end">
                    <a href="{{ route('home') }}" class="fw-bold home-link"> <i class="las la-long-arrow-alt-left"></i> @lang('Go to Home')</a>
                </div>
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Register')</h5>
                    </div>

                    <div class="card-body">

                            @include($activeTemplate.'partials.social_login')

                            <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha disableSubmission">
                                @csrf
                                <div class="row">
                                    @if (session()->get('reference') != null)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="referenceBy" class="form-label">@lang('Reference by')</label>
                                                <input type="text" name="referBy" id="referenceBy" class="form-control form--control"
                                                    value="{{ session()->get('reference') }}" readonly>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('First Name')</label>
                                        <input type="text" class="form-control form--control" name="firstname" value="{{old("firstname")}}" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Last Name')</label>
                                        <input type="text" class="form-control form--control" name="lastname" value="{{old("lastname")}}" required>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang('E-Mail Address')</label>
                                            <input type="email" class="form-control form--control checkUser" name="email" value="{{ old('email') }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Password')</label>
                                            <input type="password"
                                                class="form-control form--control @if (gs('secure_password')) secure-password @endif"
                                                name="password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Confirm Password')</label>
                                            <input type="password" class="form-control form--control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <x-captcha />

                                </div>

                                @if (gs('agree'))
                                    @php
                                        $policyPages = getContent('policy_pages.element', false, orderById:true);
                                    @endphp
                                    <div class="form-group">
                                        <input type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                        <label for="agree">@lang('I agree with')</label> <span>
                                            @foreach ($policyPages as $policy)
                                                <a href="{{ route('policy.pages', $policy->slug) }}"
                                                    target="_blank">{{ __($policy->data_values->title) }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button type="submit" id="recaptcha" class="btn btn--base w-100"> @lang('Register')</button>
                                </div>
                                <p class="mb-0">@lang('Already have an account?') <a href="{{ route('user.login') }}">@lang('Login')</a></p>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <section class="account">
        <div class="account-left bg-img" data-background-image="{{ asset($activeTemplateTrue."images/thumbs/account-thumb.jpg")}}">
            <a class="account-logo" href="{{ route('home') }}">
                <img src="{{ siteLogo() }}" alt="Logo">
            </a>
        </div>
        <div class="account-right">
            <form class="account-form verify-gcaptcha disableSubmission" action="{{ route('user.register') }}" method="POST">
                @csrf
                <div class="account-form__header">
                    <a class="account-logo d-lg-none" href="{{ route('home') }}">
                        <img src="{{ siteLogo() }}" alt="Logo">
                    </a>

                    <div class="account-form-headings">
                        <span class="account-form-headings__subtitle">@lang('Welcome')</span>
                        <h5 class="account-form-headings__title">@lang('Register')</h5>
                    </div>
                </div>

                <div class="account-form__body">
                    <div class="row gy-3">
                        @if (session()->get('reference') != null)
                        <div class="col-sm-12">
                            <label class="form-label form--label" for="referenceBy">@lang('Reference by')</label>
                            <input class="form-control form--control" type="text" name="referBy" id="referenceBy" value="{{ session()->get('reference') }}" readonly>
                        </div>
                        @endif

                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('First Name')</label>
                            <input class="form-control form--control" type="text"  name="firstname" value="{{old("firstname")}}" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('Last Name')</label>
                            <input class="form-control form--control" type="text" name="lastname" value="{{old("lastname")}}" required>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label form--label">@lang('E-Mail Address')</label>
                            <input class="form-control form--control checkUser" type="email" name="email" value="{{ old('email') }}"
                                   required>
                        </div>

                        <div class="col-sm-12">
                            <label class="form--label">@lang('Password')</label>
                            <div class="input-group input--group input--group-password">
                                <input class="form-control form--control" type="password" placeholder="Password">
                                <button class="input-group-text input-group-btn" type="button">
                                    <i  class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check form--check">
                                    <input class="form-check-input" type="checkbox" value="all" id="remember-me">
                                    <label class="form-check-label" for="remember-me">Remember me</label>
                                </div>

                                <a class="account-form__link" href="#">Forget Password</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <button class="btn btn--lg btn--base btn--action w-100" type="submit">
                                Create Account
                            </button>
                        </div>
                    </div>
                </div>

                <div class="account-form__footer">
                    @include($activeTemplate . 'partials.social_login')

                    <p class="account-form__cta-text">
                        Don't have on account? <a class="account-form__link" href="registration.html">Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </section>

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('user.login') }}" class="btn btn--base btn-sm">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>

    @else
        @include($activeTemplate.'partials.registration_disabled')
    @endif

@endsection
@if (gs('registration'))

    @push('style')
        <style>
            .social-login-btn {
                border: 1px solid #cbc4c4;
            }
        </style>
    @endpush

    @if (gs('secure_password'))
        @push('script-lib')
            <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
        @endpush
    @endif

    @push('script')
        <script>
            "use strict";
            (function($) {

                $('.checkUser').on('focusout', function(e) {
                    var url = '{{ route('user.checkUser') }}';
                    var value = $(this).val();
                    var token = '{{ csrf_token() }}';

                    var data = {
                        email: value,
                        _token: token
                    }

                    $.post(url, data, function(response) {
                        if (response.data != false) {
                            $('#existModalCenter').modal('show');
                        }
                    });
                });
            })(jQuery);
        </script>
    @endpush

@endif
