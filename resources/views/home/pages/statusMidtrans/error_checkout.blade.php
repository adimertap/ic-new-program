@extends('home.app')

@section('title')
Status Kelas |
@endsection

@section('content')
<div style="background-color: #f3f3f3!important;padding:100px">
    <div class="container" style="margin-top: 5px">
        <div class="row text-center">
            <div class="col-lg-12 col-12" style="padding-left: 400px;padding-right: 400px">
                <img src="{{ asset('images/new/error.png') }}"class="mb-5" alt=" ">
            </div>
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    Payment Status Gagal!
                </p>
                <h2 class="primary-header ">
                    Gagal Melakukan Pembayaran Kelas
                </h2>
                <a href="{{ route('user-dashboard') }}" class="btn btn-primary mt-3">
                    My Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
