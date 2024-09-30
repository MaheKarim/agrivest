@extends($activeTemplate . 'layouts.app')
@php
    $authContent = getContent('login_registration.content', true);
@endphp
@section('panel')
    <section class="account">
        <div class="account-left bg-img"
             data-background-image="{{ frontendImage('login_registration', @$authContent->data_values->image, '1168x1080') }}">
            <a class="account-logo" href="{{ route('home') }}">
                <img src="{{ siteLogo() }}" alt="logo">
            </a>
        </div>
        <div class="account-right">
            <form class="account-form verify-gcaptcha" action="{{ route('user.login') }}" method="POST">
                @csrf
                <div class="account-form__header">
                    <a class="account-logo d-lg-none" href="{{ route('home') }}">
                        <img src="{{ siteLogo('dark') }}" alt="Logo">
                    </a>
                    <div class="account-form-headings">
                        <span class="account-form-headings__subtitle">@lang('Welcome back')</span>
                        <h5 class="account-form-headings__title">@lang('Sign in Account')</h5>
                    </div>
                </div>

                <div class="account-form__body">
                    <div class="form-group">
                        <label class="form-label form--label">@lang('Username or Email')</label>
                        <input class="form-control form--control" type="text" name="username"
                               value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form--label">@lang('Password')</label>
                        <div class="input-group input--group input--group-password">
                            <input class="form-control form--control" type="password" name="password" required>
                            <button class="input-group-text input-group-btn" type="button">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <x-captcha/>
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check form--check">
                                <input class="form-check-input" type="checkbox" name="remember" value="all"
                                       id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember-me"> @lang('Remember Me')
                                </label>
                            </div>
                            <a class="account-form__link"
                               href="{{ route('user.password.request') }}">@lang('Forgot your password?')</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn--lg btn--base btn--action w-100" id="recaptcha" type="submit">
                            @lang('Login')
                        </button>
                    </div>
                </div>
                <div class="account-form__footer">
                    @include($activeTemplate . 'partials.social_login')
                    <p class="account-form__cta-text">
                        @lang("Don't have on account?")
                        <a class="account-form__link" href="{{ route('user.register') }}">@lang('Sign Up')
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>
@endsection
