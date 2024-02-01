@extends('user.layouts.user-app')

@section('title')
Kelas Ujian
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="
            d-sm-flex
            align-items-center
            justify-content-between
            mb-4
        ">
        <h1 class="h3 mb-0 text-gray-800">Kelas Ujian</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="
                    card
                    border-left-danger
                    shadow
                    h-100
                    py-2
                ">
                <div class="card-body">
                    <img src="{{ asset('/userAdmin/frontend/image/katalog.png')}}" class="card-img-top" alt="">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                <h6 class="font-weight-bold">
                                    Ujian Brevet AB/C
                                </h6>
                            </div>
                            <a href="{{ route('list') }}" class="btn btn-danger">
                                <span class="icon text-white-50">
                                    <i class="far fa-file-alt" style="color: white"></i>
                                </span>
                                <span class="text">Lihat Materi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
