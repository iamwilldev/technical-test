@extends($layout)
@section($title)

@section('content')
<div class="container-fluid">
    <!--  Owl carousel -->
    <div class="owl-carousel counter-carousel owl-theme">
        <div class="item">
            <div class="card border-0 zoom-in bg-light-primary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/') }}images/svgs/icon-user-male.svg" width="50" height="50" class="mb-3"
                            alt="" />
                        <p class="fw-semibold fs-3 text-primary mb-1"> Driver </p>
                        <h5 class="fw-semibold text-primary mb-0">{{$driver}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/') }}images/svgs/icon-briefcase.svg" width="50" height="50" class="mb-3"
                            alt="" />
                        <p class="fw-semibold fs-3 text-warning mb-1">Kendaraan</p>
                        <h5 class="fw-semibold text-warning mb-0">{{ $vehicle }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/') }}images/svgs/icon-mailbox.svg" width="50" height="50" class="mb-3"
                            alt="" />
                        <p class="fw-semibold fs-3 text-info mb-1">Approved Booking</p>
                        <h5 class="fw-semibold text-info mb-0">{{ $approvedBookings }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-danger shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/') }}images/svgs/icon-favorites.svg" width="50" height="50" class="mb-3"
                            alt="" />
                        <p class="fw-semibold fs-3 text-danger mb-1">Pending Booking</p>
                        <h5 class="fw-semibold text-danger mb-0">{{ $pendingBookings }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-success shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/') }}images/svgs/icon-speech-bubble.svg" width="50" height="50"
                            class="mb-3" alt="" />
                        <p class="fw-semibold fs-3 text-success mb-1">Rejected Booking</p>
                        <h5 class="fw-semibold text-success mb-0">{{ $rejectedBookings }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Row 1 -->
    <div class="row">
        <!-- Start Simple Pie Chart -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5>Monthly Bookings</h5>
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script src="{{ asset('/') }}js/apex-chart/apex.pie.init.js"></script> --}}
<script>

    var options1 = {
        series: {!! json_encode($series) !!},
            chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: {!! json_encode($categories) !!},
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Count Bookings'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
    chart1.render();

</script>
@endpush
