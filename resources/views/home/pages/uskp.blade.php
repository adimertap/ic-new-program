@extends('home.app')

@section('title')
{{ $meta->title ?? '' }}
@endsection

@section('content')
<div style="background-color: #f3f3f3!important">

    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12 copywriting">
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
                            <img src="{{asset('/images/new/uskp.png')}}" class="img-fluid-kelas" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="kelas-uskp">
        <div class="container" style="margin-top: 120px">
            <div class="judul-atas text-center">
                <h5 class="sub-title">Product Kelas Kami</h5>
                <h1 class="judulfix mt-0" style="font-size: 30px">KELAS USKP REVIEW</h1>
            </div>
            <div class="filter">
                <div class="wadah text-center">
                    <div class="card p-2">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-filter btn-sm" value="semua">Semua</button>
                            <button class="btn btn-primary btn-filter btn-sm" value="online">Online</button>
                            <button class="btn btn-primary btn-filter btn-sm" value="offline">Offline</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="products" id="kelas">
            <div class="products-column">
                <div class="products-wrap">
                    @foreach ($produk as $item)
                    <div class="product-card">
                        <img src="{{ asset('/images/produk/katalog.png') }}" alt="cover" width="300" height="230">
                        <div class="product-detail pt-3">
                            <div class="stars">
                                @if ($item->online == 1)
                                <span class="badge badge-online mr-2">Online</span>
                                @else
                                <span class="badge badge-danger mr-2">Offline</span>
                                @endif
                                <img src="{{ asset('/images/new/star.png') }}" height="40" width="85" alt="">
                            </div>
                            <p class="title-detail mt-4 uppercase">{{ $item->nama_produk }} {{ $item->kelas }}</p>
                            <div class="time">
                                <i class="fa-regular fa-calendar-check"></i>
                                <p class="uppercase">{{ tgl_indo2($item->tgl_mulai) }} -
                                    {{ tgl_indo2($item->tgl_selesai) }}
                                </p>
                            </div>
                            <div class="time">
                                <i class="fa-solid fa-clock" style="color: gray"></i>
                                <p>{{date('H:i',strtotime($item->jam_mulai))}} -
                                    {{ date('H:i', strtotime($item->jam_selesai))}}
                                    WIB</p>
                            </div>
                            <p class="small text-danger ms-2">{{ $item->note }}</p>
                            <div class="text-center">
                                <p class="animate-pulse">Rp. {{ convert_to_rupiah($item->harga)}}</p>
                            </div>
                            <div class="beli">
                                <a href="{{ route('register-data', $item->slug) }}" type="button" class="btns btn-icon" style="border-radius: 10px!important" value="{{ $item->id }}"
                                    id="button-beli" data-slug="{{ $item->slug }}">
                                </a>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="btn-see-more text-center mb-5">
            <button class="btn btn-sm btn-light" type="button">Lihat Lebih Banyak</button>
        </div>
    </section>


    <section class="agenda">
        <div class="bg-gray">
            <div class="faq-padding" id="agenda">
                <div class="faq-grids">
                    <div class="faq-item">
                            <h1 class="judulfixfaq mt-3">FAQ</h1>
                        <h5 class="sub-title" style="line-height: 25px">Pertanyaan yang <br>sering diajukan</h5>

                    </div>
                    <div class="faq-item">
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Apa saja Fasilitas Brevet Pajak Tatap Muka?</h5>
                                    <p class="sub-judul-faq text-justify">Modul Brevet A-B, Sertifikat Pelatihan, Snack,
                                        Air Mineral, Coffee Break, Free Training E-SPT PPN dan E-SPT PPH, Fotocopy
                                        Formulir SPT dan Latihan Soal, Training Kit, Sertifikat Brevet AB dan Sertifikat
                                        E-SPT</p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Apa saja Fasilitas Brevet Pajak Online di Masa Pandemi?</h5>
                                    <p class="sub-judul-faq text-justify">Modul Brevet A-B Akan Dikirim Ke Alamat Masing
                                        - Masing Peserta
                                        Formuli Spt Dan Latihan Soal Via Email ( Softcopy )
                                        Free Training E-Spt Ppn Dan E-Spt Pph
                                        Slide Pemateri Via Email ( Softcopy )
                                        Sertifikat Brever AB</p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Siapa Saja Peserta yang dapat Mengikuti Kelas Brevet?</h5>
                                    <p class="sub-judul-faq text-justify">
                                        Staf Perpajakan / Keuangan,
                                        Praktisi Akuntansi / Auditor,
                                        Mahasiswa, Dosen,
                                        Fresh Graduate,
                                        Pengusahan Investor,
                                        Masyarakat Umum
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Siapa saja Pemateri di Seminar Perpajakan yang diadakan
                                        IC-Education?</h5>
                                    <p class="sub-judul-faq text-justify">
                                        Praktisi Dari DJP (Direktorat Jenderal Pajak) Sebagai Regulator Perpajakan Di
                                        Indonesia
                                        Praktisi Perpajakan Dari Kampus - Kampus Ternama
                                        Konsultan Pajak Yang Memegang Izin/Lisensi Resmi Sebagai Anggota IKPI ( Ikatan
                                        Konsultan Pajak Indoneisa )
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Apa saja Materi yang diajarkan pada Kelas Brevet Pajak di
                                        IC-Education?</h5>
                                    <p class="sub-judul-faq text-justify">
                                        - KUP A<br>
                                        - PPH ORANG PRIBADI<br>
                                        - SPT PPH ORANG PRIBADI 1770 SS, 1770 S, 1770<br>
                                        - PBB, BPHTB, BEA MATERAI<br>
                                        - PPH PASAL 21<br>
                                        - SPT MASA PPH PASAL 21 DAN 1721 A1<br>
                                        - PPH PEMOTONGAN PEMUNGUTAN PASAL 22, 23, 4(2), 15, 26<br>
                                        - PPN DAN PPNBM<br>
                                        - SPT MASA PPN DAN PPNBM 1111<br>
                                        - AKUNTANSI PERPAJAKAN<br>
                                        - PPH BADAN<br>
                                        - SPT PPH BADAN 1771<br>
                                        - KUP B<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Apa Keunggulan Kelas Brevet Pajak di IC-Education dengan Tempat
                                        Lain?</h5>
                                    <p class="sub-judul-faq text-justify">
                                        Modul Pelatihan Selalu Up-To-Date,
                                        Tim Instruktur Dari Prkatisi Yang Terpilih,
                                        Pendekatan Materi Lebih Praktis,
                                        Biaya Include Ujian Dan Sertifikat,
                                        Biaya Include Pelatihan E-Spt,
                                        Sertifikat Brevet Dan E-Spt Terpisah,
                                        Free Wifi,
                                        Open Untuk Internship Untuk Peserta Fresh Graduate
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('js')
<script>
     $(document).ready(function() {
        $('.btn-filter').on('click', function() {
            $('.btn-filter').removeClass('active'); // Remove 'active' class from all buttons
            $(this).addClass('active'); // Add 'active' class to the clicked button

            var jenis = $(this).val();
            var url = '/produk/uskp-review';
            if (jenis !== 'semua') {
                url += '?jenis=' + jenis;
            }
            window.location.href = url;
        });
    })
    var chevronIcons = document.getElementsByClassName("chevron-icon");

    for (var i = 0; i < chevronIcons.length; i++) {
        chevronIcons[i].addEventListener("click", function () {
            var subJudul = this.parentNode.parentNode.querySelector(".sub-judul-faq");
            var chevronIcon = this;

            subJudul.classList.toggle("show");
            chevronIcon.classList.toggle("fa-chevron-down");
            chevronIcon.classList.toggle("fa-chevron-right");
        });
    }

    var judulElements = document.getElementsByClassName("judul");

    for (var i = 0; i < judulElements.length; i++) {
        judulElements[i].style.cursor = "pointer";
        judulElements[i].addEventListener("click", function () {
            var subJudul = this.nextElementSibling;
            var chevronIcon = this.parentElement.parentElement.querySelector(".chevron-icon");

            subJudul.classList.toggle("show");
            chevronIcon.classList.toggle("fa-chevron-down");
            chevronIcon.classList.toggle("fa-chevron-right");
        });
    }
    const username = "{{ auth()->user()->username ?? 'null' }}"

    const buttonBeli = document.querySelectorAll('#button-beli')
    buttonBeli.forEach((element, index) => {
        element.addEventListener('click', (event) => {
            const slug = buttonBeli[index].getAttribute('data-slug')
            let urlRegister = "{{ route('register', ':slug' )}}"
            let urlLogin = "{{ route('login', ':slug' )}}"
            urlLogin = urlLogin.replace(':slug', slug)
            urlRegister = urlRegister.replace(':slug', slug)

            if (username == 'null') {
                window.location.href = urlRegister
            } else {
                window.location.href = urlLogin
            }
        })
    });

</script>
@endpush
