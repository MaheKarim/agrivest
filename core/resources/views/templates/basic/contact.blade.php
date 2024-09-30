@extends($activeTemplate . 'layouts.frontend')
@php
    $contactInfo = getContent('contact_us.content', true);
@endphp
@section('content')
    <section class="contact-page">
        <div class="contact-page-top pt-120 pb-60">
            <div class="container">
                <div class="row gy-5 justify-content-between align-items-start">
                    <div class="col-lg-12">
                        <ul class="contact-list">
                            <li class="contact-list-item one">
                                <div class="contact-list-item__icon">
                                    <i class="las la-envelope"></i>
                                </div>
                                <div class="contact-list-item__content">
                                    <h6 class="contact-list-item__title">@lang('Mail Us')</h6>
                                    <a class="contact-list-item__link"
                                        href="mailto:{{ @$contactInfo->data_values->email_address }}">
                                        {{ __(@$contactInfo->data_values->email_address) }}
                                    </a>
                                </div>
                            </li>
                            <li class="contact-list-item two">
                                <div class="contact-list-item__icon">
                                    <i class="las la-phone"></i>
                                </div>
                                <div class="contact-list-item__content">
                                    <h6 class="contact-list-item__title">@lang('Phone')</h6>
                                    <a class="contact-list-item__link"
                                        href="tel:{{ __(@$contactInfo->data_values->contact_number) }}">
                                        {{ __(@$contactInfo->data_values->contact_number) }}
                                    </a>
                                </div>
                            </li>
                            <li class="contact-list-item three">
                                <div class="contact-list-item__icon">
                                    <i class="las la-map-marker"></i>
                                </div>
                                <div class="contact-list-item__content">
                                    <h6 class="contact-list-item__title">@lang('Location')</h6>
                                    <p class="contact-list-item__text">
                                        {{ __(@$contactInfo->data_values->address) }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div class="card custom--card">
                            <div class="card-body">
                                <form class="contact-form verify-gcaptcha" method="post">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <label class="form-label form--label required"
                                                for="username">@lang('Full Name')</label>
                                            <input name="name" type="text" class="form-control form--control"
                                                value="{{ old('name', @$user->fullname) }}" required
                                                placeholder="@lang('Full Name')"
                                                @if ($user && $user->profile_complete) readonly @endif>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label form--label required"
                                                for="username">@lang('Email')</label>
                                            <input class="form-control form--control" type="text"
                                                placeholder="@lang('Email Address')" name="email"
                                                value="{{ old('email', @$user->email) }}"
                                                @if ($user) readonly @endif required>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label form--label required"
                                                for="username">@lang('Subject')</label>
                                            <input name="subject" type="text" class="form-control form--control"
                                                value="{{ old('subject') }}" required placeholder="@lang('Subject')">
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label form--label required"
                                                for="username">@lang('Message')</label>
                                            <textarea class="form-control form--control" name="message" placeholder="@lang('Message')">{{ old('message') }}</textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-captcha />
                                            <button type="submit"
                                                class="btn btn--lg btn--base w-100">@lang('Send Message')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-page-botom">
            <div class="contact-map">
                <iframe src="{{ @$contactInfo->data_values->map }}" width="100%" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
