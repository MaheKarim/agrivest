@extends('admin.layouts.app')

@section('panel')
    <div class="row g-4">
        <div class="col-md-6">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card full-view">
                        <div class="card-header">
                            <div class="row g-2 align-items-center">
                                <div class="col-sm-6">
                                    <h5 class="card-title mb-0">@lang('Total Invests')</h5>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <div class="d-flex justify-content-sm-end gap-2">
                                        <button class="exit-btn">
                                            <i class="fullscreen-open las la-compress" onclick="openFullscreen();"></i>
                                            <i class="fullscreen-close las la-compress-arrows-alt"
                                               onclick="closeFullscreen();"></i>
                                        </button>
                                        <select class="widget_select" name="invest_time">
                                            <option value="week">@lang('Current Week')</option>
                                            <option value="month">@lang('Current Month')</option>
                                            <option value="year" selected>@lang('Current Year')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center pb-0 px-0">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <p>@lang('This') <span class="time_type"></span> @lang('invest')</p>
                                </div>
                                <div class="col-md-4">
                                    <h3><span>{{ gs('cur_sym') }}</span><span class="total_invest"></span></h3>
                                </div>
                                <div class="col-md-4">
                                    <p class="up_down">

                                    </p>
                                </div>
                            </div>
                            <div class="my_invest_canvas"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card h-100">
                        <div class="card-body">
                            @if ($widget['total_invest'] > 0)
                                <div class="card-container">
                                    <div class="investments-scheme">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="mb-0">@lang('Total Investments') →</h3>
                                            <h3 class="mb-6">
                                                {{ showAmount($widget['total_invest']) }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h5 class="text-center">@lang('Invest not found')</h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title mb-0">@lang('Profit to Pay')</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($widget['profit_to_give'])
                                <div class="card-container">
                                    <div class="row align-items-center pb-3 pb-xxl-0">
                                        <div class="col-6">
                                            <p>@lang('Should Pay')</p>
                                            <h3 class="deposit-amount">
                                                <sup>{{ gs('cur_sym') }}</sup>{{ showAmount($widget['profit_to_give'], currencyFormat: false) }}
                                            </h3>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="btn btn--primary"
                                               href="{{ route('admin.report.invest.history') }}">@lang('History')</a>
                                        </div>
                                    </div>
                                    <div class="progress-info">
                                        <div class="progress-info-content">
                                            <p>@lang('Paid')
                                                @if ($widget['profit_paid'] + $widget['profit_to_give'] != 0)
                                                    {{ showAmount(($widget['profit_paid'] / ($widget['profit_paid'] + $widget['profit_to_give'])) * 100, currencyFormat: false) }}
                                                    %
                                                @else
                                                    0%
                                                @endif
                                            </p>
                                        </div>
                                        <div class="progress-info-content">
                                            <p>
                                                {{ showAmount($widget['profit_paid']) }} /
                                                {{ showAmount($widget['profit_paid'] + $widget['profit_to_give']) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="progress mb-2 my-progressbar">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ $widget['profit_paid'] + $widget['profit_to_give'] != 0 ? getAmount(($widget['profit_paid'] / ($widget['profit_paid'] + $widget['profit_to_give'])) * 100) : 0 }}%;">
                                        </div>
                                    </div>
                                    <p class="font-12 mb-0">
                                        *@lang('This statistics showing data excluding lifetime investment.')</p>
                                </div>
                            @else
                                <h5 class="text-center">@lang('No invest found to paid!')</h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title mb-0">@lang('Interest Statistics by Project')</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart-info">
                                    <a class="chart-info-toggle" href="#">
                                        <img class="chart-info-img" src="{{ asset('assets/images/collapse.svg') }}"
                                             alt="image">
                                    </a>
                                    <div class="chart-info-content">
                                        <ul class="chart-info-list">
                                            @foreach ($interestByProjects as $key => $invest)
                                                <li class="chart-info-list-item">
                                                    <i
                                                        class="fas fa-plane projectPointInterest me-2"></i>{{ __($key) }}
                                                    {{ $totalInterest > 0 ? showAmount(($invest / $totalInterest) * 100, currencyFormat: false) : 0 }}
                                                    %
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="chart-area">
                                    <canvas class="chartjs-chart" id="interest_by_project" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-sm-6">
                                            <h5 class="card-title mb-0">@lang('Invest & Interest')</h5>
                                        </div>
                                        <div class="col-sm-6 text-sm-end">
                                            <select class="widget_select" id="project_statistics_time"
                                                    name="invest_interest_time">
                                                <option value="all">@lang('All Time')</option>
                                                <option value="week">@lang('Current Week')</option>
                                                <option value="month">@lang('Current Month')</option>
                                                <option value="year">@lang('Current Year')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="interest-scheme">
                                <div class="interest-scheme__content">
                                    <p class="mb-0">@lang('Running Invest')</p>
                                    <h5 class="mb-1 text-success runningInvests"></h5>
                                    <p class="mb-0">
                                        <a class="btn btn-sm btn-outline-success font-12 px-2"
                                           href="{{ route('admin.report.invest.history') }}?status={{ Status::INVEST_RUNNING }}">@lang('History')</a>
                                    </p>
                                </div>
                                <div class="interest-scheme__content text-sm-center">
                                    <p class="mb-0 font-12">@lang('Closed Invest')</p>
                                    <h5 class="mb-1 text-warning counter expiredInvests"></h5>
                                    <p class="mb-0">
                                        <a
                                            href="{{ route('admin.report.invest.history') }}?status={{ Status::INVEST_CLOSED }}">
                                            <button
                                                class="btn btn-sm btn-outline-warning font-12 px-2"
                                                type="button">@lang('History')</button>
                                        </a>
                                    </p>
                                </div>
                                <div class="interest-scheme__content text-sm-end">
                                    <p class="mb-0 font-12">@lang('Interest')</p>
                                    <h5 class="mb-1 text-primary interests"></h5>
                                    <p class="mb-0">
                                        <a class="btn btn-sm btn-outline-primary font-12 px-2 speedUp"
                                           href="{{ route('admin.report.transaction') }}?remark=profit">@lang('History')</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-2 align-items-center">
                                <div class="col-sm-6 col-md-12 col-xl-5">
                                    <h5 class="card-title mb-0">@lang('Investment Statistics by Project')</h5>
                                </div>
                                <div class="col-sm-6 col-md-12 col-xl-7">
                                    <div class="pair-option justify-content-md-start justify-content-xl-end">
                                        <select class="widget_select" name="project_statistics_invests">
                                            <option value="all">@lang('All Invests')</option>
                                            <option value="active">@lang('Running Invests')</option>
                                            <option value="closed">@lang('Closed Invests')</option>
                                        </select>
                                        <select class="widget_select" name="project_statistics_time">
                                            <option value="all">@lang('All Time')</option>
                                            <option value="week">@lang('Current Week')</option>
                                            <option value="month">@lang('Current Month')</option>
                                            <option value="year">@lang('Current Year')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart-info">
                                    <a class="chart-info-toggle" href="#">
                                        <img class="chart-info-img" src="{{ asset('assets/images/collapse.svg') }}"
                                             alt="image">
                                    </a>
                                    <div class="chart-info-content">
                                        <ul class="chart-info-list project-info-data"></ul>
                                    </div>
                                </div>
                                <div class="chart-area chart-area--fixed">
                                    <div class="plan_invest_canvas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="row align-items-center g-2">
                                <div class="col-sm-6">
                                    <h5 class="card-title mb-0">@lang('Invest & Interest')</h5>
                                </div>
                                @if (@$firstInvestYear->date)
                                    <div class="col-sm-6">
                                        <div class="pair-option">
                                            <select class="widget_select" name="invest_interest_year">
                                                @for ($i = $firstInvestYear->date; $i <= date('Y'); $i++)
                                                    <option value="{{ $i }}"
                                                            @if (date('Y') == $i) selected @endif>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                            <select class="widget_select" name="invest_interest_month">
                                                <option value="01" @if (date('m') == '01') selected @endif>
                                                    @lang('January')</option>
                                                <option value="02" @if (date('m') == '02') selected @endif>
                                                    @lang('February')</option>
                                                <option value="03" @if (date('m') == '03') selected @endif>
                                                    @lang('March')</option>
                                                <option value="04" @if (date('m') == '04') selected @endif>
                                                    @lang('April')</option>
                                                <option value="05" @if (date('m') == '05') selected @endif>
                                                    @lang('May')</option>
                                                <option value="06" @if (date('m') == '06') selected @endif>
                                                    @lang('June')</option>
                                                <option value="07" @if (date('m') == '07') selected @endif>
                                                    @lang('July')</option>
                                                <option value="08" @if (date('m') == '08') selected @endif>
                                                    @lang('August')</option>
                                                <option value="09" @if (date('m') == '09') selected @endif>
                                                    @lang('September')</option>
                                                <option value="10" @if (date('m') == '10') selected @endif>
                                                    @lang('October')</option>
                                                <option value="11" @if (date('m') == '11') selected @endif>
                                                    @lang('November')</option>
                                                <option value="12" @if (date('m') == '12') selected @endif>
                                                    @lang('December')</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chartjs-chart" id="chartjs-boundary-area-chart" height="80"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-0">@lang('Recent Investments')</div>
                        </div>
                        <div class="card-body">
                            <div class="plan-list d-flex flex-wrap flex-xxl-column gap-3 gap-xxl-0">
                                @foreach ($recentInvests as $invest)
                                    <div class="plan-item-two">
                                        <div class="plan-info plan-inner-div">
                                            <div class="plan-name fw-bold">{{ $invest->project->title }} -
                                                @lang('Every')
                                                {{ __($invest->time_name) }}
                                                {{ $invest->project->interest_type != 1 ? gs('cur_sym') : '' }}{{ showAmount($invest->project->share_amount, currencyFormat: false) }}{{ $invest->project->interest_type == 1 ? '%' : '' }}
                                                @lang('for') @if ($invest->project->lifetime == 0)
                                                    {{ __($invest->project->repeat_time) }}
                                                    {{ __(@$invest->project->time->name) }}
                                                @else
                                                    @lang('LIFETIME')
                                                @endif
                                            </div>
                                            <div class="plan-desc text-end text-xl-start">@lang('Invested'): <span
                                                    class="fw-bold">{{ showAmount($invest->total_price) }}</span></div>
                                        </div>
                                        <div class="plan-start plan-inner-div">
                                            <p class="plan-label">@lang('Mature Time')</p>
                                            <p class="plan-value date">
                                                {{ convertMatureTime($invest->project->maturity_time) }}</p>
                                        </div>
                                        <div class="plan-end plan-inner-div">
                                            <p class="plan-label">@lang('Invested at')</p>
                                            <p class="plan-value date">
                                                {{ showDateTime($invest->created_at, 'd M, y h:i A') }}</p>
                                        </div>
                                        <div class="plan-amount plan-inner-div text-end">
                                            <p class="plan-label">@lang('Net Profit')</p>
                                            <p class="plan-value amount">
                                                {{--                                                @if ($invest->period != -1)--}}
                                                {{--                                                    @if ($invest->project->is_dispatch == Status::INTEREST_DISPATCH)--}}
                                                {{--                                                        {{ showAmount($invest->period * $invest->interest) }}--}}
                                                {{--                                                    @else--}}
                                                {{--                                                        @lang('On Production')--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                @else--}}
                                                {{--                                                    ----}}
                                                {{--                                                @endif--}}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
@endpush
@push('style')
    <style>
        .widget_select {
            padding: 3px 3px;
            font-size: 13px;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>
    <script>
        'use strict';
        (function ($) {
            $('[name=invest_time]').on('change', function () {
                let time = $(this).val();
                var url = "{{ route('admin.invest.report.statistics') }}";
                $.get(url, {
                    time: time
                }, function (response) {
                    $('.time_type').text(time);
                    $('.total_invest').text(response.total_invest.toFixed(2));

                    let upDown = `<small>Previous ${time} invest was zero</small>`;
                    if (response.invest_diff != 0) {
                        if (response.up_down == 'up') {
                            var className = 'success'
                        } else {
                            var className = 'danger';
                        }
                        upDown =
                            `<span class="badge badge-${className}-inverse font-16">${response.invest_diff}%<i class="las la-arrow-${response.up_down}"></i></span>`;
                    }

                    $('.up_down').html(upDown);
                    $('.my_invest_canvas').html(
                        '<canvas height="150" id="invest_chart" class="chartjs-chart mt-4"></canvas>'
                    )
                    var ctx = document.getElementById('invest_chart');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(response.invests),
                            datasets: [{
                                data: Object.values(response.invests),
                                backgroundColor: [
                                    @for ($i = 0; $i < 365; $i++)
                                        '#6c5ce7',
                                    @endfor

                                ],
                                borderColor: [
                                    'rgba(231, 80, 90, 0.75)'
                                ],
                                borderWidth: 0,

                            }]
                        },
                        options: {
                            aspectRatio: 1,
                            responsive: true,
                            maintainAspectRatio: true,
                            elements: {
                                line: {
                                    tension: 0 // disables bezier curves
                                }
                            },
                            scales: {
                                xAxes: [{
                                    display: false
                                }],
                                yAxes: [{
                                    ticks: {
                                        suggestedMin: 0, // Set a minimum value
                                    },
                                    display: false
                                }]
                            },
                            legend: {
                                display: false,
                            },
                            tooltips: {
                                callbacks: {
                                    label: (tooltipItem, data) => data.datasets[0].data[
                                        tooltipItem.index] + ' {{ gs('cur_text') }}'
                                }
                            }
                        }
                    });
                });
            }).change();

            $('[name=project_statistics_time]').on('change', function () {
                let time = $('[name=project_statistics_time]').val();
                let investType = $('[name=project_statistics_invests]').val();
                var url = "{{ route('admin.invest.report.statistics.project') }}";
                $.get(url, {
                    time: time,
                    invest_type: investType
                }, function (response) {
                    $('.plan_invest_canvas').html(
                        '<canvas height="250" id="project_invest_statistics"></canvas>');
                    let invests = response.invest_data;
                    let planInfo = '';
                    let investAmount = [];
                    let planName = [];
                    let planUrl = "{{ route('admin.report.invest.history') }}";
                    $.each(invests, function (key, invest) {
                        let investPercent = (invest.investAmount / response.total_invest) * 100;
                        investAmount.push(parseFloat(invest.investAmount).toFixed(2));
                        planName.push(invest.project.title);
                        planInfo +=
                            `<li class="chart-info-list-item"><i class="fas fa-plane projectPoint me-2"></i>${investPercent.toFixed(2)}% - ${invest.project.title} <a href="${planUrl}?search=${invest.project.title}"><i class="las la-external-link-alt" title="@lang('Go to project')"></i></a></li>`
                    });
                    $('.project-info-data').html(planInfo);

                    /* -- Chartjs - Pie Chart -- */
                    var pieChartID = document.getElementById("project_invest_statistics").getContext(
                        '2d');
                    var pieChart = new Chart(pieChartID, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: investAmount,
                                borderColor: 'transparent',
                                backgroundColor: projectColors()
                            }]
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: (tooltipItem, data) => data.datasets[0].data[
                                        tooltipItem.index] + ' {{ gs('cur_text') }}'
                                }
                            }
                        }
                    });

                    var planPoints = $('.projectPoint');
                    planPoints.each(function (key, projectPoint) {
                        var projectPoint = $(projectPoint)
                        projectPoint.css('color', projectColors()[key])
                    })

                });
            }).change();

            $('[name=project_statistics_invests]').on('change', function () {
                $('[name=project_statistics_time]').trigger('change');
            });

            $('[name=invest_interest_time]').on('change', function () {
                let time = $(this).val();
                var url = "{{ route('admin.invest.report.interest') }}";
                $.get(url, {
                    time: time
                }, function (response) {
                    $('.runningInvests').text(`${response.running_invests}`);
                    $('.expiredInvests').text(`${response.expired_invests}`);
                    $('.interests').text(`${response.interests}`);
                });
            }).change();

            $('[name=invest_interest_year]').on('change', function () {
                let year = $('[name=invest_interest_year]').val();
                let month = $('[name=invest_interest_month]').val();
                let url = "{{ route('admin.invest.report.interest.chart') }}";
                $.get(url, {
                    year: year,
                    month: month
                }, function (response) {

                    var boundaryAreaID = document.getElementById("chartjs-boundary-area-chart")
                        .getContext('2d');
                    var boundaryArea = new Chart(boundaryAreaID, {
                        type: 'line',
                        data: {
                            labels: response.keys,
                            datasets: [{
                                backgroundColor: ["rgba(110, 129, 220,0.2)"],
                                borderColor: ["#6e81dc"],
                                pointBorderColor: ["#6e81dc", "#6e81dc", "#6e81dc",
                                    "#6e81dc", "#6e81dc", "#6e81dc", "#6e81dc"
                                ],
                                pointBackgroundColor: ["#6e81dc", "#6e81dc", "#6e81dc",
                                    "#6e81dc", "#6e81dc", "#6e81dc", "#6e81dc"
                                ],
                                pointBorderWidth: 0,
                                data: response.invests,
                                label: 'Invests',
                                fill: 'start'
                            },
                                {
                                    backgroundColor: ["rgba(252, 193, 0,0.2)"],
                                    borderColor: ["#fcc100"],
                                    pointBorderColor: ["#fcc100", "#fcc100", "#fcc100",
                                        "#fcc100", "#fcc100", "#fcc100", "#fcc100"
                                    ],
                                    pointBackgroundColor: ["#fcc100", "#fcc100", "#fcc100",
                                        "#fcc100", "#fcc100", "#fcc100", "#fcc100"
                                    ],
                                    pointBorderWidth: 0,
                                    data: response.interests,
                                    label: 'Interests',
                                    fill: 'start'
                                }
                            ]
                        },
                        options: {
                            title: {
                                text: 'fill: start',
                                display: false
                            },
                            maintainAspectRatio: true,
                            spanGaps: true,
                            elements: {
                                point: {
                                    radius: 0,
                                }
                            },
                            plugins: {
                                filler: {
                                    propagate: false
                                }
                            },
                            legend: {
                                display: true
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 0
                                    },
                                    gridLines: {
                                        color: '#dcdde1',
                                        lineWidth: 1,
                                        borderDash: [1]
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        color: '#dcdde1',
                                        lineWidth: 1,
                                        borderDash: [1],
                                        zeroLineColor: '#dcdde1',
                                    }
                                }]
                            }
                        }
                    });

                });
            }).change();

            $('[name=invest_interest_month]').on('change', function () {
                $('[name=invest_interest_year]').trigger('change');
            });


            var doughnutChartID = document.getElementById("interest_by_project").getContext('2d');
            var doughnutChart = new Chart(doughnutChartID, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: @json($interestByProjects->values()),
                        borderColor: 'transparent',
                        backgroundColor: projectColors(),
                    }],
                },
                options: {
                    responsive: true,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Doughnut Chart'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    tooltips: {
                        callbacks: {
                            label: (tooltipItem, data) => data.datasets[0].data[tooltipItem.index] +
                                ' {{ gs('cur_text') }}'
                        }
                    }
                }
            });

            var planPointInterests = $('.projectPointInterest');
            planPointInterests.each(function (key, projectPointInterest) {
                var projectPointInterest = $(projectPointInterest)
                projectPointInterest.css('color', projectColors()[key])
            })

            function projectColors() {
                return [
                    '#ff7675',
                    '#6c5ce7',
                    '#ffa62b',
                    '#ffeaa7',
                    '#D980FA',
                    '#fccbcb',
                    '#45aaf2',
                    '#05dfd7',
                    '#FF00F6',
                    '#1e90ff',
                    '#2ed573',
                    '#eccc68',
                    '#ff5200',
                    '#cd84f1',
                    '#7efff5',
                    '#7158e2',
                    '#fff200',
                    '#ff9ff3',
                    '#08ffc8',
                    '#3742fa',
                    '#1089ff',
                    '#70FF61',
                    '#bf9fee',
                    '#574b90'
                ]
            }

            let chartToggle = $('.chart-info-toggle');
            let chartContent = $(".chart-info-content");
            if (chartToggle || chartContent) {
                chartToggle.each(function () {
                    $(this).on("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).siblings().toggleClass("is-open");
                    });
                });
                chartContent.each(function () {
                    $(this).on("click", function (e) {
                        e.stopPropagation();
                    });
                });
                $(document).on("click", function () {
                    chartContent.removeClass("is-open");
                });
            }

            $('.exit-btn').on('click', function () {
                $(this).toggleClass('active');
            });

        })(jQuery);
        var elems = document.querySelector(".full-view");

        function openFullscreen() {
            if (elems.requestFullscreen) {
                elems.requestFullscreen();
            } else if (elems.mozRequestFullScreen) {
                /* Firefox */
                elems.mozRequestFullScreen();
            } else if (elems.webkitRequestFullscreen) {
                /* Chrome, Safari & Opera */
                elems.webkitRequestFullscreen();
            } else if (elems.msRequestFullscreen) {
                /* IE/Edge */
                elems.msRequestFullscreen();
            }
        }

        function closeFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                /* IE/Edge */
                document.msExitFullscreen();
            }
        }
    </script>
@endpush
