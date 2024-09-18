@php
    $policyPages = getContent('policy_pages.element', false, orderById:true);
    $contactInfo = getContent('contact_us.content', true);
    $appStores = getContent('contact_us.element', orderById: true);
    $socialIcons = getContent('social_icon.element', orderById: true);
    $latestProjects = \App\Models\Project::active()->beforeEndDate()->limit(4)->get();
@endphp
<footer class="footer">
    <div class="footer-top py-120">
        <div class="container">
            <div class="row gy-4 gy-sm-5 gy-lg-0 justify-content-md-between justify-content-lg-start">
                <div class="col-sm-6 col-lg-3 order-1">
                    <div class="footer-item">
                        <a class="footer-item__logo" href="{{ route('home') }}">
                            <img src="{{ siteLogo() }}" alt="@lang('Site Logo')">
                        </a>
                        <p class="footer-item__desc">{{ __(@$contactInfo->data_values->short_details) }}</p>
                    </div>
                </div>
                <div class="col-5 col-sm-4 col-md-3 col-lg-2 order-3 order-lg-2">
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Quick Links')</h6>
                        <ul class="footer-menu">
                            <li class="footer-menu__item">
                                <a class="footer-menu__link" href="{{ route('home') }}">@lang('Home')</a>
                            </li>
                            <li class="footer-menu__item">
                                <a class="footer-menu__link" href="{{ route('blogs') }}">@lang('Blogs')</a>
                            </li>
                            <li class="footer-menu__item">
                                <a class="footer-menu__link" href="{{ route('contact') }}">@lang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-7 col-sm-4 col-md-3 col-lg-2 order-4 order-lg-3">
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Latest Projects')</h6>
                        <ul class="footer-menu">
                            @foreach($latestProjects as $project)
                                <li class="footer-menu__item">
                                    <a class="footer-menu__link" href="{{ route('project.details', $project->slug) }}">
                                        {{ __(Str::limit($project->title, 20)) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-5 col-sm-4 col-md-3 col-lg-2 order-5 order-lg-4">
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Legal')</h6>
                        <ul class="footer-menu">
                            @foreach($policyPages as $page)
                                <li class="footer-menu__item">
                                    <a class="footer-menu__link" href="{{ route('policy.pages', $page->slug) }}"
                                       target="_blank">
                                        {{ __(@$page->data_values->title) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-7 col-sm-6 col-lg-3 order-2 order-lg-5">
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Contact Info')</h6>

                        <ul class="contact-list">
                            <li class="contact-list__item">
                                <i class="fas fa-location-dot"></i>
                                <span class="contact-list__text">
                                    {{ __(@$contactInfo->data_values->address) }}
                                </span>
                            </li>
                            <li class="contact-list__item">
                                <i class="fas fa-phone-volume"></i>
                                <a class="contact-list__link"
                                   href="tel:{{ __(@$contactInfo->data_values->contact_number) }}">
                                    {{ __(@$contactInfo->data_values->contact_number) }}
                                </a>
                            </li>
                            <li class="contact-list__item">
                                <i class="fas fa-envelope"></i>
                                <a class="contact-list__link"
                                   href="mailto:{{ __(@$contactInfo->data_values->email_address) }}">
                                    {{ __(@$contactInfo->data_values->email_address) }}
                                </a>
                            </li>
                        </ul>

                        <div class="footer-item__social-links">
                            <span class="title">@lang('Follow Us')</span>
                            <ul class="social-list style-two">
                                @foreach($socialIcons as $link)
                                    <li class="social-list__item">
                                        <a href="{{ @$link->data_values->url }}" class="social-list__link flex-center"
                                           target="_blank">
                                            @php
                                                echo @$link->data_values->social_icon
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-bottom__text text-center">
                @lang('Copyright') <a href="{{ route('home') }}" class="text--base"> {{ config('app.name')}}</a>
                &copy; @php echo date('Y') @endphp @lang('All rights reserved.')
            </p>
        </div>
    </div>
</footer>
