@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @include($activeTemplate . 'partials.breadcrumb')

    <section class="offer-details py-120  bg--white">
        <div class="container">
            <div class="offer-details-top">
                <div class="offer-details-thumb">
                    <img src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                        alt="Project Image">

                    @if (!empty($project->gallery) && count($project->gallery) > 0)
                        @foreach ($project->gallery as $index => $gallery)
                            @if ($index < 5)
                                <img src="{{ getImage(getFilePath('projectGallery') . '/' . $gallery, getFileSize('projectGallery')) }}"
                                    alt="Project Gallery Image">
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
                                            src="{{ getImage(getFilePath('projectGallery') . '/' . $gallery, getFileSize('projectGallery')) }}"
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
                                            src="{{ getImage(getFilePath('projectGallery') . '/' . $gallery, getFileSize('projectGallery')) }}"
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
                                    <span class="value">{{ __(getAmount($project->roi_percentage)) }}@lang('%')</span>
                                </li>
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('Duration')</span>
                                    <span class="value">{{ $project->maturity_time }} @lang('Months')</span>
                                </li>
                                <li class="offer-details-meta__item">
                                    <span class="label">@lang('Max')</span>
                                    <span class="value">{{ __(getAmount($project->share_count)) }} @lang('Units')</span>
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
                        </div>
                    </div>
                    @if ($project->end_date > now())
                        <div class="col-lg-4">
                            <aside id="offer-details-offcanvas-sidebar"
                                class="offcanvas-sidebar offcanvas-sidebar--offer-details">
                                <div class="offcanvas-sidebar__header">
                                    <button type="button" class="btn--close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                                <div class="offcanvas-sidebar__body">
                                    <div class="payment-form">
                                        <div class="payment-form__block">
                                            <ul class="amount-detail">
                                                <li class="amount-detail-item">
                                                    <span class="amount-detail-item__label">@lang('Total Payable')</span>
                                                    <span class="amount-detail-item__value"
                                                        id="total-payable">{{ gs('cur_sym') }}{{ getAmount($project->share_amount) }}</span>
                                                </li>
                                                <li class="amount-detail-item">
                                                    <span class="amount-detail-item__label">@lang('Total Earning')</span>
                                                    <span class="amount-detail-item__value"
                                                        id="total-earning">{{ gs('cur_sym') }}{{ getAmount($project->share_amount + $project->roi_amount) }}</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="payment-form__block">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="payment-form__label">@lang('Quantity')</span>

                                                <div class="product-qty">
                                                    <button class="product-qty__decrement" type="button"><i
                                                            class="fas fa-minus"></i></button>
                                                    <input class="product-qty__value" type="number" min="1"
                                                        value="1">
                                                    <button class="product-qty__increment" type="button"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="payment-form__block">
                                            <button type="button" class="btn btn--lg btn--base w-100 bookNow"
                                                data-bs-toggle="modal" data-bs-target="#bitModal">
                                                @lang('Book Now')
                                            </button>
                                        </div>

                                        <div class="payment-form__block">
                                            <div class="detail-collpase">
                                                <button type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#detail-collapse" aria-expanded="true">
                                                    <span class="text text-collapsed">@lang('See Details')</span>
                                                    <span class="text text-open">@lang('Hide Details')</span>
                                                </button>

                                                <div id="detail-collapse" class="collapse show">
                                                    <ul class="detail-list">
                                                        <li class="detail-list-item">
                                                            <span class="detail-list-item__label">@lang('Unit Price')</span>
                                                            <span class="detail-list-item__value"
                                                                id="total-price">{{ __(showAmount($project->share_amount)) }}</span>
                                                        </li>
                                                        <li class="detail-list-item">
                                                            <span class="detail-list-item__label">@lang('Total Price')</span>
                                                            <span
                                                                class="detail-list-item__value quantity-total-price">{{ gs('cur_sym') }}{{ __(getAmount($project->share_amount)) }}
                                                                {{ gs('cur_text') }}</span>
                                                        </li>
                                                        <li class="detail-list-item">
                                                            <span class="detail-list-item__label">@lang('Earning ROI (%)')</span>
                                                            <span
                                                                class="detail-list-item__value">{{ __(getAmount($project->roi_percentage)) }}</span>
                                                        </li>
                                                        <li class="detail-list-item">
                                                            <span class="detail-list-item__label">@lang('Return Timespan')</span>
                                                            <span
                                                                class="detail-list-item__value">{{ __($project->return_timespan) }}
                                                                @lang('Times /') {{ __($project->time->name) }}</span>
                                                        </li>
                                                        <li class="detail-list-item">
                                                            <span class="detail-list-item__label">@lang('Total Earning')</span>
                                                            <span class="detail-list-item__value"
                                                                id="total-earning-last">{{ __(showAmount($project->share_amount + $project->roi_amount)) }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include($activeTemplate . 'projects.buy-modal')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                const $decrementBtn = $('.product-qty__decrement');
                const $incrementBtn = $('.product-qty__increment');
                const $quantityInput = $('.product-qty__value');
                const $totalPrice = $('.quantity-total-price, #total-payable');
                const $totalEarning = $('#total-earning, #total-earning-last');

                const projectId = "{{ $project->id }}";
                const shareAmount = parseFloat("{{ $project->share_amount }}");
                const roiAmount = parseFloat("{{ $project->roi_amount }}");

                function updateQuantity(newValue) {
                    $quantityInput.val(newValue);
                    updateTotalPrice(newValue);
                    checkQuantity(newValue);
                    updateTotalEarning(newValue);
                    updateModalFields(newValue);
                }

                function updateTotalPrice(quantity) {
                    let totalPrice = shareAmount * quantity;
                    $totalPrice.text(totalPrice.toFixed(2));
                }

                function updateTotalEarning(quantity) {
                    let totalEarning = (shareAmount + roiAmount) * quantity;
                    $totalEarning.text(totalEarning.toFixed(2));
                }

                function updateModalFields(quantity) {
                    let totalPrice = shareAmount * quantity;
                    let totalEarning = (shareAmount + roiAmount) * quantity;

                    $('#modal_quantity').val(quantity);
                    $('#modal_total_price').val(totalPrice.toFixed(2));
                    $('#modal_total_earning').val(totalEarning.toFixed(2));
                }

                function checkQuantity(quantity) {
                    $.ajax({
                        url: "{{ route('check.quantity') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            project_id: projectId,
                            quantity: quantity,
                        },
                        success: function(response) {
                            if (response.status === 'error') {
                                notify('error', response.message);
                                $('.bookNow').hide();
                            } else {
                                $('.bookNow').show();
                            }
                        }
                    });
                }

                $decrementBtn.off('click').on('click', function() {
                    let currentValue = parseInt($quantityInput.val(), 10);
                    if (currentValue > 1) {
                        updateQuantity(currentValue - 1);
                    }
                });

                $incrementBtn.off('click').on('click', function() {
                    let currentValue = parseInt($quantityInput.val(), 10);
                    updateQuantity(currentValue + 1);
                });

                $quantityInput.off('change').on('change', function() {
                    let currentValue = parseInt($quantityInput.val(), 10);
                    if (isNaN(currentValue) || currentValue < 1) {
                        updateQuantity(1);
                    } else {
                        updateQuantity(currentValue);
                    }
                });

                document.querySelectorAll('.payment-options').forEach(function(option) {
                    option.addEventListener('click', function() {
                        document.querySelectorAll('.payment-options').forEach(function(opt) {
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
@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush
