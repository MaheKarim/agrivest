@extends($activeTemplate . 'layouts.frontend')
@php
    $contactInfo = getContent('contact_us.content', true);
@endphp
@section('content')
    <section class="contact-page py-120 bg--white">
        <div class="container">
            <div class="row justify-content-between align-items-start">
                <div class="col-lg-4">
                    <div>
                        <h5 class="contact-info__title text--base">@lang('Contact with Us')</h5>
                        <p>@lang("Don't hesitate to reach out if you need assistance or information of any sort. We're here to help.")</p>

                        <ul class="contact-list">
                            <li class="contact-list-item mb-4 w-100">
                                <div class="contact-list-item__content p-4 rounded w-100"
                                     style="background-color: #e7f1ff;">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="las la-envelope text-primary fs-3 me-2"></i>
                                        <h6 class="contact-list-item__title mb-0">@lang('Mail Us')</h6>
                                    </div>
                                    <a class="contact-list-item__link text--base w-100"
                                       href="mailto:{{ @$contactInfo->data_values->email_address }}">
                                        {{ __(@$contactInfo->data_values->email_address) }}
                                    </a>
                                </div>
                            </li>

                            <li class="contact-list-item mb-4 w-100">
                                <div class="contact-list-item__content p-4 rounded w-100"
                                     style="background-color: #e6fff2;">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="las la-phone text-success fs-3 me-2"></i>
                                        <h6 class="contact-list-item__title mb-0">@lang('Phone')</h6>
                                    </div>
                                    <a class="contact-list-item__link text--base w-100"
                                       href="tel:{{ __(@$contactInfo->data_values->contact_number) }}">
                                        {{ __(@$contactInfo->data_values->contact_number) }}
                                    </a>
                                </div>
                            </li>

                            <li class="contact-list-item w-100">
                                <div class="contact-list-item__content p-4 rounded w-100"
                                     style="background-color: #fff1f1;">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="las la-map-marker text-danger fs-3 me-2"></i>
                                        <h6 class="contact-list-item__title mb-0">@lang('Location')</h6>
                                    </div>
                                    <p class="contact-list-item__text text--base mb-0 w-100">
                                        {{ __(@$contactInfo->data_values->address) }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card custom--card p-3">
                        <div class="card-body">
                            <form class="contact-form verify-gcaptcha" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <input name="name" type="text" class="form-control form--control"
                                               value="{{ old('name', @$user->fullname) }}" required
                                               placeholder="@lang('Full Name')"
                                               @if ($user && $user->profile_complete) readonly @endif>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <input class="form-control form--control" type="text"
                                               placeholder="@lang('Email Address')" name="email"
                                               value="{{ old('email', @$user->email) }}"
                                               @if ($user) readonly @endif required>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input name="subject" type="text" class="form-control form--control"
                                               value="{{ old('subject') }}" required placeholder="@lang('Subject')">
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <textarea class="form-control form--control" name="message"
                                                  placeholder="@lang('Message')">{{ old('message') }}</textarea>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <x-captcha/>
                                    </div>
                                    <div class="col-sm-12">
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
    </section>


    <div class="contact-map">
        <iframe src="{{ @$contactInfo->data_values->map }}" width="100%" height="450" style="border:0;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
