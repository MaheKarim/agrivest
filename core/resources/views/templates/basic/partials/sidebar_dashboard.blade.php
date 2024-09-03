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
            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link" href="{{ route('user.home') }}">
                    <i class="fas fa-chart-simple"></i>
                    <span>@lang('Dashboard')</span>
                </a>
            </li>

            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link" href="projects.html">
                    <i class="fas fa-table-list"></i>
                    <span>@lang('My Projects')</span>
                </a>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link" href="deposit.html">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>@lang('Deposit')</span>
                </a>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link" href="withdraw.html">
                    <i class="fas fa-building-columns"></i>
                    <span>@lang('Withdraw')</span>
                </a>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <a class="offcanvas-sidebar-menu__link" href="transactions.html">
                    <i class="fas fa-clock-rotate-left"></i>
                    <span>@lang('Transactions')</span>
                </a>
            </li>
            <li class="offcanvas-sidebar-menu__item">
                <button class="offcanvas-sidebar-menu__btn collapsed" data-bs-toggle="collapse"
                        data-bs-target="#offcanvas-sidebar-menu-collapse" aria-expanded="false" type="button">
                    <i class="fas fa-gear"></i>
                    <span>@lang('Settings')</span>
                </button>

                <div class="collapse" id="offcanvas-sidebar-menu-collapse">
                    <ul class="offcanvas-sidebar-submenu">
                        <li class="offcanvas-sidebar-submenu__item">
                            <a class="offcanvas-sidebar-submenu__link" href="edit-profile.html">
                                @lang('Edit Profile')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item">
                            <a class="offcanvas-sidebar-submenu__link" href="#">
                                @lang('Change Password')
                            </a>
                        </li>
                        <li class="offcanvas-sidebar-submenu__item">
                            <a class="offcanvas-sidebar-submenu__link" href="#">
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
