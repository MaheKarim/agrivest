@extends($activeTemplate.'layouts.frontend')
@php
    $contactInfo = getContent('contact_us.content',true);
@endphp
@section('content')
    <section class="contact-page py-120 bg--white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="contact-page__wrapper">
                        <div class="contact-map">
                            <iframe src="{{ @$contactInfo->data_values->map }}">
                            </iframe>
                        </div>

                        <div class="contact-info">
                            <h5 class="contact-info__title">@lang('Contact with Us')</h5>

                            <ul class="contact-list">
                                <li class="contact-list-item">
                                    <div class="contact-list-item__icon">
                                        <img src="{{ asset($activeTemplateTrue.'images/icons/location.png') }}" alt="Icon">
                                    </div>

                                    <div class="contact-list-item__content">
                                        <h6 class="contact-list-item__title">@lang('Office Address')</h6>
                                        <p class="contact-list-item__text">{{ __(@$contactInfo->data_values->address) }}</p>
                                    </div>
                                </li>

                                <li class="contact-list-item">
                                    <div class="contact-list-item__icon">
                                        <img src="{{ asset($activeTemplateTrue.'images/icons/send.png') }}" alt="@lang('Office Icon')">
                                    </div>

                                    <div class="contact-list-item__content">
                                        <h6 class="contact-list-item__title">@lang('Email Address')</h6>
                                        <a class="contact-list-item__link" href="mailto:{{ @$contactInfo->data_values->email_address }}"></a>
                                      {{ __(@$contactInfo->data_values->email_address) }}
                                    </div>
                                </li>

                                <li class="contact-list-item">
                                    <div class="contact-list-item__icon">
                                        <img src="{{ asset($activeTemplateTrue.'images/icons/phone.png') }}" alt="@lang('Phone Image')">
                                    </div>

                                    <div class="contact-list-item__content">
                                        <h6 class="contact-list-item__title">@lang('Phone Number')</h6>
                                        <a class="contact-list-item__link" href="tel:{{ __(@$contactInfo->data_values->contact_number) }}"></a>
                                        {{ __(@$contactInfo->data_values->contact_number) }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8">
                    <form class="contact-form mt-120 verify-gcaptcha" method="post">
                        @csrf
                        <h4 class="contact-form__title">@lang("Let`s Talk with US")</h4>

                        <div class="row">
                            <div class="col-sm-12">
                                <input name="name" type="text" class="form-control form--control" value="{{ old('name',@$user->fullname) }}" @if($user && $user->profile_complete) readonly @endif required
                                       placeholder="@lang('Full Name')">
                            </div>
                            <div class="col-sm-12">
                                <input class="form-control form--control" type="text" placeholder="@lang('Email Address')" name="email" value="{{  old('email',@$user->email) }}" @if($user) readonly @endif required>
                            </div>
                            <div class="col-sm-12">
                                <input name="subject" type="text" class="form-control form--control" value="{{old('subject')}}" required placeholder="@lang('Subject')">
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form-control form--control"  name="message" placeholder="@lang('Message')">{{old('message')}}</textarea>
                            </div>
                            <x-captcha />
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn--lg btn--base">@lang('Send Message')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if(@$sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
