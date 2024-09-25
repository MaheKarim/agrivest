@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="offers-page py-120">
        <div class="container">
            <div class="offers-page-top">
                <div class="row flex-wrap-reverse align-items-center">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <form class="offers-search" id="searchForm">
                            <div class="input-group input--group">
                                <span class="input-group-text">
                                    <img src="{{asset($activeTemplateTrue.'images/svg/search.svg')}}" alt="">
                                </span>
                                <input class="form-control form--control" type="text" id="searchQuery" name="search"
                                       placeholder="@lang('Type Keyword')">
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-9">
                        <div class="offers-control">
                            <ul class="offers-btn-list">
                                <li class="offers-btn-grid__item">
                                    <button type="button" class="layout-switcher-btn list-grid-btn active"
                                            title="Grid View" data-list-grid-class="col-sm-6 col-xl-4">
                                        @include('components.grid-icon', ['class' => 'icon-class'])
                                    </button>
                                </li>

                                <li class="offers-btn-list__item">
                                    <button type="button" class="layout-switcher-btn list-grid-btn" title="List View"
                                            data-list-grid-class="col-sm-12">
                                        @include('components.bar-icon', ['class' => 'icon-class'])
                                    </button>
                                </li>

                                <li class="offers-btn-list__item d-lg-none">
                                    <button class="offcanvas-sidebar-toggler" type="button"
                                            data-toggle="offcanvas-sidebar"
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
                            <form id="filterForm">
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
                                                                   name="category[]"
                                                                   value="{{ $category->id }}"
                                                                   id="category-{{$category->id}}">
                                                            <label class="form-check-label"
                                                                   for="category-{{$category->id}}">{{ __($category->name) }}</label>
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
                                        <span class="offcanvas-sidebar-block__title">@lang('Return Type')</span>
                                    </button>

                                    <div class="collapse show" id="offcanvas-sidebar-collapse-2">
                                        <div class="offcanvas-sidebar-block__content">
                                            <ul class="offcanvas-sidebar-list">
                                                <li class="offcanvas-sidebar-list__item">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="return_type[]"
                                                               value="-1"
                                                               id="high_return">
                                                        <label class="form-check-label"
                                                               for="high_return">@lang('Life Time')</label>
                                                    </div>
                                                </li>
                                                <li class="offcanvas-sidebar-list__item">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="return_type[]"
                                                               value="2" id="long_duration">
                                                        <label class="form-check-label"
                                                               for="long_duration">@lang('Repeated')</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-8 col-xl-9">
                    @include($activeTemplate.'.projects.project', ['projects' => $projects])
                    @if($projects->hasPages())
                        <ul class="pagination">
                            {{ paginateLinks($projects) }}
                        </ul>
                    @endif
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
        (function ($) {
            $(document).ready(function () {
                function fetchProjects(viewType) {
                    $.ajax({
                        url: "{{ route('project.filter') }}",
                        type: 'GET',
                        data: $('#searchForm').serialize() + '&' + $('#filterForm').serialize() + '&viewType=' + viewType,
                        success: function (response) {
                            $("#singleProject").html(response.view);
                        },
                        error: function (response) {
                            console.log('Error:', response);
                        }
                    });
                }

                $('#searchForm').on('submit', function (e) {
                    e.preventDefault();
                    fetchProjects('grid');
                });
                $('#filterForm input[name="category[]"]').on('change', function () {
                    fetchProjects('grid');
                });
                $('#filterForm input[name="return_type[]"]').on('change', function () {
                    fetchProjects('grid');
                });

                $(".list-grid-btn").on('click', function () {
                    const listGridClass = $(this).data("list-grid-class");
                    const viewType = listGridClass === "col-sm-6 col-xl-4" ? 'grid' : 'list';

                    $(".list-grid-btn").removeClass("active");
                    $(this).addClass("active");

                    fetchProjects(viewType);
                });
            });
        })(jQuery);
    </script>
@endpush
