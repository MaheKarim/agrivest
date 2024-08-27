@extends($activeTemplate . 'layouts.app')
@section('main-content')
    @stack('fbComment')
    @include($activeTemplate . 'partials.header')
    <main class="page-wrapper">
        @yield('content')
    </main>
    @include($activeTemplate . 'partials.footer')
@endsection
