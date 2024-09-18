@php
    $breadcrumbContent = getContent('breadcrumb.content', true);
@endphp

<section class="breadcrumb py-70 bg-img"
    data-background-image="{{ frontendImage('breadcrumb', @$breadcrumbContent->data_values->image, '1920x174') }}">
    <div class="container">
        <h1 class="breadcrumb__title">{{ $pageTitle }}</h1>
    </div>
</section>
