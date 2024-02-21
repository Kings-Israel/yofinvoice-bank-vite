@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  let cardColor, headingColor, labelColor, shadeColor, grayColor, legendColor, borderColor;
  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    shadeColor = 'dark';
    grayColor = '#5E6692'; // gray color is for stacked bar chart
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    shadeColor = '';
    grayColor = '#817D8D';
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

  // Color constant
  const chartColors = {
    column: {
      series1: '#826af9',
      series2: '#d2b0ff',
      bg: '#f8d3ff'
    },
    donut: {
      series1: '#0555AD',
      series2: '#9BBBDE',
      series3: '#FF9F43',
      series4: '#FFB269',
      series5: '#FFC58E',
      series6: '#FFD9B4',
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };

  'use strict';

  function EarningReportsBarChart(arrayData, highlightData) {
    const basicColor = config.colors_label.primary,
      highlightColor = config.colors.primary;
    var colorArr = [];

    for (let i = 0; i < arrayData.length; i++) {
      if (i === highlightData) {
        colorArr.push(highlightColor);
      } else {
        colorArr.push(basicColor);
      }
    }

    const earningReportBarChartOpt = {
      chart: {
        height: 258,
        parentHeightOffset: 0,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '32%',
          startingShape: 'rounded',
          borderRadius: 7,
          distributed: true,
          dataLabels: {
            position: 'top'
          }
        }
      },
      grid: {
        show: false,
        padding: {
          top: 0,
          bottom: 0,
          left: -10,
          right: -10
        }
      },
      colors: colorArr,
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val + 'k';
        },
        offsetY: -25,
        style: {
          fontSize: '15px',
          colors: [legendColor],
          fontWeight: '600',
          fontFamily: 'Public Sans'
        }
      },
      series: [
        {
          data: arrayData
        }
      ],
      legend: {
        show: false
      },
      tooltip: {
        enabled: false
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        axisBorder: {
          show: true,
          color: borderColor
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px',
            fontFamily: 'Public Sans'
          }
        }
      },
      yaxis: {
        labels: {
          offsetX: -15,
          formatter: function (val) {
            return parseInt(val / 1) + 'k';
          },
          style: {
            fontSize: '13px',
            colors: labelColor,
            fontFamily: 'Public Sans'
          },
          min: 0,
          max: 60000,
          tickAmount: 6
        }
      },
      responsive: [
        {
          breakpoint: 1441,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '41%'
              }
            }
          }
        },
        {
          breakpoint: 590,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '61%',
                borderRadius: 5
              }
            },
            yaxis: {
              labels: {
                show: false
              }
            },
            grid: {
              padding: {
                right: 0,
                left: -20
              }
            },
            dataLabels: {
              style: {
                fontSize: '12px',
                fontWeight: '400'
              }
            }
          }
        }
      ]
    };
    return earningReportBarChartOpt;
  }

  var chartJson = 'earning-reports-charts.json';
  // Earning Chart JSON data
  var earningReportsChart = $.ajax({
    url: assetsPath + 'json/' + chartJson, //? Use your own search api instead
    dataType: 'json',
    async: false
  }).responseJSON;

  // Earning Reports Tabs Orders
  // --------------------------------------------------------------------
  const earningReportsTabsOrdersEl = document.querySelector('#earningReportsTabsOrders'),
    earningReportsTabsOrdersConfig = EarningReportsBarChart(
      earningReportsChart['data'][0]['chart_data'],
      earningReportsChart['data'][0]['active_option']
    );
  if (typeof earningReportsTabsOrdersEl !== undefined && earningReportsTabsOrdersEl !== null) {
    const earningReportsTabsOrders = new ApexCharts(earningReportsTabsOrdersEl, earningReportsTabsOrdersConfig);
    earningReportsTabsOrders.render();
  }

  // Earning Reports Tabs Sales
  // --------------------------------------------------------------------
  const earningReportsTabsSalesEl = document.querySelector('#earningReportsTabsSales'),
    earningReportsTabsSalesConfig = EarningReportsBarChart(
      earningReportsChart['data'][1]['chart_data'],
      earningReportsChart['data'][1]['active_option']
    );
  if (typeof earningReportsTabsSalesEl !== undefined && earningReportsTabsSalesEl !== null) {
    const earningReportsTabsSales = new ApexCharts(earningReportsTabsSalesEl, earningReportsTabsSalesConfig);
    earningReportsTabsSales.render();
  }
  // Earning Reports Tabs Profit
  // --------------------------------------------------------------------
  const earningReportsTabsProfitEl = document.querySelector('#earningReportsTabsProfit'),
    earningReportsTabsProfitConfig = EarningReportsBarChart(
      earningReportsChart['data'][2]['chart_data'],
      earningReportsChart['data'][2]['active_option']
    );
  if (typeof earningReportsTabsProfitEl !== undefined && earningReportsTabsProfitEl !== null) {
    const earningReportsTabsProfit = new ApexCharts(earningReportsTabsProfitEl, earningReportsTabsProfitConfig);
    earningReportsTabsProfit.render();
  }
  // Earning Reports Tabs Income
  // --------------------------------------------------------------------
  const earningReportsTabsIncomeEl = document.querySelector('#earningReportsTabsIncome'),
    earningReportsTabsIncomeConfig = EarningReportsBarChart(
      earningReportsChart['data'][3]['chart_data'],
      earningReportsChart['data'][3]['active_option']
    );
  if (typeof earningReportsTabsIncomeEl !== undefined && earningReportsTabsIncomeEl !== null) {
    const earningReportsTabsIncome = new ApexCharts(earningReportsTabsIncomeEl, earningReportsTabsIncomeConfig);
    earningReportsTabsIncome.render();
  }

  // Donut Chart
  // --------------------------------------------------------------------
  const donutChartEl = document.querySelector('#donutChart'),
    donutChartConfig = {
      chart: {
        height: 390,
        type: 'donut'
      },
      labels: ['174 Approved', '19 Paid', '17 Pending(Checker)', '17 Pending(Maker)'],
      series: [42, 7, 25, 25],
      colors: [
        chartColors.donut.series1,
        chartColors.donut.series4,
        chartColors.donut.series3,
        chartColors.donut.series2
      ],
      stroke: {
        show: false,
        curve: 'straight'
      },
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return parseInt(val, 10) + '%';
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        markers: { offsetX: -3 },
        itemMargin: {
          vertical: 3,
          horizontal: 10
        },
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Open Sans'
              },
              value: {
                fontSize: '1.2rem',
                color: legendColor,
                fontFamily: 'Open Sans',
                formatter: function (val) {
                  return parseInt(val, 10) + '%';
                }
              },
              total: {
                show: true,
                fontSize: '1.5rem',
                color: headingColor,
                label: '',
                formatter: function (w) {
                  return '';
                }
              }
            }
          }
        }
      },
      responsive: [
        {
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      fontSize: '1.5rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            chart: {
              height: 280
            },
            legend: {
              show: false
            }
          }
        },
        {
          breakpoint: 360,
          options: {
            chart: {
              height: 250
            },
            legend: {
              show: false
            }
          }
        }
      ]
    };
  if (typeof donutChartEl !== undefined && donutChartEl !== null) {
    const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
    donutChart.render();
  }
