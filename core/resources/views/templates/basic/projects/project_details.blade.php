@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="offer-details py-120  bg--white">
        <div class="container">
            <div class="offer-details-top">
                <div class="offer-details-thumb">
                    <a href="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                        data-rel="lightcase:my-slideshow">
                        <img src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                            alt="Project Image">
                    </a>


                    @if (!empty($project->gallery) && count($project->gallery) > 0)
                        @foreach ($project->gallery as $index => $gallery)
                            @if ($index < 5)
                                <a href="{{ getImage(getFilePath('project') . '/' . $gallery, getFileSize('project')) }}"
                                    data-rel="lightcase:my-slideshow">
                                    <img src="{{ getImage(getFilePath('project') . '/' . $gallery, getFileSize('project')) }}"
                                        alt="Project Gallery Image"></a>
                            @endif
                        @endforeach
                    @endif
                </div>

                @if (!empty($project->gallery) && count($project->gallery) > 0)
                    <div class="offer-details-slider d-lg-none">
                        <div class="offer-details-thumb-slider">
                            @foreach ($project->gallery as $index => $gallery)
                                @if ($index < 5)
                                    <div class="offer-details-thumb-slider__item">
                                        <img class="offer-details-thumb-slider__img"
                                            src="{{ getImage(getFilePath('project') . '/' . $gallery, getFileSize('project')) }}"
                                            alt="@lang('Project Image')" data-index="{{ $index }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="offer-details-preview-slider">
                            @foreach ($project->gallery as $index => $gallery)
                                @if ($index < 5)
                                    <div class="offer-details-preview-slider__item">
                                        <img class="offer-details-preview-slider__img"
                                            src="{{ getImage(getFilePath('project') . '/' . $gallery, getFileSize('project')) }}"
                                            alt="@lang('Project Image')">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="offer-details-bottom">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="offer-details-content">
                            <h1 class="offer-details-title">{{ __($project->title) }}</h1>

                            <ul class="offer-details-meta">
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('Per Share')</span>
                                    <span class="value">{{ __(showAmount($project->share_amount)) }}</span>
                                </li>
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('ROI')</span>
                                    <span
                                        class="value">{{ __(getAmount($project->roi_percentage)) }}@lang('%')</span>
                                </li>
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('Duration')</span>
                                    <span class="value">{{ $project->maturity_time }} @lang('Months')</span>
                                </li>
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('Max')</span>
                                    <span class="value">{{ __(getAmount($project->share_count)) }}
                                        @lang('Units')</span>
                                </li>
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('Remaining')</span>
                                    <span class="value">{{ __(getAmount($project->available_share)) }}
                                        @lang('Units')</span>
                                </li>
                            </ul>

                            <button class="btn btn--lg btn--base w-100 mt-4 d-lg-none" type="button"
                                data-toggle="offcanvas-sidebar" data-target="#offer-details-offcanvas-sidebar">
                                @lang('Check Details')
                            </button>

                            <div class="offer-details-desc">
                                <p>
                                    @php echo $project->description; @endphp
                                </p>
                            </div>

                            <div class="offer-details-block">
                                <h5 class="offer-details-block__title">@lang('Where This Project')</h5>

                                <div class="offer-details-block__map">
                                    <iframe src="{{ @$project->map_url }}"></iframe>
                                </div>
                            </div>
                            @if ($project->faqs->isNotEmpty())
                                <div class="offer-details-block">
                                    <h5 class="offer-details-block__title">@lang('Frequently Asked Questions')</h5>
                                    <div id="faq-accordion" class="accordion custom--accordion">
                                        @foreach ($project->faqs as $index => $faq)
                                            <div class="accordion-item {{ $index == 0 ? 'active' : '' }}">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#faq-accordion-question-{{ $index }}"
                                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                        aria-controls="faq-accordion-question-{{ $index }}">
                                                        {{ __($faq->question) }}
                                                    </button>
                                                </h2>
                                                <div id="faq-accordion-question-{{ $index }}"
                                                    class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                                    data-bs-parent="#faq-accordion">
                                                    <div class="accordion-body">
                                                        <p class="accordion-text">
                                                            {{ __($faq->answer) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($project->end_date > now())
                        <div class="col-lg-4" id="sidebar-container">
                            @include($activeTemplate . 'projects.sidebar')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include($activeTemplate . 'projects.buy-modal')
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lightcase.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/lightcase.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("a[data-rel^=lightcase]").lightcase();

                @if (!empty($project->gallery) && count($project->gallery) > 0)
                    $(".offer-details-thumb-slider").slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 1500,
                        dots: false,
                        arrows: false,
                        pauseOnHover: true,
                        asNavFor: ".offer-details-preview-slider",
                    });

                    $(".offer-details-preview-slider").slick({
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 1500,
                        dots: false,
                        arrows: false,
                        pauseOnHover: true,
                        asNavFor: ".offer-details-thumb-slider",
                        responsive: [{
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 3,
                            },
                        }, ],
                    });
                @endif

                var STATUS_LIFETIME = {{ Status::LIFETIME }};
                var STATUS_YES = {{ Status::YES }};

                var project = {
                    shareAmount: {{ $project->share_amount }},
                    roiAmount: {{ $project->roi_amount }},
                    roiPercentage: {{ $project->roi_percentage }},
                    capitalBack: {{ $project->capital_back }},
                    returnType: {{ $project->return_type }},
                    projectDuration: {{ $project->project_duration }},
                    repeatTimes: {{ @$project->repeat_times ?? 0 }},
                    timeName: '{{ $project->time->name }}',
                    timeHours: {{ $project->time->hours }},
                    availableShare: {{ $project->available_share }},
                    currencySymbol: '{{ gs('cur_sym') }}',
                    currencyText: '{{ gs('cur_text') }}'
                };

                $(document).on('click', '.qty-btn', function() {
                    changeQuantity(this);
                });

                // Event listener for manual input in the quantity field
                $(document).on('change', '.product-qty__value', function() {
                    var quantity = parseInt($(this).val());
                    if (isNaN(quantity) || quantity < 1) {
                        quantity = 1;
                        $(this).val(quantity);
                    }
                    if (quantity > project.availableShare) {
                        quantity = project.availableShare;
                        $(this).val(quantity);
                        notify('error', 'Quantity cannot exceed available shares.');
                    }
                    updateValues(quantity);
                });

                // Function to handle increment/decrement actions
                function changeQuantity(element) {
                    var $input = $('.product-qty__value');
                    var currentValue = parseInt($input.val());
                    var inputValue = currentValue;

                    var minValue = parseInt($input.attr('min'));
                    var maxValue = parseInt($input.attr('max'));

                    if ($(element).hasClass('product-qty__increment')) {
                        if (currentValue < maxValue) {
                            inputValue = currentValue + 1;
                        }
                    } else if ($(element).hasClass('product-qty__decrement')) {
                        if (currentValue > minValue) {
                            inputValue = currentValue - 1;
                        }
                    }

                    $input.val(inputValue);
                    updateValues(inputValue);
                }

                // Function to update values on the page based on the quantity
                function updateValues(quantity) {
                    var totalPayable = project.shareAmount * quantity;
                    var totalEarnings = 0;

                    if (project.returnType == STATUS_LIFETIME) {
                        var totalMonths = project.projectDuration;
                        var payHours = project.timeHours;
                        var payAmount = project.roiAmount;

                        var totalHours = totalMonths * 720;

                        var totalPayments = Math.floor(totalHours / payHours);

                        totalEarnings = totalPayments * payAmount * quantity;
                    } else {
                        var payAmount = project.roiAmount;
                        totalEarnings = payAmount * project.repeatTimes * quantity;
                    }

                    $('#modal_quantity').val(quantity);

                    // Update total payable
                    $('#total-payable').text(project.currencySymbol + totalPayable.toFixed(2));


                    // Update total earning last
                    var totalEarningLast = totalEarnings;
                    if (project.capitalBack == STATUS_YES) {
                        totalEarningLast += project.shareAmount * quantity;
                    }

                    $('#total-earning-last').text(project.currencySymbol + totalEarningLast.toFixed(2));

                    // Update total earning
                    if (project.returnType == STATUS_LIFETIME) {
                        $('#total-earning').text(project.currencySymbol + (project.roiAmount * quantity)
                            .toFixed(2) +
                            ' / ' + project.timeName);
                    } else {
                        $('#total-earning').text(project.currencySymbol + totalEarningLast.toFixed(2));
                    }

                    // Update quantity total price
                    $('.quantity-total-price').text(project.currencySymbol + totalPayable.toFixed(2));

                    // Update Earning ROI Amount
                    $('.time-name').text(project.currencySymbol + (project.roiAmount * quantity)
                        .toFixed(2) +
                        ' / ' + project.timeName);

                    // Update Earning ROI (%)
                    $('.roi-percentage').text(project.roiPercentage.toFixed(2) + '%');

                    // Update Capital Back
                    $('.capital-back').text(project.capitalBack == STATUS_YES ? 'Yes' : 'No');
                }


                document.querySelectorAll('.payment-options').forEach(function(option) {
                    option.addEventListener('click', function() {
                        document.querySelectorAll('.payment-options').forEach(function(
                            opt) {
                            opt.classList.remove('active');
                        });
                        option.classList.add('active');
                        $('#payment_type').val(option.getAttribute('data-payment-type'));
                    });
                });

            });
        })(jQuery);
    </script>
@endpush
