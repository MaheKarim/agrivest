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
                                        {{-- @dump($invest->id) --}}
                                        <a class="text--base"
                                            href="{{ route('project.details', @$invest->project->slug) }}">
                                            {{ __(strLimit($invest->project->title, 50)) }}
                                        </a>
                                    </div>
                                    <span>
                                        @lang('Units:') {{ __($invest->quantity) }} x
                                        {{ __(showAmount($invest->unit_price)) }}
                                    </span>
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
                        <span class="amount-detail-item__label">@lang('Total Paid')</span>
                        <span class="amount-detail-item__value"></span>
                    </li>
                    <li class="amount-detail-item">
                        <span class="amount-detail-item__label">@lang('Profit Earning')</span>
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
                        <span class="detail-list-item__value quantity-total-price" id="total-invest"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Earning ROI (%)')</span>
                        <span class="detail-list-item__value roi-percentage" id="roi-percentage"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Earning ROI Amount')</span>
                        <span class="detail-list-item__value roi_amount" id="roi-amount"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Project Duration')</span>
                        <span class="detail-list-item__value" id="project-duration"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Return Type')</span>
                        <span class="detail-list-item__value" id="return-type"></span>
                    </li>

                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Capital Back')</span>
                        <span class="detail-list-item__value cashback" id="capital-back"></span>
                    </li>
                    <li class="detail-list-item">
                        <span class="detail-list-item__label">@lang('Total Earning')</span>
                        <span class="detail-list-item__value total_earning" id="total-earning-last"></span>
                    </li>
                </ul>



            </div>
        </div>
    </div>
</div>

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
                    repeat: '@lang('Repeat')' // Added 'repeat' localization
                };

                // Access the project data from the invest object
                var project = invest.project;

                // Convert numbers to float
                var quantity = parseFloat(invest.quantity);
                var roiAmount = parseFloat(project.roi_amount);
                var shareAmount = parseFloat(invest.unit_price);
                var totalInvest = parseFloat(invest.total_price);
                var roiPercentage = parseFloat(project.roi_percentage);
                var capitalBack = parseFloat(project.capital_back);
                var returnType = parseFloat(project.return_type);
                var projectDuration = parseFloat(project.project_duration);
                var repeatTimes = parseFloat(project.repeat_times);
                var timeName = project.time ? project.time.name : ''; // Handle if time is null
                var currencySymbol = '{{ gs('cur_sym') }}';
                var currencyText = '{{ gs('cur_text') }}';

                // Calculate total earnings
                var totalEarnings = 0;

                if (returnType === {{ Status::LIFETIME }}) {
                    var totalMonths = parseFloat(projectDuration);
                    var payHours = parseFloat(project.time.hours);
                    var payAmount = parseFloat(roiAmount);

                    var totalHours = totalMonths * 720;

                    var totalPayments = Math.floor(totalHours / payHours);
                    totalEarnings = totalPayments * payAmount * quantity;
                } else {
                    totalEarnings = roiAmount * repeatTimes * quantity;
                }

                // Populate modal fields
                $('#unit-price').text(currencySymbol + shareAmount.toFixed(2));
                $('#quantity').text(quantity);
                $('#total-invest').text(currencySymbol + totalInvest.toFixed(2) + ' ' + currencyText);
                $('#roi-percentage').text(roiPercentage.toFixed(2) + '%');

                // Earning ROI Amount formatted as "$10.00 / Days"
                $('#roi-amount').text(currencySymbol + (roiAmount * quantity).toFixed(2) + ' / ' + timeName);

                // Project Duration or Return Timespan
                if (returnType === {{ Status::LIFETIME }}) {
                    $('#project-duration').html(localization.lifetime + ' ' + projectDuration + ' ' + localization
                        .months);
                } else {
                    $('#project-duration').text(localization.for+' ' + repeatTimes + ' ' + timeName);
                }

                // Return Type
                var returnTypeText = (returnType === {{ Status::LIFETIME }}) ? localization.lifetime : localization
                    .repeat;
                $('#return-type').text(returnTypeText);

                // Capital Back
                $('#capital-back').text(capitalBack === {{ Status::YES }} ? localization.yes : localization.no);

                // Total Earning
                var totalEarningDisplay = totalEarnings;
                if (capitalBack === {{ Status::YES }}) {
                    totalEarningDisplay += shareAmount * quantity;
                }
                $('#total-earning-last').text(currencySymbol + totalEarningDisplay.toFixed(2));

                // Update Total Paid and Profit Earning in amount-detail
                $('#projects-modal .amount-detail-item__value').eq(0).text(currencySymbol + totalInvest.toFixed(2));
                $('#projects-modal .amount-detail-item__value').eq(1).text(currencySymbol + totalEarningDisplay
                    .toFixed(
                        2));
            }

        });
    </script>
@endpush
