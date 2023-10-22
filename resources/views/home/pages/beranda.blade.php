@extends('home.app')

@section('title')
Beranda |
@endsection

@section('content')
<section class="banner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-12">
                <div class="row">
                    <div class="col-lg-6 col-12 copywriting">
                        <h1 class="header">
                            <span>{{ $home_title->description }}</span>
                            {{-- <span class="text-cyan">IC-Education </span>Is <br> Part Of You --}}
                        </h1>
                        <p class="support" style="font-color:white!important">
                            {{ $home_header->description }}
                        </p>
                        <p class="cta">
                            <a href="#kelas" class="btn btn-master btn-primary"
                                style="background-color: #FE721C!important; border:0">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-6 col-12 text-center">
                        <img src="{{asset('images/new/learn_2.png')}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section start -->
<div class="container" style="padding: 50px 50px 100px 50px" id="about">
    <div class="flex flex-wrap pt-20">
        <div class="w-full lg:w-1/2 self-center opacity-0" id="imageLeft">
            <img src="{{ asset('images/new/gambar2.png')}}" alt="about-us" />
        </div>
        <div class="w-full lg:w-1/2 self-center p-10">
            <h5 class="sub-title">About Us</h5>
            <div class="flex justify-left">
                <h1 class="judulfix">Apa Itu ICEDUCATION ?</h1>
            </div>
            <p class="about-text leading-8 mt-4 text-justify" style="font-weight:300">
                {{ $home_about->description ?? '' }}
            </p>
        </div>
    </div>
</div>

<section class="agenda">
    <div class="bg-gray">
        <div class="container p-10" style="padding: 100px 150px 100px 150px" id="agenda">
            <div class="row">
                <div class="col-4 mt-5">
                    <h5 class="sub-title">Our Service</h5>
                    <div class="flex justify-left">
                        <h1 class="judulfix">Agenda <br> Rutin Kami</h1>
                    </div>
                </div>
                <div class="col-8">
                    <div class="agenda-item">
                        <div class="d-flex justify-content-start">
                            <img src="{{ asset('images/new/agenda1.png')}}" alt="agenda-item" />
                            <div class="item">
                                <h5 class="judul">Kursus Brevet AB dan C</h5>
                                <p class="sub-judul text-justify">Kelas Brevet Pajak AB dan Brevet C di IC Education
                                    Center yang berlokasi di GP Plaza lt. Dasar R3 Jl. Gelora II No.01 Gelora Jakarta
                                    Pusat (Seberang halte Busway Slipi Petamburan)</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="agenda-item">
                                <div class="d-flex justify-content-start">
                                    <img src="{{ asset('images/new/agenda2.png')}}" alt="agenda-item" />
                                    <div class="item">
                                        <h5 class="judul">Ih House Training</h5>
                                        <p class="sub-judul">Inhouse Training perpajakan seperti di Bank Nagari, Padang
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="agenda-item">
                                <div class="d-flex justify-content-start">
                                    <img src="{{ asset('images/new/agenda3.png')}}" alt="agenda-item" />
                                    <div class="item">
                                        <h5 class="judul">FGD</h5>
                                        <p class="sub-judul">FGD terkait usulan peraturan perpajakan dan peraturan
                                            lainnya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="steps">
    <div class="container">
        <h2 class="judulfix text-center">Kelas Tersedia</h2>
        <p class="sub-judul">IC EDUCATION saat ini memiliki kelas yang telah tersedia dan <br> telah dijalankan di
            antaranya :</p>
        <div class="row item-step" style="margin-top: 120px!important;">
            <div class="col-lg-6 col-12 step-left">
                <img src="{{ asset('images/new/kelas1.png') }}" class="cover" alt="">
            </div>
            <div class="col-lg-6 col-12 text-left copywriting">
                <p class="sub-title">
                    Kelas Pertama
                </p>
                <h2 class="judul text-uppercase">
                    Kelas Brevet AB dan C
                    </h5>
                    <hr>
                    <p class="support">
                       {{ $home_brevet->description ?? '' }}
                    </p>
                    <p class="cta mt-5">
                        <a href="{{ route('home-brevet') }}" class="btn btn-master btn-primary"
                            style="background-color: #FE721C!important; border:0">
                            Daftar Sekarang
                        </a>
                    </p>
            </div>
        </div>
        <div class="row item-step">
            <div class="col-lg-6 col-12 text-left copywriting mt-8 pl-150">
                <p class="sub-title">
                    Kelas Kedua
                </p>
                <h2 class="judul text-uppercase">
                    Seminar Pajak
                </h2>
                <hr>
                <p class="support">
                    {{ $home_seminar->description ?? '' }}
                </p>
                <p class="cta mt-5">
                    <a href="{{ route('home-seminar') }}" class="btn btn-master btn-primary"
                        style="background-color: #FE721C!important; border:0">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
            <div class="col-lg-6 col-12 step-right">
                <img src="{{ asset('images/new/kelas2.png') }}" class="cover" alt="">
            </div>
        </div>
        <div class="row item-step">
            <div class="col-lg-6 col-12 step-left">
                <img src="{{ asset('images/new/kelas3.png') }}" class="cover" alt="">
            </div>
            <div class="col-lg-6 col-12 text-left copywriting">
                <p class="sub-title">
                    Kelas Ketiga
                </p>
                <h5 class="judul text-uppercase">
                    In House Training
                </h5>
                <hr>
                <p class="support">
                   {{ $home_house->description ?? '' }}
                </p>
                <p class="cta mt-5">
                    <a href="{{ route('home-inhouse') }}" class="btn btn-master btn-primary"
                        style="background-color: #FE721C!important; border:0">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>

        <div class="row item-step">
            <div class="col-lg-6 col-12 text-left copywriting pl-150">
                <p class="sub-title">
                    Kelas Keempat
                </p>
                <h2 class="judul text-uppercase">
                    USKP Review
                </h2>
                <hr>
                <p class="support">
                    {{ $home_uskp->description ?? '' }}
                </p>
                <p class="cta mt-5">
                    <a href="{{ route('home-uskp') }}" class="btn btn-master btn-primary"
                        style="background-color: #FE721C!important; border:0">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
            <div class="col-lg-6 col-12 step-right">
                <img src="{{ asset('images/new/kelas4.png') }}" class="cover" alt="">
            </div>
        </div>
    </div>
