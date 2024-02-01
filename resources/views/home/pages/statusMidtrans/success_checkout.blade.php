@extends('home.app')

@section('title')
Status Pembayaran |
@endsection

@section('content')
<div style="background-color: #f3f3f3!important;padding:100px">
    <div class="container" style="margin-top: 5px">
        <div class="row text-center">
            <div class="col-lg-12 col-12" style="padding-left: 400px;padding-right: 400px">
                <img src="{{ asset('/images/new/success.png') }}"class="mb-2" alt="">
            </div>
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story" style="color: rgb(51, 196, 60) !important">
                    Payment Status Success!
                </p>
                <h2 class="primary-header ">
                    Pembayaran Anda Telah Berhasil!
                </h2>
                <p class="text-muted mt-4">
                    Selamat, pembayaran Anda berhasil dan telah kami terima, <br> selamat bergabung pada kelas pelatihan Ini.
                </p>
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
