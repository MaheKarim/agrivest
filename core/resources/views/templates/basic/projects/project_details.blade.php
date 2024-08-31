@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @include($activeTemplate . 'partials.breadcrumb')

    <section class="offer-details py-120  bg--white">
        <div class="container">
            <div class="offer-details-top">
                <div class="offer-details-thumb">
                    @if(!empty($project->gallery) && count($project->gallery) > 0)
                        @foreach($project->gallery as $index => $gallery)
                            <img src="{{ getImage(getFilePath('projectGallery') . '/' . $gallery, getFileSize('projectGallery')) }}"
                                 alt="Project Image">
                        @endforeach
                    @else
                        <img src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) }}"
                             alt="Project Image">
                    @endif
                </div>

                @if(!empty($project->gallery) && count($project->gallery) > 0)
                    <div class="offer-details-slider d-lg-none">
                        <div class="offer-details-thumb-slider">
                            @foreach($project->gallery as $index => $gallery)
                                <div class="offer-details-thumb-slider__item">
                                    <img class="offer-details-thumb-slider__img"
                                         src="{{ getImage(getFilePath('projectGallery') . '/' . $gallery, getFileSize('projectGallery')) }}"
                                         alt="@lang('Project Image')"
                                         data-index="{{ $index }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="offer-details-preview-slider">
                            @foreach($project->gallery as $gallery)
                                <div class="offer-details-preview-slider__item">
                                    <img class="offer-details-preview-slider__img"
                                         src="{{ getImage(getFilePath('projectGallery') . '/' . $gallery, getFileSize('projectGallery')) }}"
                                         alt="@lang('Project Image')">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="offer-details-content">
                        <h1 class="offer-details-title">{{__($project->title)}}</h1>

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
                                <span class="value">05 Units</span>
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
                                @foreach($project->faqs as $index => $faq)
                                    <div class="accordion-item {{ $index == 0 ? 'active' : '' }}">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#faq-accordion-question-{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                    aria-controls="faq-accordion-question-{{ $index }}">
                                                {{ __($faq->question) }}
                                            </button>
                                        </h2>
                                        <div id="faq-accordion-question-{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
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
                <div class="col-lg-4">
                    <aside id="offer-details-offcanvas-sidebar"
                           class="offcanvas-sidebar offcanvas-sidebar--offer-details">
                        <div class="offcanvas-sidebar__header">
                            <button type="button" class="btn--close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="offcanvas-sidebar__body">
                            <form action="" class="payment-form">
                                <div class="payment-form__block">
                                    <ul class="amount-detail">
                                        <li class="amount-detail-item">
                                            <span class="amount-detail-item__label">@lang('Total Payable')</span>
                                            <span
                                                class="amount-detail-item__value">{{ showAmount($project->share_amount) }}</span>
                                        </li>
                                        <li class="amount-detail-item">
                                            <span class="amount-detail-item__label">@lang('Total Earning')</span>
                                            <span
                                                class="amount-detail-item__value">{{ showAmount($project->share_amount + $project->roi_amount) }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="payment-form__block">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="payment-form__label">@lang('Quantity')</span>

                                        <div class="product-qty">
                                            <button class="product-qty__decrement" type="button"><i
                                                    class="fas fa-minus"></i></button>
                                            <input class="product-qty__value" type="number" value="1">
                                            <button class="product-qty__increment" type="button"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-form__block">
                                    <button class="btn btn--lg btn--base w-100" type="submit">
                                        @lang('Book Now')
                                    </button>
                                </div>

                                <div class="payment-form__block">
                                    <div class="detail-collpase">
                                        <button class="collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#detail-collapse" aria-expanded="false">
                                            <span class="text text-collapsed">@lang('See Details')</span>
                                            <span class="text text-open">@lang('Hide Details')</span>
                                        </button>

                                        <div id="detail-collapse" class="collapse">
                                            <ul class="detail-list">
                                                <li class="detail-list-item">
                                                    <span class="detail-list-item__label">@lang('Unite Price')</span>
                                                    <span class="detail-list-item__value">$30,000.00</span>
                                                </li>
                                                <li class="detail-list-item">
                                                    <span class="detail-list-item__label">@lang('Total Price')</span>
                                                    <span class="detail-list-item__value">$16,000.00</span>
                                                </li>
                                                <li class="detail-list-item">
                                                    <span
                                                        class="detail-list-item__label">@lang('Insurance Amount')</span>
                                                    <span class="detail-list-item__value text--base">(+)$0.00</span>
                                                </li>
                                                <li class="detail-list-item">
                                                    <span class="detail-list-item__label">@lang('Discount')</span>
                                                    <span class="detail-list-item__value text--base">(-)$0.00</span>
                                                </li>
                                                <li class="detail-list-item">
                                                    <span
                                                        class="detail-list-item__label">@lang('Total Payable Amount')</span>
                                                    <span class="detail-list-item__value">$30,000.00</span>
                                                </li>
                                                <li class="detail-list-item">
                                                    <span class="detail-list-item__label">@lang('Earning(%)')</span>
                                                    <span class="detail-list-item__value">7.5%</span>
                                                </li>
                                                <li class="detail-list-item">
                                                    <span class="detail-list-item__label">@lang('Total Earning')</span>
                                                    <span class="detail-list-item__value">$1728,000.00</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
@if(!app()->offsetExists('slick_load'))
    @push('style-lib')
        <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
    @endpush
    @push('script-lib')
        <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
    @endpush
    @php app()->offsetSet('slick_load', true) @endphp
@endif
