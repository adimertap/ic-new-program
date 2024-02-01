@extends('home.app')

@section('title')
    Beranda |
@endsection

@section('content')
<!-- banner start -->





<div class="w-full h-full bg-pink pt-2" id="banner">
    <div class="mt-16 container mx-auto p-10">
        <div class="flex flex-col-reverse md:flex-row md:space-x-3">
            <div class="basis-1/2 pt-20 pb-10">
                <h1 class="text-red block text-5xl">IC Education Is</h1>
                <h1 class="text-red block text-6xl font-semibold mt-2">Part Of You</h1>
                <p>
                    <span class="text-lg block mt-6 text-justify">
                        Lembaga Pelatihan dan Pendidikan Non Formal dalam bidang keuangan dan bisnis yang
                        menyelenggarakan kursus perpajakan, kepabeanan, akuntansi, manajemen dan keuangan yang
                        dibutuhkan dunia bisnis masa kini.
                    </span>
                </p>
                <div class="mt-8">
                    <a href="#about" class="button">Kenalan Yuk</a>
                </div>
            </div>
            <div class="basis-1/2 flex justify-center">
                <img src="{{ asset('/images/slider-icon.png')}}" alt="" />
            </div>
        </div>
    </div>
</div>
<!-- banner selesai -->

<!-- section start -->
<div class="container mx-auto p-10" id="about">
    <div class="flex flex-wrap pt-20">
        <div class="w-full lg:w-1/2 self-center opacity-0" id="imageLeft">
            <img src="{{ asset('/images/left-image.png')}}" alt="" />
        </div>
        <div class="w-full lg:w-1/2 self-center p-10">
            <div class="flex justify-center">
                <h1 class="uppercase text-2xl font-semibold self-center text-red">apa itu iceducation ?</h1>
            </div>
            <p class="indent-8 leading-8 mt-10 text-justify">
                IC EDUCATION adalah Lembaga Pelatihan dan Pendidikan Non Formal dalam bidang keuangan dan bisnis yang
                menyelenggarakan kursus perpajakan, kepabeanan, akuntansi, manajemen dan keuangan yang dibutuhkan dunia
                bisnis masa kini. IC
                EDUCATION merupakan hasil inisiasi dan buah pemikiran dari para partner, konsultan, klien, dunia bisnis,
                dunia akademisi yang selama ini berkecimpung aktif dalam kegiatan konsultan pajak, bea cukai, manajemen
                dalam satu wadah IC
                CONSULTANT.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto p-10" id="about2">
    <div class="flex flex-wrap-reverse">
        <div class="w-full lg:w-1/2 self-center p-10">
            <div class="flex justify-center">
                <h1 class="uppercase text-2xl font-semibold self-center text-red">agenda rutin ?</h1>
            </div>
            <p class="indent-8 leading-8 mt-10 text-justify">IC EDUCATION saat ini memiliki agenda rutin yang telah dan
                akan dijalankan adalah di antaranya :</p>
            <div class="mt-8 flex flex-col space-y-5">
                <div class="flex space-x-5">
                    <div class="flex-none w-14">
                        <img src="{{ asset('/images/ic-satu.png')}}" alt="" />
                    </div>
                    <div class="flex-auto">
                        <h1 class="uppercase text-2xl font-semibold">Kelas Brevet ab/c</h1>
                        <p class="text-grey_text text-justify mt-4 text-lg">
                            Kelas Brevet Pajak AB dan Brevet C di IC Education Center yang berlokasi di GP Plaza lt.
                            Dasar R3 Jl. Gelora II No.01 Gelora Jakarta Pusat (Seberang halte Busway Slipi Petamburan)
                        </p>
                    </div>
                </div>

                <div class="flex space-x-5">
                    <div class="flex-none w-14">
                        <img src="{{ asset('/images/ic-satu.png')}}" alt="" />
                    </div>
                    <div class="flex-auto">
                        <h1 class="uppercase text-2xl font-semibold">In House Training</h1>
                        <p class="text-grey_text text-justify mt-4 text-lg">Inhouse Training perpajakan seperti di Bank
                            Nagari, Padang</p>
                    </div>
                </div>

                <div class="flex space-x-5">
                    <div class="flex-none w-14">
                        <img src="{{ asset('/images/ic-satu.png')}}" alt="" />
                    </div>
                    <div class="flex-auto">
                        <h1 class="uppercase text-2xl font-semibold">fgd</h1>
                        <p class="text-grey_text text-justify mt-4 text-lg">FGD terkait usulan peraturan perpajakan dan
                            peraturan lainnya, Dan beberapa pelatihan lainnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 self-center opacity-0" id="imageRight">
            <img src="{{ asset('/images/right-image.png')}}" alt="" />
        </div>
    </div>
</div>
<!-- section selesai -->

<!-- npsn section start -->
<div class="container mx-auto p-10">
    <div class="flex flex-col justify-center space-y-8">
        <div class="text-center">
            <div class="w-2/3 inline-block">
                <h1 class="uppercase text-2xl font-semibold text-red">nomor pokok sekolah nasional</h1>
                <h1 class="uppercase text-lg font-semibold mt-10">sertifikat npsn ic education</h1>
                <p>Berdasarkan Surat Keputusan Kepala Badan Penelitian dan Pengembangan Kementerian Pendidikan dan
                    Kebudayaan Republik Indonesia <span class="font-semibold">Nomor. 3574/G4/KL/2009 Tahun 2009</span>
                </p>
            </div>
        </div>
        <div class="text-center">
            <img src="{{ asset('/images/npsn-icedu.png')}}" alt="" class="w-2/4 inline-block" />
        </div>
    </div>
</div>
<!-- npsn section selesai -->

<!-- gallery start -->
<div class="bg-pink pt-10" id="galeri">
    <div class="container mx-auto p-10">
        <h1 class="text-2xl uppercase font-semibold text-center text-red">Galeri</h1>
        <p class="text-lg text-center font-semibold mt-10">Dokumentasi Kegiatan IC Education Dengan Beberapa Kampus dan
            Peserta</p>
        <div class="flex flex-wrap py-10 px-4">
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

<!-- produk start -->
<div class="container mx-auto px-10 pt-20 pb-10" id="produk">
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
</div>
<!-- produk selesai -->
@endsection]