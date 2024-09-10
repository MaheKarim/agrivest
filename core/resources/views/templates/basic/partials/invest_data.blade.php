<div class="dashboard-inner__block">
    <div class="dashboard-card">
        <div class="dashboard-card__header">
            <h6 class="dashboard-card__title">@lang('My Projects')</h6>
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
                                <span>@lang('Units:') {{ __($invest->quantity) }} x {{__(showAmount($invest->unit_price))}}</span>
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
                                        data-bs-toggle="modal" data-bs-target="#projects-modal">
                                    @lang('Details')
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
            @if(!request()->routeIs('user.dashboard') && $invests instanceof \Illuminate\Contracts\Pagination\Paginator)
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
                        <span class="amount-detail-item__value">{{ __(showAmount(@$invest->total_price)) }}</span>
                    </li>
                    <li class="amount-detail-item">
                        <span class="amount-detail-item__label">@lang('Total Earning')</span>
                        <span class="amount-detail-item__value" id="totalEarning"
                              data-total-earning="{{ @$invest->total_earning }}">{{ __(showAmount(@$invest->total_earning)) }}</span>
                    </li>
                </ul>

                <ul class="detail-list mt-4">
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Unite Price')</span>
                        <span class="detail-list-item__value">{{ __(showAmount(@$invest->unit_price)) }}</span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Total Price')</span>
                        <span class="detail-list-item__value">{{ __(showAmount(@$invest->total_price)) }}</span>
                    </li>

                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Earning(%)')</span>
                        <span class="detail-list-item__value">{{__(getAmount(@$invest->roi_percentage))}}%</span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Total Earning')</span>
                        <span class="detail-list-item__value"
                        >{{ __(showAmount(@$invest->total_earning)) }}</span>
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
            $('.action-btn').on('click', function () {
                // Find the closest table row
                var $row = $(this).closest('tr');

                // Extract data from the row
                var projectTitle = $row.find('td:eq(1) .td-wrapper > div').text();
                var unitPrice = $row.find('td:eq(1) .td-wrapper > span').text().split('x')[1].trim();
                var totalPrice = $row.find('td:eq(3)').text();
                var totalEarning = $(this).data('total-earning');


                // Update the modal content with extracted data
                $('#projects-modal .modal-title').text(projectTitle);
                $('#projects-modal .amount-detail-item__value').eq(0).text(totalPrice);
                $('#projects-modal #totalEarning').text(totalEarning);

                // Update the details list
                var $detailListItems = $('#projects-modal .detail-list-item');
                $detailListItems.eq(0).find('.detail-list-item__value').text(unitPrice);
                $detailListItems.eq(1).find('.detail-list-item__value').text(totalPrice);
                $detailListItems.eq(3).find('.detail-list-item__value').text(totalEarning);

                // Show the modal
                $('#projects-modal').modal('show');
            });

        });

    </script>
@endpush
