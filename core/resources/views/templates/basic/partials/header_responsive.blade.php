<div class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="navbar-left">
                <a class="navbar-brand logo" href="{{ route('home') }}">
                    <img src="{{ siteLogo() }}" alt="@lang('logo')">
                </a>
            </div>

            <div class="navbar-right">
                <a class="navbar-brand logo d-block d-lg-none order-1" href="{{ route('home') }}">
                    <img src="{{ siteLogo() }}" alt="@lang('logo')">
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
                            <a class="nav-link" href="{{ route('projects') }}">@lang('Projects')</a>
                        </li>
                        @foreach($pages as $page)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $page->slug }}">{{__($page->name)}}</a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blogs') }}">@lang('Blogs')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-buttons order-2 order-lg-4">
                    
                    @if(auth()->check())
                        @php
                            $user = auth()->user();
                        @endphp
                        <div class="dropdown dropdown--user">
                            <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img
                                    src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}"
                                    alt="@lang('User Image')">
                            </div>

                            <div class="dropdown-menu dropdown-menu-end ">
                                <div class="user-info">
                                    <div class="user-info__thumb">
                                        <img
                                            src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}"
                                            alt="@lang('User Image')">
                                    </div>

                                    <div class="user-info__content">
                                        <h6 class="user-info__name">{{ $user->fullName }}</h6>
                                        <span class="user-info__email">{{ $user->email }}</span>
                                    </div>
                                </div>

                                <div class="dropdown-item-wrapper">
                                    <a class="dropdown-item" href="{{ route('user.home') }}">
                                        <i class="fas fa-chart-simple"></i>
                                        <span>@lang('Dashboard')</span>
                                    </a>

                                    <a class="dropdown-item" href="projects.html">
                                        <i class="fas fa-table-list"></i>
                                        <span>@lang('My Projects')</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.profile.setting') }}">
                                        <i class="fas fa-user-circle"></i>
                                        <span>@lang('My Profile')</span>
                                    </a>
                                    <a class="dropdown-item logout" href="{{ route('user.logout') }}">
                                        <i class="fas fa-sign-out"></i>
                                        <span>@lang('Logout')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
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
