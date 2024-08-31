@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="offers-page py-120">
        <div class="container">
            <div class="offers-page-top">
                <div class="row flex-wrap-reverse align-items-center">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <form class="offers-search" action="">
                            <div class="input-group input--group">
                                <span class="input-group-text">
                                    <img src="{{asset($activeTemplateTrue.'images/svg/search.svg')}}" alt="">
                                </span>
                                <input class="form-control form--control" type="text" placeholder="Type Keyword">
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-9">
                        <div class="offers-control">

                            <ul class="offers-btn-list">
                                <li class="offers-btn-list__item">
                                    <button type="button" class="layout-switcher-btn active list-grid-btn" title="Grid View" data-list-grid-class="col-sm-6 col-xl-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <g id="Grid Icon">
                                                <g id="Group">
                                                    <path id="Vector"
                                                        d="M8.90594 2H4.31281C3.03754 2 2 3.03754 2 4.31281V8.90594C2 10.1812 3.03754 11.2188 4.31281 11.2188H8.90594C10.1812 11.2188 11.2188 10.1812 11.2188 8.90594V4.31281C11.2188 3.03754 10.1812 2 8.90594 2ZM9.65625 8.90594C9.65625 9.31965 9.31965 9.65625 8.90594 9.65625H4.31281C3.8991 9.65625 3.5625 9.31965 3.5625 8.90594V4.31281C3.5625 3.8991 3.8991 3.5625 4.31281 3.5625H8.90594C9.31965 3.5625 9.65625 3.8991 9.65625 4.31281V8.90594ZM19.6562 2H15.125C13.8327 2 12.7812 3.05141 12.7812 4.34375V8.875C12.7812 10.1673 13.8327 11.2188 15.125 11.2188H19.6562C20.9486 11.2188 22 10.1673 22 8.875V4.34375C22 3.05141 20.9486 2 19.6562 2ZM20.4375 8.875C20.4375 9.30578 20.087 9.65625 19.6562 9.65625H15.125C14.6942 9.65625 14.3438 9.30578 14.3438 8.875V4.34375C14.3438 3.91297 14.6942 3.5625 15.125 3.5625H19.6562C20.087 3.5625 20.4375 3.91297 20.4375 4.34375V8.875ZM8.90594 12.7812H4.31281C3.03754 12.7812 2 13.8188 2 15.0941V19.6872C2 20.9625 3.03754 22 4.31281 22H8.90594C10.1812 22 11.2188 20.9625 11.2188 19.6872V15.0941C11.2188 13.8188 10.1812 12.7812 8.90594 12.7812ZM9.65625 19.6872C9.65625 20.1009 9.31965 20.4375 8.90594 20.4375H4.31281C3.8991 20.4375 3.5625 20.1009 3.5625 19.6872V15.0941C3.5625 14.6804 3.8991 14.3438 4.31281 14.3438H8.90594C9.31965 14.3438 9.65625 14.6804 9.65625 15.0941V19.6872ZM19.6562 12.7812H15.125C13.8327 12.7812 12.7812 13.8327 12.7812 15.125V19.6562C12.7812 20.9486 13.8327 22 15.125 22H19.6562C20.9486 22 22 20.9486 22 19.6562V15.125C22 13.8327 20.9486 12.7812 19.6562 12.7812ZM20.4375 19.6562C20.4375 20.087 20.087 20.4375 19.6562 20.4375H15.125C14.6942 20.4375 14.3438 20.087 14.3438 19.6562V15.125C14.3438 14.6942 14.6942 14.3438 15.125 14.3438H19.6562C20.087 14.3438 20.4375 14.6942 20.4375 15.125V19.6562Z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </li>

                                <li class="offers-btn-list__item">
                                    <button type="button" class="layout-switcher-btn list-grid-btn"  title="List View" data-list-grid-class="col-sm-12">
                                        <svg width="20" height="20" viewBox="0 0 20 20">
                                            <path
                                                d="M1.33333 20C0.598 20 0 19.3714 0 18.5984V16.9549C0 16.1819 0.598 15.5533 1.33333 15.5533H2.89733C3.63267 15.5533 4.23067 16.1819 4.23067 16.9549V18.5984C4.23067 19.3714 3.63267 20 2.89733 20H1.33333ZM7.384 19.1779C6.64867 19.1779 6.05067 18.5493 6.05067 17.7763C6.05067 17.0033 6.64867 16.3747 7.384 16.3747H18.6667C19.402 16.3747 20 17.0033 20 17.7763C20 18.5493 19.402 19.1779 18.6667 19.1779H7.384ZM1.33333 12.2237C0.598 12.2237 0 11.5951 0 10.8221V9.17794C0 8.40493 0.598 7.7763 1.33333 7.7763H2.89733C3.63267 7.7763 4.23067 8.40493 4.23067 9.17794V10.8221C4.23067 11.5951 3.63267 12.2237 2.89733 12.2237H1.33333ZM7.384 11.4016C6.64867 11.4016 6.05067 10.773 6.05067 10C6.05067 9.227 6.64867 8.59836 7.384 8.59836H18.6667C19.402 8.59836 20 9.227 20 10C20 10.773 19.402 11.4016 18.6667 11.4016H7.384ZM1.33333 4.4467C0.598 4.4467 0 3.81807 0 3.04506V1.40164C0 0.628636 0.598 0 1.33333 0H2.89733C3.63267 0 4.23067 0.628636 4.23067 1.40164V3.04506C4.23067 3.81807 3.63267 4.4467 2.89733 4.4467H1.33333ZM7.384 3.62534C6.64867 3.62534 6.05067 2.99671 6.05067 2.2237C6.05067 1.4507 6.64867 0.822062 7.384 0.822062H18.6667C19.402 0.822062 20 1.4507 20 2.2237C20 2.99671 19.402 3.62534 18.6667 3.62534H7.384Z" />
                                        </svg>
                                    </button>
                                </li>

                                <li class="offers-btn-list__item d-lg-none">
                                    <button class="offcanvas-sidebar-toggler" type="button" data-toggle="offcanvas-sidebar"
                                        data-target="#offers-offcanvas-sidebar">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <aside id="offers-offcanvas-sidebar" class="offcanvas-sidebar offcanvas-sidebar--offers">
                        <div class="offcanvas-sidebar__header">
                            <button type="button" class="btn--close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="offcanvas-sidebar__body">
                            <form action="">
                                <div class="offcanvas-sidebar-block">
                                    <button class="offcanvas-sidebar-block__btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#offcanvas-sidebar-collapse-1" aria-expanded="true">
                                        <span class="offcanvas-sidebar-block__title">@lang('Category')</span>
                                    </button>
                                    <div class="collapse show" id="offcanvas-sidebar-collapse-1">
                                        <div class="offcanvas-sidebar-block__content">
                                            <ul class="offcanvas-sidebar-list">
                                                @foreach ($categories as $category)
                                                    <li class="offcanvas-sidebar-list__item">
                                                        <div class="form-check form--check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $category->id }}" id="category-1">
                                                            <label class="form-check-label"
                                                                for="category-1">{{ __($category->name) }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="offcanvas-sidebar-block">
                                    <button class="offcanvas-sidebar-block__btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#offcanvas-sidebar-collapse-2" aria-expanded="true">
                                        <span class="offcanvas-sidebar-block__title">@lang('Time Duration')</span>
                                    </button>

                                    <div class="collapse show" id="offcanvas-sidebar-collapse-2">
                                        <div class="offcanvas-sidebar-block__content">
                                            <ul class="offcanvas-sidebar-list">
                                                <li class="offcanvas-sidebar-list__item">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" type="checkbox" value="high_return"
                                                            id="time-duration-1">
                                                        <label class="form-check-label"
                                                            for="time-duration-1">@lang('High
                                                                                                                                                                                    Return')</label>
                                                    </div>
                                                </li>
                                                <li class="offcanvas-sidebar-list__item">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="long_duration" id="time-duration-2">
                                                        <label class="form-check-label"
                                                            for="time-duration-2">@lang('Long
                                                                                                                                                                                    Duration')</label>
                                                    </div>
                                                </li>
                                                <li class="offcanvas-sidebar-list__item">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="short_duration" id="time-duration-3">
                                                        <label class="form-check-label"
                                                            for="time-duration-3">@lang('Short
                                                                                                                                                                                    Duration')</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="offcanvas-sidebar-block">
                                    <button class="btn btn--lg btn-outline--base w-100" type="submit">
                                        @lang('Filter Now')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>


                <div class="col-lg-8 col-xl-9">
                    <div class="row gy-4">
                        @foreach ($projects as $project)
                            <div class="col-sm-6 col-xl-4 single-project">
                                <article class="card card--offer style-two">
                                    <div class="card-header">
                                        <a class="btn-favourite" type="button" href="#">
                                            <i class="fas fa-heart"></i>
                                        </a>

                                        <a class="card-thumb" href="{{ route('project.details', $project->slug) }}">
                                            <img src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                                                alt="">
                                        </a>

                                        <div class="card-offer">
                                            <span class="card-offer__label">@lang('ROI')</span>
                                            <span
                                                class="card-offer__percentage">{{ __(getAmount($project->roi_percentage)) }}@lang('%')</span>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a
                                                href="{{ route('project.details', $project->slug) }}">{{ __($project->title) }}</a>
                                        </h6>

                                        <div class="card-content">
                                            <div class="card-content__wrapper">
                                                <span class="card-content__label">@lang('Per Share')</span>
                                                <div class="card-content__price">
                                                    {{ __(showAmount($project->share_amount)) }}</div>
                                            </div>
                                            <a href="{{ route('project.details', $project->slug) }}"
                                                class="btn btn--xsm btn--outline">@lang('Book Now')</a>
                                        </div>
                                        <div class="card-bottom">
                                            <span class="card-bottom__unit">@lang('Remaining:') 10 Units</span>
                                            <span
                                                class="card-bottom__duration">{{ __(diffForHumans($project->end_date)) }}</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="las la-arrow-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="las la-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($){
            console.log(441454);

            $(".list-grid-btn").on('click',function(e){
                const listGridClass=$(this).data("list-grid-class");
                
                // $(".single-project").removeClass().addClass(listGridClass)
            });
        })(jQuery)
    </script>
@endpush
