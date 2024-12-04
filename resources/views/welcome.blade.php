@extends('layouts.theme.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"> </li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="img-fluid d-block img-banner"
                                src="https://aub.ac.bd/static/assets/images/default-banner.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid d-block img-banner"
                                src="https://aub.ac.bd/static/assets/images/default-banner.jpg" alt="Second slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                        data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span
                            class="sr-only">Previous</span></a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                        data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span
                            class="sr-only">Next</span></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body border-bottom pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Best Of The Month</h5>

                    </div>
                    <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation"><button class="nav-link active" id="analytics-tab-1"
                                data-bs-toggle="tab" data-bs-target="#analytics-tab-1-pane" type="button" role="tab"
                                aria-controls="analytics-tab-1-pane" aria-selected="true">SS Of The Month</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-2"
                                data-bs-toggle="tab" data-bs-target="#analytics-tab-2-pane" type="button" role="tab"
                                aria-controls="analytics-tab-2-pane" aria-selected="false" tabindex="-1">OSR Of The
                                Month</button>
                        </li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-3"
                                data-bs-toggle="tab" data-bs-target="#analytics-tab-3-pane" type="button" role="tab"
                                aria-controls="analytics-tab-3-pane" aria-selected="false" tabindex="-1">CSR Of The
                                Month</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">

                    <!-- disini adalah SS -->
                    <div class="tab-pane fade" id="analytics-tab-1-pane" role="tabpanel" aria-labelledby="analytics-tab-1"
                        tabindex="0">
                        <ul class="list-group list-group-flush">
                            @forelse ($topUsersSS as $ss)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s border">{{ substr($ss->fullname, 0, 2) }}</div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row g-1">
                                                <div class="col-6">
                                                    <h6 class="mb-0">{{ $ss->fullname }}</h6>
                                                    <p class="text-muted mb-0"><small>{{ $ss->groupName }}</small></p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <h6 class="mb-1">{{ $ss->total }} Planned</h6>
                                                    <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i>
                                                        {{ $ss->total }} Actually</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <div class="alert alert-danger" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            class="me-2 fw-bold" fill="currentColor" class="bi bi-exclamation-triangle"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                                            <path
                                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                        </svg>
                                        Suggestion System Not Found
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- disini adalah OSR -->
                    <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-2" tabindex="0">
                        <ul class="list-group list-group-flush">
                            @forelse ($topUsersOSR as $osr)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s border">HO</div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row g-1">
                                                <div class="col-6">
                                                    <h6 class="mb-0">Hai Ojan</h6>
                                                    <p class="text-muted mb-0"><small>MSTD IT Functional Dev</small></p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <h6 class="mb-1">3 Planned</h6>
                                                    <p class="text-danger mb-0"><i class="ti ti-arrow-down-left"></i> 1
                                                        Actually</p>
                                                    {{-- <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10 Actually</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <div class="alert alert-danger" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            class="me-2 fw-bold" fill="currentColor" class="bi bi-exclamation-triangle"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                                            <path
                                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                        </svg>
                                        One Sheet Report Not Found
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- disini adalah CSR -->
                    <div class="tab-pane fade" id="analytics-tab-3-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-3" tabindex="0">
                        <ul class="list-group list-group-flush">
                            @forelse ($topUsersCSR as $csr)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s border">{{ substr($csr->fullname, 0, 2) }}</div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row g-1">
                                                <div class="col-6">
                                                    <h6 class="mb-0">{{ $csr->fullname }}</h6>
                                                    <p class="text-muted mb-0"><small>{{ $csr->groupName }}</small></p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <h6 class="mb-1">{{ $csr->total }} Planned</h6>
                                                    <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i>
                                                        {{ $csr->total }} Actually</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <div class="alert alert-danger" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            class="me-2 fw-bold" fill="currentColor" class="bi bi-exclamation-triangle"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                                            <path
                                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                        </svg>
                                        Cost Saving Report Not Found
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body border-bottom pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Best Of The Month</h5>

                    </div>
                    <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation"><button class="nav-link active" id="analytics-tab-1"
                                data-bs-toggle="tab" data-bs-target="#analytics-tab-4-pane" type="button"
                                role="tab" aria-controls="analytics-tab-4-pane" aria-selected="true">MP Info</button>
                        </li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-2"
                                data-bs-toggle="tab" data-bs-target="#analytics-tab-5-pane" type="button"
                                role="tab" aria-controls="analytics-tab-5-pane" aria-selected="false"
                                tabindex="-1">QCC</button>
                        </li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="analytics-tab-3"
                                data-bs-toggle="tab" data-bs-target="#analytics-tab-6-pane" type="button"
                                role="tab" aria-controls="analytics-tab-6-pane" aria-selected="false"
                                tabindex="-1">QCP</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">

                    <!-- MP INFO -->
                    <div class="tab-pane fade" id="analytics-tab-4-pane" role="tabpanel"aria-labelledby="analytics-tab-2"
                        tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border">HO</div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Hai Ojan</h6>
                                                <p class="text-muted mb-0"><small>MSTD IT Functional Dev</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">3 Planned</h6>
                                                <p class="text-danger mb-0"><i class="ti ti-arrow-down-left"></i> 1
                                                    Actually</p>
                                                {{-- <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10 Actually</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="10,000 Tracks"><span>YP</span></div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Yudha Pratama</h6>
                                                <p class="text-muted mb-0"><small>Manufacture System Tech Dev</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">3 Planned</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10
                                                    Actually</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- QCC -->
                    <div class="tab-pane fade" id="analytics-tab-5-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-5" tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border">HO</div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Hai Ojan</h6>
                                                <p class="text-muted mb-0"><small>MSTD IT Functional Dev</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">3 Planned</h6>
                                                <p class="text-danger mb-0"><i class="ti ti-arrow-down-left"></i> 1
                                                    Actually</p>
                                                {{-- <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10 Actually</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s border" data-bs-toggle="tooltip"
                                            data-bs-title="10,000 Tracks"><span>YP</span></div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <h6 class="mb-0">Yudha Pratama</h6>
                                                <p class="text-muted mb-0"><small>Manufacture System Tech Dev</small></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-1">3 Planned</h6>
                                                <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> 10
                                                    Actually</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- QCP -->
                    <div class="tab-pane fade" id="analytics-tab-6-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-6" tabindex="0">
                        <ul class="list-group list-group-flush">
                            @foreach ($topUsersQCP as $user)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s border">{{ substr($user->fullname, 0, 2) }}</div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row g-1">
                                                <div class="col-6">
                                                    <h6 class="mb-0">{{ $user->fullname }}</h6>
                                                    <p class="text-muted mb-0"><small>{{ $user->groupName }}</small></p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <h6 class="mb-1">{{ $user->total }} Planned</h6>
                                                    <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i>
                                                        {{ $user->total }} Actually</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="title">
                            <h5 class="mb-0">Dept Of The Month</h5>
                            <p class="text-muted mt-0 mb-0">Filter Your Chart And Show Data</p>
                        </div>
                        <div class="filter d-flex">
                            <select name="" id="" class="form-select" style="width: 80px;">
                                <option value="">SS</option>
                                <option value="">OSR</option>
                                <option value="">CSR</option>
                                <option value="">QCC</option>
                            </select>
                            <select name="" id="" class="form-select ms-2" style="width: 100px;">
                                <option value="">Month</option>
                                <option value="">Years</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom pb-0">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [{
                name: 'Actual',
                data: [{
                        x: 'MSTD',
                        y: 3,
                        goals: [{
                            name: 'Expected',
                            value: 6,
                            strokeWidth: 2,
                            strokeDashArray: 2,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'RnD Pharma',
                        y: 7,
                        goals: [{
                            name: 'Expected',
                            value: 6,
                            strokeWidth: 5,
                            strokeHeight: 10,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Quality Control',
                        y: 5,
                        goals: [{
                            name: 'Expected',
                            value: 6,
                            strokeWidth: 10,
                            strokeHeight: 0,
                            strokeLineCap: 'round',
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Quality System',
                        y: 4,
                        goals: [{
                            name: 'Expected',
                            value: 6,
                            strokeWidth: 10,
                            strokeHeight: 0,
                            strokeLineCap: 'round',
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Minico 1',
                        y: 12,
                        goals: [{
                            name: 'Expected',
                            value: 6,
                            strokeWidth: 10,
                            strokeHeight: 0,
                            strokeLineCap: 'round',
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Minico 2',
                        y: 3,
                        goals: [{
                            name: 'Expected',
                            value: 6,
                            strokeWidth: 5,
                            strokeHeight: 10,
                            strokeColor: '#775DD0'
                        }]
                    }
                ]
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false // ini akan menyembunyikan action toolbar
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            colors: ['#00E396'],
            dataLabels: {
                formatter: function(val, opt) {
                    const goals =
                        opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
                        .goals
                }
            },
            legend: {
                show: true,
                showForSingleSeries: true,
                customLegendItems: ['Actual', 'Expected'],
                markers: {
                    fillColors: ['#00E396', '#775DD0']
                }
            }
        };

        var chart_1 = new ApexCharts(document.querySelector("#chart"), options);
        chart_1.render();
    </script>
@endsection