</script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">{{ $bank->name }}</span>
</h4>

<div class="row">
  <div class="col-12">
    <div class="swiper-container swiper-container-horizontal swiper p-0" id="swiper-with-pagination-cards">
      <div class="swiper-wrapper">
        <div class="swiper-slide p-0">
          <div class="row match-height">
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-primary" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Onboarded Companies</small>
                    <h5 class="mb-0 me-2">Anchors <span class="text-success">(26)</span></h5>
                    <h6 class="mb-0 me-2">Total Companies - 121</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-primary p-2">
                      <i class='ti ti-user ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-secondary" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Maturing Payment</small>
                    <h5 class="mb-0 me-2">4567</h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-danger p-2">
                      <i class='ti ti-user-plus ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-warning" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Payment Pending Approval</small>
                    <h5 class="mb-0 me-2">19,860 <span class="text-danger">(-4%)</span></h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-success p-2">
                      <i class='ti ti-user-check ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-danger" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Disbursed Payment(MTD)</small>
                    <h5 class="mb-0 me-2">237 <span class="text-success">(+33%)</span></h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-warning rounded-pill p-2">
                      <i class='ti ti-user ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide p-0">
          <div class="row match-height">
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-primary" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Onboarded Companies</small>
                    <h5 class="mb-0 me-4">Vendors <span class="text-danger">(62)</span></h5>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-primary p-2">
                      <i class='ti ti-user-check ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-secondary" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Maturing Payment</small>
                    <h5 class="mb-0 me-2">8,863</h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-danger p-2">
                      <i class='ti ti-user-plus ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-waring" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Payment Pending Approval</small>
                    <h5 class="mb-0 me-2">19,860 <span class="text-danger">(-4%)</span></h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-success p-2">
                      <i class='ti ti-user-check ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-danger" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Disbursed Payment(MTD)</small>
                    <h5 class="mb-0 me-2">237 <span class="text-success">(+33%)</span></h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-warning rounded-pill p-2">
                      <i class='ti ti-user ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide p-0">
          <div class="row match-height">
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-primary" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Onboarded Companies</small>
                    <h5 class="mb-0 me-4">Buyers <span class="text-danger">(62)</span></h5>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-primary p-2">
                      <i class='ti ti-user-check ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-secondary" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Maturing Payment</small>
                    <h5 class="mb-0 me-2">8,863</h5>
                    <h6 class="mb-0 me-2">Dealer Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-danger p-2">
                      <i class='ti ti-user-plus ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-warning" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Payment Pending Approval</small>
                    <h5 class="mb-0 me-2">19,860 <span class="text-danger">(-4%)</span></h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-success p-2">
                      <i class='ti ti-user-check ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card h-100 border border-info" style="box-shadow: none">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="card-title mb-0">
                    <small>Disbursed Payment(MTD)</small>
                    <h5 class="mb-0 me-2">237 <span class="text-success">(+33%)</span></h5>
                    <h6 class="mb-0 me-2">Vendor Financing</h6>
                  </div>
                  <div class="card-icon">
                    <span class="badge bg-label-warning rounded-pill p-2">
                      <i class='ti ti-user ti-sm'></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Latest Vendor Financing Requests -->
  <div class="col-12 mt-4">
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Latest Vendor Financing Requests</h5>
        <a class="card-header" href="#">View All</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Vendor</th>
              <th>Payment A/C No.</th>
              <th>Approved Limit(KSH)</th>
              <th>Drawing Power(KSH)</th>
              <th>Utilized Limit(KSH)</th>
              <th>Pipeline Requests(KSH)</th>
              <th>Available Limit(KSH)</th>
              <th>Overdue Amount(KSH)</th>
              <th>DPD Days</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0 text-nowrap">
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-warning me-1">Pending Checker</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-success me-1">Approved</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-warning me-1">Pending Maker</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-success me-1">Approved</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-warning me-1">Pending Maker</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Latest Vendor Financing Requests -->

  <!-- Latest Vendor Financing Requests -->
  <div class="col-12 mt-4">
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Latest Dealer Financing Requests</h5>
        <a class="card-header" href="#">View All</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Vendor</th>
              <th>Payment A/C No.</th>
              <th>Approved Limit(KSH)</th>
              <th>Drawing Power(KSH)</th>
              <th>Utilized Limit(KSH)</th>
              <th>Pipeline Requests(KSH)</th>
              <th>Available Limit(KSH)</th>
              <th>Overdue Amount(KSH)</th>
              <th>DPD Days</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0 text-nowrap">
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-warning me-1">Pending Checker</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-success me-1">Approved</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-warning me-1">Pending Maker</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-success me-1">Approved</span></td>
            </tr>
            <tr>
              <td><strong>Alice Aleco</strong></td>
              <td>0954094095</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(200000000) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td class="text-success">{{ number_format(0) }}</td>
              <td><span class="badge bg-label-warning me-1">Pending Maker</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Latest Vendor Financing Requests -->

  <!-- Earnings Report -->
  <div class="col-12 mt-4">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between">
        <div class="card-title m-0">
          <h5 class="mb-0">Earnings Report</h5>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="earningReportsTabsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">
            <a class="dropdown-item" href="javascript:void(0);">View More</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs widget-nav-tabs pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link btn active d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id" aria-controls="navs-orders-id" aria-selected="true">
              <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-shopping-cart ti-sm"></i></div>
              <h6 class="tab-widget-title mb-0 mt-2">Disbursed Value</h6>
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id" aria-controls="navs-sales-id" aria-selected="false">
              <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-chart-bar ti-sm"></i></div>
              <h6 class="tab-widget-title mb-0 mt-2"> Total Income</h6>
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id" aria-controls="navs-profit-id" aria-selected="false">
              <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-currency-dollar ti-sm"></i></div>
              <h6 class="tab-widget-title mb-0 mt-2">Total PI Value</h6>
            </a>
          </li>
        </ul>
        <div class="tab-content p-0 ms-0 ms-sm-2">
          <div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel">
            <div id="earningReportsTabsOrders"></div>
          </div>
          <div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
            <div id="earningReportsTabsSales"></div>
          </div>
          <div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
            <div id="earningReportsTabsProfit"></div>
          </div>
          <div class="tab-pane fade" id="navs-income-id" role="tabpanel">
            <div id="earningReportsTabsIncome"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Earnings Report -->
</div>
@endsection
