@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-details py-120">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8 col-xl-9">
                    <div class="blog-details__wrapper">
                        <div class="blog-details__thumb">
                            <img src="{{ frontendImage('blog', @$blog->data_values->image, '966x450') }}" class="w-100 mb-3"
                                alt="Blog">
                        </div>
                        <h1 class="blog-details__title">
                            {{ __($blog->data_values->title) }}
                        </h1>
                        <ul class="blog-meta">
                            <li class="card-meta__item">
                                <span class="blog-meta-item__icon"><i class="fas fa-calendar-days"></i></span>
                                <span class="blog-meta-item__text">{{ __(showDateTime($blog->created_at)) }}</span>
                            </li>
                        </ul>
                        <div class="blog-details__content">
                            @php echo $blog->data_values->description @endphp
                        </div>
                        <div class="blog-details-share">
                            <h6 class="blog-details-share__title">@lang('Share This')</h6>
                            <ul class="social-list">
                                <li class="social-list__item">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://twitter.com/intent/tweet?text= {{ __(strLimit($blog->data_values->title, 150)) }}&amp;url={{ urlencode(url()->current()) }}"
                                        class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __(strLimit($blog->data_values->title, 150)) }}&amp;summary={{ __(strLimit(strip_tags(@$blog->data_values->description_nic), 300)) }}"
                                        class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ __(@$blog->data_values->title) }}&media={{ frontendImage('blog', $blog->data_values->image, '966x450') }}"
                                        class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="fb-comments" data-href="{{ route('blog.details', slug($blog->data_values->title)) }}"
                        data-numposts="5"></div>
                </div>

                <div class="col-lg-4 col-xl-3">
                    <div class="blog-sidebar">
                        <div class="blog-sidebar-block">
                            <h6 class="blog-sidebar-block__title">@lang('Latest Blogs')</h6>
                            <ul class="blog-list">
                                @foreach ($latestBlogs as $blog)
                                    <li class="blog-list-item">
                                        <a class="blog-list-item__thumb" href="{{ route('blog.details', $blog->slug) }}">
                                            <img class="blog-list-item__thumb"
                                                src="{{ frontendImage('blog', 'thumb_' . $blog->data_values->image, '416x193') }}"
                                                alt="@lang('Blog')">
                                        </a>
                                        <div class="blog-list-item__content">
                                            <h6 class="blog-list-item__title">
                                                <a
                                                    href="{{ route('blog.details', $blog->slug) }}">{{ __($blog->data_values->title) }}</a>
                                            </h6>
                                            <span
                                                class="blog-list-item__date">{{ __(showDateTime($blog->created_at)) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
