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