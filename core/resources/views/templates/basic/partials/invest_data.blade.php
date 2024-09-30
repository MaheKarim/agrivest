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
                        <th>@lang('Invested Amount')</th>
                        <th>@lang('Paid | Remaining')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invests as $invest)
                        <tr>
                            <td>
                                <div class="td-wrapper">
                                    <div>
                                        <a class="text--base"
                                            href="{{ route('project.details', @$invest->project->slug) }}">
                                            {{ __(strLimit($invest->project->title, 50)) }}
                                        </a>
                                    </div>
                                    @if ($invest->status == Status::INVEST_RUNNING)
                                        <span>
                                            @lang('Next Pay'): {{ diffForHumans($invest->next_time) }}
                                            @if ($invest->period < 1)
                                                <i class="las la-info-circle" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('You will begin to receive your investment returns after the maturity period. The maturity period is calculated from the project\'s end date plus the specified maturity time.')">
                                                </i>
                                            @endif
                                        </span>
                                    @endif

                                </div>
                            </td>

                            <td>
                                {{ __($invest->project->maturity_time) }} @lang('Months')
                            </td>
                            <td>{{ __(showAmount($invest->total_price)) }}</td>

                            <td>
                                @php
                                    $remaining = getInvestmentRemaining($invest);
                                @endphp

                                <span data-toggle="tooltip" data-placement="top"
                                    title="@lang('Paid: ') {{ __($invest->period) }} @lang('returns')">
                                    {{ __($invest->period) }}
                                </span>

                                @if ($invest->project->return_type != Status::LIFETIME)
                                    |
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="@lang('Remaining: ') {{ __($remaining) }} @lang('returns')">
                                        {{ __($remaining) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @php echo $invest->statusBadge @endphp
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Details Button -->
                                    <button type="button" class="btn btn--xsm btn--outline action-btn"
                                        data-value="{{ json_encode($invest) }}" data-bs-toggle="modal"
                                        data-bs-target="#projects-modal" data-toggle="tooltip" data-placement="top"
                                        title="@lang('Details')">
                                        <i class="las la-desktop"></i>
                                    </button>

                                    <!-- Transactions Button -->
                                    <a href="{{ route('user.projects.transactions', $invest->id) }}"
                                        class="btn btn--xsm btn--outline action-btn" data-toggle="tooltip"
                                        data-placement="top" title="@lang('Transactions')">
                                        <i class="las la-list"></i>
                                    </a>
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
            @if (!request()->routeIs('user.dashboard') && $invests->hasPages())
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
                        <span class="amount-detail-item__label">@lang('Total Invest')</span>
                        <span class="amount-detail-item__value" id="total-invest-detail"></span>
                    </li>
                    <li class="amount-detail-item">
                        <span class="amount-detail-item__label" id="label-profit"></span>
                        <span class="amount-detail-item__value" id="totalEarning"></span>
                    </li>
                </ul>

                <ul class="detail-list mt-4">
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Unit Price')</span>
                        <span class="detail-list-item__value" id="unit-price"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Quantity')</span>
                        <span class="detail-list-item__value" id="quantity"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Total Invest')</span>
                        <span class="detail-list-item__value" id="total-invest"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Earning ROI (%)')</span>
                        <span class="detail-list-item__value" id="roi-percentage"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Earning ROI Amount')</span>
                        <span class="detail-list-item__value" id="roi-amount"></span>
                    </li>
                    <!-- Add conditional elements based on return type -->
                    <li class="detail-list-item" id="return-timespan-item">
                        <span class="detail-list-item__label">@lang('Return Timespan')</span>
                        <span class="detail-list-item__value" id="return-timespan"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Return Type')</span>
                        <span class="detail-list-item__value" id="return-type"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Capital Back')</span>
                        <span class="detail-list-item__value" id="capital-back"></span>
                    </li>
                    <li class="detail-list-item" id="total-earning-item">
                        <span class="detail-list-item__label">@lang('Total Earning')</span>
                        <span class="detail-list-item__value" id="total-earning-last"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


@push('style')
    <style>
        .action-buttons .btn {
            padding: 4px 8px;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";
        $(document).ready(function() {
            $('.action-btn').on('click', function() {
                // Retrieve the JSON-encoded invest object from the data-value attribute
                var investData = $(this).data('value');

                // If the data is a string, parse it into an object
                if (typeof investData === 'string') {
                    investData = JSON.parse(investData);
                }

                // Populate the modal fields with the invest data
                populateModal(investData);

                // Show the modal
                $('#projects-modal').modal('show');
            });

            function populateModal(invest) {
                // Localization strings
                var localization = {
                    for: '@lang('For')',
                    lifetime: '@lang('Lifetime')',
                    months: '@lang('Months')',
                    yes: '@lang('Yes')',
                    no: '@lang('No')',
                    repeat: '@lang('Repeat')',
                    profit: '@lang('Profit')',
                    invest_plus_profit: '@lang('Invest + Profit')'
                };

                // Access the project data from the invest object
                var project = invest.project;

                // Convert numbers to appropriate types
                var quantity = parseInt(invest.quantity) || 1;
                var shareAmount = parseFloat(project.share_amount) || 0;
                var roiAmount = parseFloat(project.roi_amount) || 0;
                var roiPercentage = parseFloat(project.roi_percentage) || 0;
                var capitalBack = parseInt(project.capital_back) || 0;
                var returnType = parseInt(project.return_type) || 0;
                var repeatTimes = parseInt(project.repeat_times) || 0;
                var timeName = project.time ? project.time.name : ''; // Handle if time is null
                var currencySymbol = '{{ gs('cur_sym') }}';
                var currencyText = '{{ gs('cur_text') }}';

                // Calculate total invest
                var totalInvest = shareAmount * quantity;

                // Initialize variables
                var totalEarnings = 0;
                var profitMessage = '';
                var label = '';

                if (returnType === {{ Status::LIFETIME }}) {
                    // For lifetime projects
                    totalEarnings = roiAmount * quantity;
                    profitMessage = currencySymbol + totalEarnings.toFixed(2) + ' / ' + timeName;
                    label = localization.profit;

                    // Hide Return Timespan and Total Earning (since it's lifetime)
                    $('#return-timespan-item').hide();
                    $('#total-earning-item').hide();
                } else {
                    // For non-lifetime projects
                    totalEarnings = roiAmount * repeatTimes * quantity;

                    if (capitalBack === {{ Status::YES }}) {
                        profitMessage = currencySymbol + (shareAmount * quantity + totalEarnings).toFixed(2);
                        label = localization.invest_plus_profit;
                    } else {
                        profitMessage = currencySymbol + totalEarnings.toFixed(2);
                        label = localization.profit;
                    }

                    // Show Return Timespan and Total Earning
                    $('#return-timespan-item').show();
                    $('#total-earning-item').show();
                }

                // Populate modal fields
                $('#unit-price').text(currencySymbol + shareAmount.toFixed(2));
                $('#quantity').text(quantity);
                $('#total-invest').text(currencySymbol + totalInvest.toFixed(2) + ' ' + currencyText);
                $('#roi-percentage').text(roiPercentage.toFixed(2) + '%');
                $('#roi-amount').text(currencySymbol + (roiAmount * quantity).toFixed(2) + ' / ' + timeName);
                $('#label-profit').text(label);
                $('#total-invest-detail').text(currencySymbol + totalInvest.toFixed(2));
                $('#totalEarning').text(profitMessage);

                // Project Duration or Return Timespan
                if (returnType === {{ Status::LIFETIME }}) {
                    $('#project-duration').text(localization.lifetime);
                } else {
                    $('#return-timespan').text(localization.for+' ' + repeatTimes + ' ' + timeName);
                }

                // Return Type
                var returnTypeText = (returnType === {{ Status::LIFETIME }}) ? localization.lifetime : localization
                    .repeat;
                $('#return-type').text(returnTypeText);

                // Capital Back
                $('#capital-back').text(capitalBack === {{ Status::YES }} ? localization.yes : localization.no);

                // Total Earning (at the bottom of the modal)
                var totalEarningDisplay = totalEarnings;
                if (capitalBack === {{ Status::YES }} && returnType !== {{ Status::LIFETIME }}) {
                    totalEarningDisplay += shareAmount * quantity;
                }
                $('#total-earning-last').text(currencySymbol + totalEarningDisplay.toFixed(2));
            }
        });
    </script>
@endpush
