@extends('home.app')

@section('title')
Galeri |
@endsection

@section('content')
<section class="banner">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="text-center copywriting">
                <h1 class="header">
                    <span class="text-cyan">GALLERY </span>IC EDUCATION
                </h1>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <p class="support text-center">
                            Beberapa dokumentasi kami ketika pelaksanaan Kelas Brevet AB dan C, USKP Review maupun Seminar Perpajakan
                            Dan Juga kami melakuka MoU ke beberapa Universitas
                        </p>
                    </div>
                    <p class="cta">
                        <a href="#kelas" class="btn btn-master btn-primary"
                            style="background-color: #FE721C!important; border:0">
                            Lihat Yuk!
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <div class="w-full h-full bg-pink pt-2" id="banner">
    <div class="mt-16 container mx-auto p-10">
        <div class="flex flex-col-reverse justify-center md:flex-row md:space-x-3">
            <div class="w-full md:w-1/2 pt-10 pb-10">
                <h1 class="text-red block text-6xl font-semibold mt-2 uppercase">galeri</h1>
                <p>
                    <span class="text-lg block mt-6 text-justify">Beberapa dokumentasi kami ketika pelaksanaan Kelas
                        Brevet AB, USKP Review maupun Seminar Perpajakan Dan Juga kami melakuka MoU ke beberapa
                        Universitas</span>
                </p>
                <div class="mt-8">
                    <a href="#galeri" class="button">Lihat Yuk</a>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="{{ asset('images/banner-galeri.png')}}" alt="" />
</div>
</div>
</div>
</div> --}}
<!-- banner selesai -->

<!-- gallery start -->
<div class="pt-10" id="galeri-page">
    <div class="container mx-auto p-10">
        <div class="text ms-3">
            <h4>Galeri Kegiatan Kami</h4>
            <p>Dokumentasi Kegiatan IC Education Dengan Beberapa Kampus dan
                Peserta</p>
        </div>
       
        <div class="flex flex-wrap">
            @foreach ($gallery as $item)
            <div class="p-3 w-1/2 lg:w-1/4">
                <div class="overflow-hidden rounded-md shadow-md">
                    <img src="{{ asset('storage/gallery/'.$item->image)}}" alt="image-1" class="mx-auto w-full" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- gallery selesai -->
@endsection
