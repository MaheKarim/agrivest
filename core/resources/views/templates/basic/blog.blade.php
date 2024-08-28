@extends($activeTemplate.'layouts.frontend')

@section('content')
    @include($activeTemplate.'partials.blog')

    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endSection
