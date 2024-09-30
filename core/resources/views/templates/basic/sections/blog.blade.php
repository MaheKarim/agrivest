@php
    $blogContent = getContent('blog.content', true);
    $blogs = getContent('blog.element', false, 3, orderById: true);
@endphp
<section class="our-blogs pt-70 pb-120 bg--white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
                <div class="section-heading">
                    <div class="section-heading__sec-name">
                        <img class="me-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                        <span>{{ __($blogContent->data_values->small_heading) }}</span>
                        <img class="ms-2" src="{{ siteFavicon() }}" alt="@lang('Favicon')">
                    </div>
                    <h3 class="section-heading__title">{{ __($blogContent->data_values->heading) }}</h3>
                    <p class="section-heading__desc">{{ __($blogContent->data_values->subheading) }} </p>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            @include($activeTemplate . 'partials.blog')
        </div>
    </div>
</section>
