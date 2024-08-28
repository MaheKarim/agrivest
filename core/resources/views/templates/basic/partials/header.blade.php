@php
    $socialLinks = getContent('social_icon.element',false, orderById:true);
@endphp
<header class="header" id="header">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top__item one">
                    <ul class="social-list">
                        @foreach ($socialLinks as $socialLink)
                            <li class="social-list__item">
                                <a href="{{ @$socialLink->data_values->url }}" class="social-list__link"
                                   target="_blank">
                                    @php echo @$socialLink->data_values->social_icon @endphp
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="header-top__item two">
                    <p class="header-top__text">
                        <span>Get more profit</span> by invest in OX farming industry
                    </p>
                    <p class="header-top__text">
                        Happy Investment with us in <span>7.5% ROI</span>
                    </p>
                </div>

                <div class="header-top__item three">
                    <ul class="badge-btn-list">
                        <li class="badge-btn-list__item">
                            <a href="favourite-offers.html" class="badge-btn-list__link">
                                <i class="fas fa-heart"></i>
                                <span class="badge badge--dark">2</span>
                            </a>
                        </li>
                        <li class="badge-btn-list__item">
                            <a href="#" class="badge-btn-list__link">
                                <i class="fas fa-bell"></i>
                                <span class="badge badge--dark">2</span>
                            </a>
                        </li>
                    </ul>

                    @if (gs('multi_language'))
                        @php
                            $languages = App\Models\Language::all();
                            $selectedLang = $languages->where('code', session('lang'))->first();
                        @endphp
                        <div class="dropdown dropdown--lang">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <img class="dropdown-flag"
                                     src="{{ getImage(getFilePath('language') . '/' . $selectedLang->image, getFileSize('language')) }}"
                                     alt="@lang('Language Flag')">
                                <span>{{ __($selectedLang->name) }}</span>
                            </button>

                            <div class="dropdown-menu">
                                @foreach ($languages as $lang)
                                    <a class="dropdown-item" href="{{ route('lang', $lang->code) }}">
                                        <img class="dropdown-flag"
                                             src="{{ getImage(getFilePath('language') . '/' . @$lang->image, getFileSize('language')) }}"
                                             alt="@lang('Language Flag')">
                                        <span>{{ __($lang->name) }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include($activeTemplate.'partials.header_responsive')
</header>
