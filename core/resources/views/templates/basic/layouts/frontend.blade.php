@extends($activeTemplate . 'layouts.app')
@section('panel')
    @stack('fbComment')
    @include($activeTemplate . 'partials.header')
    <main class="page-wrapper">
        @if (!request()->routeIs('home'))
            @include($activeTemplate . 'partials.breadcrumb')
        @endif
        @yield('content')
    </main>

    @include($activeTemplate . 'partials.footer')
@endsection
