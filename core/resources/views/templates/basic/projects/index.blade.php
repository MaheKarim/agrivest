@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="offers-page py-120">
        <div class="container">
            <div class="offers-page-top">
                <div class="row gy-3 align-items-center">
                    <div class="col-sm-12 col-lg-4 col-xl-3">
                        <form class="offers-search" id="searchForm">
                            <div class="input-group input--group">
                                <span class="input-group-text search-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M11.0461 4C7.16097 4 4 7.16097 4 11.0461C4 14.9314 7.16097 18.0921 11.0461 18.0921C14.9314 18.0921 18.0921 14.9314 18.0921 11.0461C18.0921 7.16097 14.9314 4 11.0461 4ZM11.0461 16.7913C7.87816 16.7913 5.30081 14.214 5.30081 11.0461C5.30081 7.87819 7.87816 5.30081 11.0461 5.30081C14.214 5.30081 16.7913 7.87816 16.7913 11.0461C16.7913 14.214 14.214 16.7913 11.0461 16.7913Z" />
                                        <path
                                            d="M19.8095 18.8897L16.0805 15.1607C15.8264 14.9066 15.4149 14.9066 15.1608 15.1607C14.9067 15.4146 14.9067 15.8265 15.1608 16.0804L18.8898 19.8094C18.9501 19.8699 19.0218 19.9179 19.1007 19.9506C19.1796 19.9833 19.2642 20.0001 19.3496 20C19.435 20.0001 19.5196 19.9833 19.5986 19.9506C19.6775 19.9179 19.7491 19.8699 19.8095 19.8094C20.0636 19.5555 20.0636 19.1436 19.8095 18.8897Z" />
                                    </svg>
                                </span>
                                <input class="form-control form--control search-box" type="text" name="search"
                                    placeholder="@lang('Type Keyword')">
                            </div>
                        </form>

                    </div>

                    <div class="col-sm-12 col-lg-8 col-xl-9">
                        <div class="offers-control">
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <p class="offers-control__results">@lang('Result'): <span>{{ @$count ?? 0 }}
                                        @lang('Items Found')</span></p>

                                <div class="d-flex align-items-center">
                                    <ul class="offers-btn-list ml-3 d-flex align-items-center">
                                        <li class="offers-btn-grid__item">
                                            <button type="button"
                                                class="layout-switcher-btn list-grid-btn {{ session('viewType', 'grid') == 'grid' ? 'active' : '' }}"
                                                title="Grid View" data-list-grid-class="col-sm-6 col-xl-4">
                                                @include('components.grid-icon', ['class' => 'icon-class'])
                                            </button>

                                        </li>

                                        <li class="offers-btn-list__item ml-2">
                                            <button type="button"
                                                class="layout-switcher-btn list-grid-btn {{ session('viewType') == 'list' ? 'active' : '' }}"
                                                title="List View" data-list-grid-class="col-sm-12">
                                                @include('components.bar-icon', ['class' => 'icon-class'])
                                            </button>
                                        </li>

                                        <li class="offers-btn-list__item d-lg-none">
                                            <button class="offcanvas-sidebar-toggler" type="button"
                                                data-toggle="offcanvas-sidebar" data-target="#offers-offcanvas-sidebar">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                                    <span class="offcanvas-sidebar-block__title">@lang('Price Filter')</span>
                                    <div class="offcanvas-sidebar-block__content overflow-visible">
                                        <div class="range-slider" data-min="{{ getAmount(@$minProjectPrice ?? 0) }}"
                                            data-max="{{ getAmount(@$maxProjectPrice ?? 0) }}"
                                            data-min-default="{{ getAmount(@$minProjectPrice ?? 0) }}"
                                            data-max-default="{{ getAmount(@$maxProjectPrice ?? 0) }}">
                                            <div class="range-slider__slide"></div>
                                            <div class="range-slider__inputs">
                                                <div class="input-group">
                                                    <span class="input-group-text">@lang('Min')</span>
                                                    <input id="min-range" name="min_price" class="form--control"
                                                        value="{{ getAmount(@$minProjectPrice ?? 0) }}" type="number"
                                                        placeholder="{{ getAmount(@$minProjectPrice ?? 0) }}"
                                                        min="{{ getAmount(@$minProjectPrice ?? 0) }}">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text">@lang('Max')</span>
                                                    <input id="max-range" class="form--control" type="number"
                                                        name="max_price" value="{{ getAmount(@$maxProjectPrice ?? 0) }}"
                                                        placeholder="{{ getAmount(@$maxProjectPrice ?? 0) }}"
                                                        min="{{ getAmount(@$minProjectPrice ?? 0) }}"
                                                        max="{{ getAmount(@$maxProjectPrice ?? 0) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="offcanvas-sidebar-block">
                                    <span class="offcanvas-sidebar-block__title">@lang('Category')</span>

                                    <div class="offcanvas-sidebar-block__content" data-toggle="overflow-content"
                                        data-target="#offcanvas-sidebar-block-btn-1">
                                        <ul class="offcanvas-sidebar-list">
                                            @foreach ($categories as $category)
                                                <li class="offcanvas-sidebar-list__item">
                                                    <div class="form-check form--check">
                                                        <input class="form-check-input" type="checkbox" name="category[]"
                                                            value="{{ $category->id }}" id="category-{{ $category->id }}">
                                                        <label class="form-check-label"
                                                            for="category-{{ $category->id }}">{{ __($category->name) }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <button id="offcanvas-sidebar-block-btn-1" class="offcanvas-sidebar-block__btn"
                                        type="button">
                                        <span>@lang('See more')</span>
                                        <i class="las la-angle-down"></i>
                                    </button>
                                </div>

                                <div class="offcanvas-sidebar-block">
                                    <span class="offcanvas-sidebar-block__title">@lang('Return Type')</span>

                                    <div class="offcanvas-sidebar-block__content" data-toggle="overflow-content"
                                        data-target="#offcanvas-sidebar-block-btn-2">
                                        <ul class="offcanvas-sidebar-list">
                                            <li class="offcanvas-sidebar-list__item">
                                                <div class="form-check form--check">
                                                    <input class="form-check-input" type="checkbox" name="return_type[]"
                                                        value="-1" id="high_return">
                                                    <label class="form-check-label"
                                                        for="high_return">@lang('Life Time')</label>
                                                </div>
                                            </li>
                                            <li class="offcanvas-sidebar-list__item">
                                                <div class="form-check form--check">
                                                    <input class="form-check-input" type="checkbox" name="return_type[]"
                                                        value="2" id="long_duration">
                                                    <label class="form-check-label"
                                                        for="long_duration">@lang('Repeated')</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <button id="offcanvas-sidebar-block-btn-2" class="offcanvas-sidebar-block__btn"
                                        type="button">
                                        <span>@lang('See more')</span>
                                        <i class="las la-angle-down"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-8 col-xl-9" id="singleProject">
                    @if (session('viewType') == 'list')
                        @include($activeTemplate . '.projects.list-project', ['projects' => $projects])
                    @else
                        @include($activeTemplate . '.projects.project', ['projects' => $projects])
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

@push('style')
    <style>
        .offers-control {
            background-color: hsl(var(--white));
            padding: 10px 10px;
            border-radius: 8px;
            border: 1px solid hsl(var(--gray-five));
        }

        .offers-control__results {
            margin-bottom: 0;
            color: hsl(var(--gray-three))
        }

        .offers-control__results span {
            font-weight: 500;
            color: hsl(var(--gray-two))
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            $(document).ready(function() {

                @if (session('viewType') == 'list')
                    var viewType = 'list';
                @else
                    var viewType = 'grid';
                @endif

                // ==================== Range Slider Js Start ================================
                var slide = $(".range-slider").find(".range-slider__slide");
                var minValue = $(".range-slider").data("min");
                var maxValue = $(".range-slider").data("max");

                var minDefaultValue = $(".range-slider").data("min-default");
                var maxDefaultValue = $(".range-slider").data("max-default");
                var minRange = $(".range-slider").find("#min-range");
                var maxRange = $(".range-slider").find("#max-range");

                // Initialize range slider
                var rangeSlider = $(slide).slider({
                    range: true,
                    animate: false,
                    min: minValue,
                    max: maxValue,
                    values: [minDefaultValue, maxDefaultValue],
                    slide: function(event, ui) {
                        $(minRange).val(ui.values[0]);
                        $(maxRange).val(ui.values[1]);
                    },
                    change: function(event, ui) {
                        // Update the input values on change event as well
                        $(minRange).val(ui.values[0]);
                        $(maxRange).val(ui.values[1]);

                        // Optional: You can trigger any additional actions when the slider changes, like updating filters.
                        console.log("Min Price: " + ui.values[0] + ", Max Price: " + ui.values[1]);
                        $('#searchForm').submit();
                    }
                });

                // If you want to update the slider values when the input fields are manually changed:
                $(minRange).on('change', function() {
                    console.log(899);
                    var minValue = $(this).val();
                    var maxValue = $(maxRange).val();
                    $(slide).slider("values", [minValue, maxValue]);
                });

                $(maxRange).on('change', function() {
                    console.log(999);

                    var minValue = $(minRange).val();
                    var maxValue = $(this).val();
                    $(slide).slider("values", [minValue, maxValue]);
                });

                // ========================== Range Slider Js End ============================

                function fetchProjects(viewType, page = 1) {
                    $.ajax({
                        url: "{{ route('project.filter') }}",
                        type: 'GET',
                        data: $('#searchForm').serialize() + '&' + $('#filterForm').serialize() +
                            '&viewType=' + viewType + '&page=' +
                            page, // Add the page number to the data
                        success: function(response) {
                            $("#singleProject").html(response.view);
                            // Update the result count
                            $('.offers-control__results span').text(response.totalProjects +
                                ' @lang('Items Found')');

                            console.log(response);
                        },
                        error: function(response) {
                            console.log('Error:', response);
                        }
                    });
                }
                // Pagination click event handling
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault(); // Prevent default behavior
                    var page = $(this).attr('href').split('page=')[
                        1]; // Get page number from the pagination link
                    var viewType = $('#viewType')
                        .val(); // Get the current viewType (adjust according to your setup)
                    fetchProjects(viewType, page); // Call fetchProjects with the page number
                });

                $('.search-icon').on('click', function(e) {
                    $('#searchForm').submit();
                });

                $('.search-box').on('blur', function() {
                    $('#searchForm').submit();
                });

                $('#searchForm').on('submit', function(e) {
                    e.preventDefault();
                    fetchProjects(viewType);
                });

                $('#filterForm input[name="category[]"]').on('change', function() {
                    fetchProjects(viewType);
                });
                $('#filterForm input[name="return_type[]"]').on('change', function() {
                    fetchProjects(viewType);
                });

                $(".list-grid-btn").on('click', function() {
                    const listGridClass = $(this).data("list-grid-class");
                    viewType = listGridClass === "col-sm-6 col-xl-4" ? 'grid' : 'list';

                    $(".list-grid-btn").removeClass("active");
                    $(this).addClass("active");

                    fetchProjects(viewType);
                });
            });
        })(jQuery);
    </script>
@endpush
