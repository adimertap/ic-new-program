@extends('home.app')

@section('title')
{{ $meta->title ?? '' }}
@endsection

@section('content')
<section class="banner">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="text-center copywriting">
                <h1 class="header-galeri">
                    <span class="text-cyan">GALLERY </span>IC EDUCATION
                </h1>
                    <div class="galeri-col-6">
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
</section>


<div class="pt-10" id="galeri-page">
    <div class="container mx-auto p-10">
        <div class="text ms-3">
            <h4>Galeri Kegiatan Kami</h4>
            <p>Dokumentasi Kegiatan IC Education Dengan Beberapa Kampus dan
                Peserta</p>
        </div>
       
        <div class="flex flex-wrap">
            @foreach ($gallery as $item)
            <div class="galeri-page-list">
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
