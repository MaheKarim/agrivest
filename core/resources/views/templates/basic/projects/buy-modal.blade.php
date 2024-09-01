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
                    <!-- Hidden input fields to store project_id and user_id -->
                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                    <input type="hidden" name="payment_type" id="payment_type" value="deposit">
                    <div class="payment-options-wrapper mb-3">
                        <div class="payment-options" data-payment-type="balance">
                            <span class="active-badge"><i class="las la-check"></i></span>
                            <img src="{{ getImage($activeTemplateTrue . '/images/wallet.png') }}"
                                 alt="@lang('Payment Option Image')">
                            <div class="payment-options-content">
                                <h4 class="mb-1">@lang('Wallet Balance')</h4>
                                <p>@lang('Payment completed instantly with one click if sufficient balance is available')</p>
                            </div>
                        </div>
                        <div class="payment-options active" data-payment-type="deposit">
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
            document.querySelectorAll('.payment-options').forEach(function (option) {
                option.addEventListener('click', function () {
                    document.querySelectorAll('.payment-options').forEach(function (opt) {
                        opt.classList.remove('active');
                    });
                    option.classList.add('active');
                    document.getElementById('payment_type').value = option.getAttribute('data-payment-type');
                });
            });
        })(jQuery);
    </script>
@endpush
