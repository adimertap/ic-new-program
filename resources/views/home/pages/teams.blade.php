@extends('home.app')

@section('title')
Teams |
@endsection

@section('content')
<!-- banner start -->
<section class="banner">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="text-center copywriting">
                <h1 class="header">
                    <span class="text-cyan">TEAMS </span>IC EDUCATION
                </h1>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <p class="support text-center">
                            Berkenalan Dengan Beberepa Tenaga Pendidik Professional Yang Telah Bekerjasama Dengan IC
                            Education
                        </p>
                    </div>
                    <p class="cta">
                        <a href="#kelas" class="btn btn-master btn-primary"
                            style="background-color: #FE721C!important; border:0">
                            Kenalan Yuk!
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner selesai -->

<!-- teams start -->
<div class="pt-10 teams" id="teams">
    <div class="container">
        <div class="judul-atas text-center">
            <h5 class="sub-title">Meet Our Team</h5>
            <h1 class="judulfix mt-0">Tim Professional</h1>
        </div>
        @foreach ($team as $teams)

        <div class="flex flex-col items-center">
            <div class="flex flex-col md:flex-row justify-center items-center space-x-10 p-4">
                <div class="flex flex-col items-center">
                    <div class="overflow-hidden rounded-md w-72">
                        @if($teams->photo_profile)
                        <img src="{{ asset('/pendidik/'.$teams->photo_profile)}}" alt="image-1"
                            class="mx-auto w-full" />
                        @endif
                    </div>
                </div>
                <p></p>
                <div class="mt-5">
                    <h3 class="nama">{{ $teams->nama_pendidik ?? '' }}</h3>
                    <h4 class="pendidikan">Riwayat Pendidikan</h1>
                        <ul class="ml-0">
                            @if($teams->pendidikan_1)
                                <li>{{ $teams->pendidikan_1 ?? '' }}</li>
                            @endif
                            @if($teams->pendidikan_2)
                                <li>{{ $teams->pendidikan_2 ?? '' }}</li>
                            @endif
                            @if($teams->pendidikan_3)
                                <li>{{ $teams->pendidikan_3 ?? '' }}</li>
                            @endif
                            @if($teams->pendidikan_4)
                                <li>{{ $teams->pendidikan_4 ?? '' }}</li>
                            @endif
                            @if($teams->pendidikan_5)
                                <li>{{ $teams->pendidikan_5 ?? '' }}</li>
                            @endif
                            @if($teams->pendidikan_6)
                                <li>{{ $teams->pendidikan_6 ?? '' }}</li>
                            @endif
                        </ul>
                        <h4 class="font-semibold capitalize mt-5 pengalaman">pengalaman kerja</h4>
                        <ul class="ml-0">
                            @if($teams->pengalaman_1)
                                <li>{{ $teams->pengalaman_1 ?? '' }}</li>
                            @endif
                            @if($teams->pengalaman_2)
                                <li>{{ $teams->pengalaman_2 ?? '' }}</li>
                            @endif
                            @if($teams->pengalaman_3)
                                <li>{{ $teams->pengalaman_3 ?? '' }}</li>
                            @endif
                            @if($teams->pengalaman_4)
                                <li>{{ $teams->pengalaman_4 ?? '' }}</li>
                            @endif
                            @if($teams->pengalaman_5)
                                <li>{{ $teams->pengalaman_5 ?? '' }}</li>
                            @endif
                            @if($teams->pengalaman_6)
                                <li>{{ $teams->pengalaman_6 ?? '' }}</li>
                            @endif
                        </ul>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<!-- teams selesai -->

@endsection
