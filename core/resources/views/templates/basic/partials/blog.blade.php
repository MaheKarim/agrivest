@foreach ($blogs as $blog)
    <div class="col-sm-6 col-lg-4">
        <article class="card card--blog">
            <a href="{{ route('blog.details', $blog->slug) }}" class="card-thumb">
                <img src="{{ frontendImage('blog', 'thumb_' . $blog->data_values->image, '416x193') }}"
                    alt="{{ __($blog->data_values->title) }}">
            </a>
            <div class="card-body">
                <h6 class="card-title">
                    <a href="{{ route('blog.details', $blog->slug) }}">{{ __($blog->data_values->title) }}</a>
                </h6>
                <ul class="blog-meta">
                    <li class="card-meta__item">
                        <span class="blog-meta-item__icon"><i class="fas fa-calendar-days"></i></span>
                        <span class="blog-meta-item__text">{{ __(showDateTime($blog->created_at)) }}</span>
                    </li>
                </ul>
                <p class="card-desc">
                    @php echo substr(strip_tags($blog->data_values->description), 0, 100) @endphp
                </p>
                <a class="btn btn--sm btn--outline"
                    href="{{ route('blog.details', $blog->slug) }}">@lang('Read More')</a>
            </div>
        </article>
    </div>
@endforeach
