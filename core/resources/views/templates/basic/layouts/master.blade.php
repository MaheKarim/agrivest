@extends($activeTemplate . 'layouts.app')
@section('panel')
    @include($activeTemplate . 'partials.header')
    <main class="page-wrapper">
        @if(!request()->routeIs('home'))
            @include($activeTemplate . 'partials.breadcrumb')
        @endif
        <section class="dashboard py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        @include($activeTemplate . 'partials.sidebar_dashboard')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="dashboard-inner">
                            <div class="dashboard-inner__block d-lg-none">
                                <button type="button"
                                        class="btn btn--outline btn--white d-inline-flex align-items-center gap-2"
                                        data-toggle="offcanvas-sidebar" data-target="#dashboard-offcanvas-sidebar">
                                    <i class="fas fa-bars"></i>
                                    <span>@lang('Open Menu')</span>
                                </button>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
