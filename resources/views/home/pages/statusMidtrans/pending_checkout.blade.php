@extends('home.app')

@section('title')
Status Kelas |
@endsection

@section('content')
<div style="background-color: #f3f3f3!important;padding:100px">
    <div class="container" style="margin-top: 5px">
        <div class="row text-center">
            <div class="col-lg-12 col-12" style="padding-left: 400px;padding-right: 400px">
                <img src="{{ asset('/images/new/error.png') }}"class="mb-1" alt=" ">
            </div>
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    Payment Status Pending!
                </p>
                <h2 class="primary-header ">
                    Segera Selesaikan Pembayaran Anda
                </h2>
                <p class="text-muted mt-4">
                    Pembayaran dapat dilakukan pada link yang akan muncul setelah checkout <br> 
                    Link kedaluarsa jika telah melewati batas waktu yakni <i>24 Jam / 1 Hari</i> 
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
