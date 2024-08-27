@php
    $credential = gs('socialite_credentials');
@endphp
@if (
    @$credential->facebook->status == Status::ENABLE ||
        @$credential->google->status == Status::ENABLE ||
        @$credential->linkedin->status == Status::ENABLE)
    <div class="account-form-social-login">
        <span class="account-form-social-login__title">
            @lang('Or Sign In With Social Media')
        </span>

        <div class="account-social-login">
            @if (@$credential->facebook->status == Status::ENABLE)
                <a href="{{ route('user.social.login', 'facebook') }}" class="account-social-login__link facebook">
                    <i class="fab fa-facebook"></i>
                    @lang('Facebook')
                </a>
            @endif
            @if (@$credential->google->status == Status::ENABLE)
                <a href="{{ route('user.social.login', 'google') }}" class="account-social-login__link google">
                    <i class="fab fa-google"></i>
                    @lang('Google')
                </a>
            @endif
            @if (@$credential->linkedin->status == Status::ENABLE)
                <a href="{{ route('user.social.login', 'linkedin') }}" class="account-social-login__link linkedin">
                    <i class="fab fa-linkedin"></i>
                    @lang('Linkedin')
                </a>
            @endif
        </div>
    </div>

@endif
