<div class="dashboard-inner__block">
    <div class="dashboard-card">

        <div class="dashboard-card__header">
            <h6 class="dashboard-card__title">@lang('My Projects')</h6>

            @if (!request()->routeIs('user.home'))
                <form class="d-flex align-items-center">
                    <div class="position-relative">
                        <input class="form-control form--control with-search-icon" type="search" name="search"
                               value="{{ request()->search }}" placeholder="@lang('Search by title')">
                        <button type="submit" class="search-icon-button">
                            <i class="las la-search"></i>
                        </button>
                    </div>
                </form>
            @endif

        </div>

        <div class="dashboard-card__body">
            <table class="table table--responsive--sm">
                <thead>
                <tr>
                    <th>@lang('Project')</th>
                    <th>@lang('Duration')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invests as $invest)
                    <tr>
                        <td>
                            <div class="td-wrapper">
                                <div>{{ __($invest->project->title) }}</div>
                                <span>@lang('Units:') {{ __($invest->quantity) }} x
                                        {{ __(showAmount($invest->unit_price)) }}</span>
                            </div>
                        </td>
                        <td>
                            {{ __($invest->project->maturity_time) }} @lang('Months')
                        </td>
                        <td>{{ __(showAmount($invest->total_price)) }}</td>
                        <td>
                            @php echo $invest->statusBadge @endphp
                        </td>

                        <td>
                            <div class="action-buttons">
                                <button type="button" class="btn btn--xsm btn--outline action-btn"
                                        data-value="{{ json_encode($invest) }}" data-bs-toggle="modal"
                                        data-bs-target="#projects-modal">
                                    <i class="las la-desktop"></i>
                                </button>
                            </div>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="100%">
                            <div class="text-center text--base">@lang('No data found!')</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if (!request()->routeIs('user.dashboard') && $invests instanceof \Illuminate\Contracts\Pagination\Paginator)
                {{ paginateLinks($invests) }}
            @endif
        </div>
    </div>
</div>

<div id="projects-modal" class="modal modal--dashboard fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn--close style-two" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>

                <h6 class="modal-title">@lang('Payment Details')</h6>

                <ul class="amount-detail mt-3">
                    <li class="amount-detail-item">
                        <span class="amount-detail-item__label">@lang('Total Paid')</span>
                        <span class="amount-detail-item__value"></span>
                    </li>
                    <li class="amount-detail-item">
                        <span class="amount-detail-item__label">@lang('Total Earning')</span>
                        <span class="amount-detail-item__value" id="totalEarning"
                              data-total-earning="{{ @$invest->total_earning }}"></span>
                    </li>
                </ul>

                <ul class="detail-list mt-4">
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Unite Price')</span>
                        <span class="detail-list-item__value"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Total Price')</span>
                        <span class="detail-list-item__value"></span>
                    </li>

                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Earning(%)')</span>
                        <span class="detail-list-item__value"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Total Earning')</span>
                        <span class="detail-list-item__value"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        "use strict";
        $(document).ready(function () {

            function getAmount(amount) {
                amount = amount || 0;
                amount = parseFloat(amount).toFixed(2);
                return amount;
            }


            $('.action-btn').on('click', function () {
                var invest = $(this).data('value');
                var row = $(this).closest('tr');

                var projectTitle = row.find('.td-wrapper div').text();
                var unitPrice = "{{ gs('cur_sym') }}" + getAmount(invest.unit_price);
                var totalPrice = "{{ gs('cur_sym') }}" + getAmount(invest.total_price);
                var totalEarning = "{{ gs('cur_sym') }}" + getAmount(invest.total_earning);
                var roiPercentage = getAmount(invest.roi_percentage) + '%';

                // Update the modal content with extracted data
                $('#projects-modal .modal-title').text(projectTitle);
                $('#projects-modal .amount-detail-item__value').eq(0).text(totalPrice);
                $('#projects-modal #totalEarning').text(totalEarning);

                // Update the details list
                var $detailListItems = $('#projects-modal .detail-list-item');
                $detailListItems.eq(0).find('.detail-list-item__value').text(unitPrice);
                $detailListItems.eq(1).find('.detail-list-item__value').text(totalPrice);
                $detailListItems.eq(2).find('.detail-list-item__value').text(roiPercentage);
                $detailListItems.eq(3).find('.detail-list-item__value').text(totalEarning);

                // Show the modal
                $('#projects-modal').modal('show');
            });
        });
    </script>
@endpush
