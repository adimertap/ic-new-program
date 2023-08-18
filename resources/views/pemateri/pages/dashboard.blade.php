@extends('pemateri.app')

@section('title')
Dashboard
@endsection

@push('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
<link href="{{ asset('assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
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
                <div class="col-xl-12">
                    <div class="card widget widget-stats-large">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="widget-stats-large-chart-container">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <p>Nama Lengkap</p>
                                                <p>Materi Yang Diajarkan</p>
                                                <p>Kode Soal</p>
                                            </div>
                                            <div class="col">
                                                <p><strong>{{ $user->user->name }}</strong></p>
                                                <p><strong>{{ $user->materi->description }}</strong></p>
                                                @foreach (json_decode($user->kode_soal) as $key => $value)
                                                    <p><strong>{{ ($key + 1).'. '.$value }}</strong></p>
                                                @endforeach
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
    </div>
</div>
@endsection