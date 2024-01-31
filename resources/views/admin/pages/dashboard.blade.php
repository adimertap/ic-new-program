@extends('admin.app')

@section('title')
Dashboard
@endsection

@push('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-primary">
                                    <i class="material-icons-outlined">paid</i>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Customer Brevet AB</span>
                                    <span class="widget-stats-amount">{{ $brevet }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-warning">
                                    <i class="material-icons-outlined">person</i>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Active Users</span>
                                    <span class="widget-stats-amount">{{ $user }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-danger">
                                    <i class="material-icons-outlined">note</i>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Request Sertifikat</span>
                                    <span class="widget-stats-amount">{{ $reqSertif }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget widget-stats-large">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="widget-stats-large-chart-container">
                                    <div class="card-header">
                                        <h5 class="card-title">Customer Produk Brevet AB<span
                                                class="badge badge-light badge-style-light">Last Year</span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="apex3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('/public/assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script>

    function chart(chart) {

        var options3 = {
            chart: {
                height: 350,
                type: "bar",
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded",
                    borderRadius: 10,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"],
            },
            series: [
                {
                    name: "Brevet AB",
                    data: chart,
                },
            ],
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Des",
                ],
                labels: {
                    style: {
                        colors: "rgba(94, 96, 110, .5)",
                    },
                },
            },
            yaxis: {
                title: {
                    text: "Jumlah Peserta",
                },
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Customer";
                    },
                },
            },
            grid: {
                borderColor: "rgba(94, 96, 110, .5)",
                strokeDashArray: 4,
            },
        };

        var chart3 = new ApexCharts(document.querySelector("#apex3"), options3);
        chart3.render();
    }

    $(document).ready(function(){

        const url = "{{ route('admin-chart-brevet')}}"

        $.ajax({
            type: 'GET',
            url: url,
            success : function (data) {
                chart(data)
            }
        })

    })
</script>
@endpush