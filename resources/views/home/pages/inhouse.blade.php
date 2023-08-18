@extends('home.app')

@section('title')
In House Training |
@endsection

@section('content')
<div style="background-color: #f3f3f3!important">

    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12 copywriting mt-3">
                            <h1 class="header-kelas">
                                {{ $judul->description_1 ?? '' }}
                            </h1>
                            <p class="support">
                                {{ $header->description_1 ?? '' }}
                            </p>
                            <p class="cta">
                                <a href="#kelas" class="btn btn-master btn-primary"
                                    style="background-color: #FE721C!important; border:0">
                                    Lihat Lebih Lanjut
                                </a>
                            </p>
                        </div>
                        <div class="col-lg-6 col-12 text-center">
                            <img src="{{asset('images/new/inhouse.png')}}" class="img-fluid-kelas" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="agenda">
        <div class="bg-gray">
            <div class="container-agenda" style="padding: 100px 150px 100px 200px" id="agenda">
                <div class="row">
                    <div class="col-3" style="margin-top: 80px">
                        <h5 class="sub-title" style="line-height: 25px">Kelas</h5>

                        <div class="flex justify-left">
                            <h1 class="judulfix" style="line-height: 35px">In House<br>
                                Training</h1>
                        </div>
                        <div class="flex justify-start  mt-5 ">
                            <p class="text-muted small">Kontak Kami <br> untuk info lebih lanjut</p>

                        </div>

                    </div>
                    <div class="col-9">
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Bagaimana In House Training pada IC Education?</h5>
                                    <p class="sub-judul mt-3 text-justify"
                                        style="line-height: 35px; font-size:16px !important">
                                        {{ $header->description_2 ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="text-center btn btn-sm btn-primary ms-4 mt-5">Kontak Kami</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
