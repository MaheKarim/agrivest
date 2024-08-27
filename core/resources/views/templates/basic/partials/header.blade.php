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
                            <a href="{{ @$socialLink->data_values->url }}" class="social-list__link" target="_blank">
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
                    <div class="dropdown dropdown--lang">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="dropdown-flag" src="assets/images/icons/en.png" alt="">
                            <span>English</span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                                <img class="dropdown-flag" src="assets/images/icons/bn.png" alt="">
                                <span>Bangla</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <img class="dropdown-flag" src="assets/images/icons/es.png" alt="">
                                <span>Spanish</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <img class="dropdown-flag" src="assets/images/icons/fr.png" alt="">
                                <span>French</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    <div class="dropdown dropdown--lang style-two d-lg-none">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <img class="dropdown-flag" src="assets/images/icons/en.png" alt="">
                                            <span>English</span>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">
                                                <img class="dropdown-flag" src="assets/images/icons/bn.png"
                                                    alt="">
                                                <span>Bangla</span>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <img class="dropdown-flag" src="assets/images/icons/es.png"
                                                    alt="">
                                                <span>Spanish</span>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <img class="dropdown-flag" src="assets/images/icons/fr.png"
                                                    alt="">
                                                <span>French</span>
                                            </a>
                                        </div>
                                    </div>


                                    <a class="btn btn--white d-sm-none" href="{{ route('user.register') }}">
                                        @lang('Register')
                                    </a>

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
                            <a class="btn btn--white d-none d-sm-inline-block" href="{{ route('user.register') }}">
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
</header>
