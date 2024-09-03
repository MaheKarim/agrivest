<div class="modal fade custom--modal" id="bitModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Product Title')</h5>
                <button class="btn-close modal-icon" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.invest.order') }}" method="post">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <input type="hidden" name="quantity" id="modal_quantity" value="1">
                    <input type="hidden" name="total_price" id="modal_total_price" value="">
                    <input type="hidden" name="unit_price" id="modal_unit_price" value="{{ $project->share_amount }}">
                    <input type="hidden" name="total_earning" id="modal_total_earning" value="">
                    <input type="hidden" name="payment_type" id="payment_type" value="">

                    <div class="payment-options-wrapper mb-3">

                        <div class="payment-options" data-payment-type="2">
                            <span class="active-badge"><i class="las la-check"></i></span>
                            <img src="{{ getImage($activeTemplateTrue . '/images/wallet.png') }}"
                                 alt="@lang('Payment Option Image')">
                            <div class="payment-options-content">
                                <h4 class="mb-1">@lang('Wallet Balance')</h4>
                                <p>@lang('Payment completed instantly with one click if sufficient balance is available')</p>
                            </div>
                        </div>

                        <div class="payment-options" data-payment-type="1">
                            <span class="active-badge"><i class="las la-check"></i></span>
                            <img src="{{ getImage($activeTemplateTrue . '/images/credit-card.png') }}"
                                 alt="@lang('Payment Option Image')">
                            <div class="payment-options-content">
                                <h4 class="mb-1">@lang('Payment Gateway')</h4>
                                <p>@lang('Multiple gateways for ensuring a seamless &amp; hassle-free payment process.')</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn--base" name="submit_type" value="buy">
                            <span class="btn--icon"><i class="fas fa-shopping-bag"></i></span> @lang('BUY NOW')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        'use strict';
        (function ($) {
            "use strict";

        })(jQuery);
    </script>
@endpush
