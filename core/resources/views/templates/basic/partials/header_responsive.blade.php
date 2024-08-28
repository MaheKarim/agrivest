<div class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="navbar-left">
                <a class="navbar-brand logo" href="{{ route('home') }}">
                    <img src="{{ siteLogo() }}" alt="logo">
                </a>
            </div>

            <div class="navbar-right">
                <a class="navbar-brand logo d-block d-lg-none order-1" href="{{ route('home') }}">
                    <img src="{{ siteLogo() }}" alt="logo">
                </a>
                <button class="navbar-toggler header-button order-3 order-lg-2" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false">
                        <span id="hiddenNav">
                            <i class="las la-bars"></i>
                        </span>
                </button>
                <div class="navbar-collapse collapse order-4 order-lg-3" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-menu ms-auto align-items-lg-center">
                        <li class="nav-item">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">


                                @if (gs('multi_language'))
                                    @php
                                        $languages = App\Models\Language::all();
                                        $selectedLang = $languages->where('code', session('lang'))->first();
                                    @endphp
                                    <div class="dropdown dropdown--lang style-two d-lg-none">
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
                                                         src="{{ getImage(getFilePath('language') . '/' . $lang->image, getFileSize('language')) }}"
                                                         alt="@lang('Language Flag')">
                                                    <span>
                                                        {{ __($lang->name) }}
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(auth()->check())
                                    <a class="btn btn--white d-sm-none" href="{{ route('user.home') }}">
                                        @lang('Dashboard')
                                    </a>
                                @else
                                    <a class="btn btn--white d-sm-none" href="{{ route('user.register') }}">
                                        @lang('Register')
                                    </a>
                                @endif
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="offers.html">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.html">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-buttons order-2 order-lg-4">
                    <ul class="badge-btn-list style-two d-flex d-lg-none">
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


                    @if(auth()->check())
                        <a class="btn btn--white d-none d-sm-inline-block" href="{{ route('user.home') }}">
                            @lang('Dashboard')
                        </a>
                    @else
                        <a class="btn btn--white d-none d-sm-inline-block" href="{{ route('user.register') }}">
                            @lang('Register')
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
