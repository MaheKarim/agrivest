@extends($activeTemplate.'layouts.frontend')

@section('content')
    <section class="blogs py-120 bg--white">
        <div class="container">
            <div class="row gy-4">
                @include($activeTemplate.'partials.blog')
            </div>
        </div>
    </section>

    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endSection
