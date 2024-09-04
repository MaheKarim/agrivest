@php
    $user = auth()->user();
@endphp
<aside id="dashboard-offcanvas-sidebar" class="offcanvas-sidebar offcanvas-sidebar--dashboard">
    <div class="offcanvas-sidebar__header">
        <div class="user-info">
            <div class="user-info__thumb">
                <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}"
                     alt="@lang('User Profile Image')">
            </div>

            <div class="user-info__content">
                <h6 class="user-info__name">{{ $user->fullName }}</h6>
                <span class="user-info__email">{{ $user->email }}</span>
            </div>
        </div>

        <button type="button" class="btn--close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="offcanvas-sidebar__body">
        <ul class="offcanvas-sidebar-menu">
            <li class="offcanvas-sidebar-menu__item {{ menuActive('user.home') }}">
                <a class="offcanvas-sidebar-menu__link" href="{{ route('user.home') }}">
                    <i class="fas fa-chart-simple"></i>
                    <span>@lang('Dashboard')</span>
                </a>
            </li>

            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link {{ menuActive('user.projects*') }}"
                   href="{{ route('user.projects') }}">
                    <i class="fas fa-table-list"></i>
                    <span>@lang('My Projects')</span>
                </a>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <button class="offcanvas-sidebar-menu__btn collapsed" data-bs-toggle="collapse"
                        data-bs-target="#offcanvas-sidebar-deposit-collapse" aria-expanded="false" type="button">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>@lang('Deposit')</span>
                </button>

                <div class="collapse" id="offcanvas-sidebar-deposit-collapse">
                    <ul class="offcanvas-sidebar-submenu" {{ menuActive('user.deposit*') }}>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.deposit.index') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.deposit.index') }}">
                                @lang('Deposit Now')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.deposit.history') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.deposit.history') }}">
                                @lang('Deposit History')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <button class="offcanvas-sidebar-menu__btn collapsed" data-bs-toggle="collapse"
                        data-bs-target="#offcanvas-sidebar-withdraw-collapse" aria-expanded="false" type="button">
                    <i class="fas fa-building-columns"></i>
                    <span>@lang('Withdraw')</span>
                </button>

                <div class="collapse" id="offcanvas-sidebar-withdraw-collapse">
                    <ul class="offcanvas-sidebar-submenu" {{ menuActive('user.withdraw*') }}>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.withdraw') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.withdraw') }}">
                                @lang('Withdraw Money')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.withdraw.history') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.withdraw.history') }}">
                                @lang('Withdraw History')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link {{ menuActive('user.transactions*') }}"
                   href="{{ route('user.transactions') }}">
                    <i class="fas fa-clock-rotate-left"></i>
                    <span>@lang('Transactions')</span>
                </a>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <button class="offcanvas-sidebar-menu__btn collapsed" data-bs-toggle="collapse"
                        data-bs-target="#offcanvas-sidebar-support-collapse" aria-expanded="false" type="button">
                    <i class="fas fa-headset"></i>
                    <span>@lang('Support Ticket')</span>
                </button>

                <div class="collapse" id="offcanvas-sidebar-support-collapse">
                    <ul class="offcanvas-sidebar-submenu">
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('ticket.open') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('ticket.open') }}">
                                @lang('Create New')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item ">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('ticket.index') }}">
                                @lang('My Tickets')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="offcanvas-sidebar-menu__item">
                <button class="offcanvas-sidebar-menu__btn collapsed" data-bs-toggle="collapse"
                        data-bs-target="#offcanvas-sidebar-settings-collapse" aria-expanded="false" type="button">
                    <i class="fas fa-gear"></i>
                    <span>@lang('Settings')</span>
                </button>

                <div class="collapse" id="offcanvas-sidebar-settings-collapse">
                    <ul class="offcanvas-sidebar-submenu" {{ menuActive('user.*') }}>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.profile.setting') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.profile.setting') }}">
                                @lang('Edit Profile')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.change.password') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.change.password') }}">
                                @lang('Change Password')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item {{ menuActive('user.twofactor') }}">
                            <a class="offcanvas-sidebar-submenu__link" href="{{ route('user.twofactor') }}">
                                @lang('Enable 2FA')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link logout" href="{{ route('user.logout') }}">
                    <i class="fas fa-sign-out"></i>
                    <span>@lang('Logout')</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