</section>

<!-- gallery start -->
<div class=" bg-gray pt-10 galeri" id="galeri">
    <div class="container mx-auto p-10">
        <h1 class="judulfix text-center">Galeri</h1>
        <p class="text-center mt-1">Dokumentasi Kegiatan IC Education Dengan Beberapa Kampus dan
            Peserta</p>
        <div class="flex flex-wrap pt-2 pb-2">
            @foreach ($gallery as $item)
            <div class="p-4 w-1/2 lg:w-1/4">
                <div class="overflow-hidden rounded-md shadow-md">
                    <img src="{{ asset('storage/gallery/'.$item->image)}}" alt="image-1" class="mx-auto w-full" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- gallery selesai -->

<!-- npsn section start -->
<div class="container mx-auto p-10">
    <div class="sertif flex flex-col justify-center space-y-8">
        <div class="text-center">
            <div class="w-2/3 inline-block">
                <h1 class="sub-title">Nomor Pokok Sekolah Nasional</h1>
                <h1 class="judulfix">sertifikat npsn ic education</h1>
                <p class="sub-judul">{{ $home_sertif->description }}</span>
                </p>
            </div>
        </div>
        <div class="text-center mt-5">
            <img src="{{ asset('images/npsn-icedu.png')}}" alt="" class="w-2/4 inline-block" />
        </div>
    </div>
</div>
<!-- npsn section selesai -->



<!-- produk start -->
{{-- <div class="container mx-auto px-10 pt-20 pb-10" id="produk">
    <h1 class="uppercase text-2xl text-red font-semibold text-center">Kelas Tersedia</h1>
    <div class="flex flex-col mx-10 justify-center mt-10">
        <details class="bg-gray-200 px-4 lg:px-20 py-4 rounded-t-md mb-1" open>
            <summary class="capitalize text-xl select-none cursor-pointer font-semibold">kursus brevet AB dan c
            </summary>
            <div class="mt-4">
                <p class="text-justify indent-8">
                    IC Education merupakan salah satu Brevet Pajak di Jakarta yang direkomendasikan oleh konsultan pajak
                    senior yang tergabung dengan IKPI ( Ikatan Konsultan Pajak Indonesia ), selain lokasinya yang sangat
                    strategis yaitu berada
                    di GP Plaza lt. Dasar R3 Jl. Gelora II No. 01 Gelora Jakarta Pusat, IC Education juga mampu
                    memberikan solusi dan jawaban atas permasalahan yang dialami oleh para peserta yang tergabung di
                    Brevet Pajak IC Education.
                </p>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('home-brevet') }}" class="button">Daftar Sekarang</a>
                </div>
            </div>
        </details>

        <details class="bg-gray-200 px-4 lg:px-20 py-4 mb-1">
            <summary class="capitalize text-xl select-none cursor-pointer font-semibold">seminar pajak</summary>
            <div class="mt-4">
                <p class="text-justify indent-8">Kami Mengadakan Pelatihan / Workshop / Seminar tentang Perpajakan,
                    secara rutin dan ter Update. dan juga dapat di selenggarakan dalam bentuk In House Training.</p>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('home-seminar') }}" class="button">Daftar Sekarang</a>
                </div>
            </div>
        </details>

        <details class="bg-gray-200 px-4 lg:px-20 py-4 mb-1">
            <summary class="capitalize text-xl select-none cursor-pointer font-semibold">in house training</summary>
            <div class="mt-4">
                <p class="text-justify indent-8">
                    In House Training (In Company Training) merupakan satu program unggulan yang kami hadirkan untuk
                    perusahaan/ institusi/ asosiasi yang menginginkan training akuntansi maupun pajak diselenggarakan
                    khusus untuk internal
                    perusahaan, program ini dapat didesain dan dikembangkan sesuai dengan kebutuhan intern perusahaan
                    untuk meningkatkan keahlian bidang akuntansi dan perpajakan karyawan.
                </p>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('home-inhouse') }}" class="button">Daftar Sekarang</a>
                </div>
            </div>
        </details>

        <details class="bg-gray-200 px-4 lg:px-20 py-4 mb-1 rounded-b-md">
            <summary class="capitalize text-xl select-none cursor-pointer font-semibold">USKP review</summary>
            <div class="mt-4">
                <p class="text-justify indent-8">
                    Disini IC Education ingin menawarkan solusi untuk belajar dan mempersiapkan diri untuk menghadapi
                    USKP bagi calon konsultan pajak resmi di bawah naungan Ikatan Konsultan Pajak Indonesia (IKPI),
                    dengan dibimbing oleh ahli dari
                    Direktorat Jenderal Pajak dan anggota IKPI yang sudah lulus USKP diharapkan dapat memberikan
                    motivasi lebih dan dapat memberikan tips dan triknya dalam menghadapi USKP.
                </p>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('home-uskp') }}" class="button">Daftar Sekarang</a>
                </div>
            </div>
        </details>
    </div>
</div> --}}
<!-- produk selesai -->
@endsection
