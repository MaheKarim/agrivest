@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-inner__block">
        <form method="post">
            @csrf
            <div class="dashboard-card">
                <div class="dashboard-card__body">
                    <div class="row">
                        <div class="form-group">
                            <label class="form-label form--label">@lang('Current Password')</label>
                            <input type="password" class="form-control form--control" name="current_password" required
                                autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label class="form-label form--label">@lang('Password')</label>
                            <input type="password"
                                class="form-control form--control @if (gs('secure_password')) secure-password @endif"
                                name="password" required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label class="form-label form--label">@lang('Confirm Password')</label>
                            <input type="password" class="form-control form--control" name="password_confirmation" required
                                autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button class="btn btn--lg btn--base btn--action w-100" type="submit">@lang('Submit')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('style')
    <style>
        .hover-input-popup .input-popup {
            left: 17% !important;
            bottom: calc(100% - 20px) !important;
        }
    </style>
@endpush
