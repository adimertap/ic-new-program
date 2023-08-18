@extends('home.app')

@section('title')
Seminar |
@endsection

@section('content')
<div style="background-color: #f3f3f3!important">

    <!-- banner start -->
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
                            <img src="{{asset('images/new/seminar.png')}}" class="img-fluid-kelas" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="agenda">
        <div class="bg-gray">
            <div class="container-agenda" style="padding: 70px 150px 70px 200px" id="agenda">
                <div class="row">
                    <div class="col-3" style="margin-top: 150px">
                        <h5 class="sub-title" style="line-height: 25px">Kelas</h5>

                        <div class="flex justify-left">
                            <h1 class="judulfix" style="line-height: 35px">Seminar<br>
                                Perpajakan<br>
                                Berkala</h1>
                        </div>
                        <div class="flex justify-start  mt-5 ">
                            <i class="fa-solid fa-arrow-down me-4 mt-1 text-muted"></i>
                            <p class="text-muted small">Scroll bawah untuk <br> melihat kelas</p>

                        </div>

                    </div>
                    <div class="col-9">
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Bagaimana Seminar Perpajakan pada IC Education?</h5>
                                    <p class="sub-judul text-justify"
                                        style="line-height: 30px; font-size:16px !important">
                                      {{ $header->description_2 ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="kelas-seminar">
        <div class="container" style="margin-top: 120px">
            <div class="judul-atas text-center">
                <h5 class="sub-title">Product Kelas Kami</h5>
                <h1 class="judulfix mt-0" style="font-size: 30px">SEMINAR PERPAJAKAN</h1>
            </div>
            <div class="filter">
                <div class="wadah text-center">
                    <div class="card p-2">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-filter btn-sm active">Semua</button>
                            <button class="btn btn-primary btn-filter btn-sm">Online</button>
                            <button class="btn btn-primary btn-filter btn-sm">Offline</button>

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
                        <img src="{{ asset('images/produk/katalog.png') }}" alt="cover" width="300" height="230">
                        <div class="product-detail pt-3">
                            <div class="stars">
                                @if ($item->online == 1)
                                <span class="badge badge-online mr-2">Online</span>
                                @else
                                <span class="badge badge-danger mr-2">Offline</span>
                                @endif
                                <img src="{{ asset('images/new/star.png') }}" height="40" width="85" alt="">
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
                                <p class="text-danger small ms-2">{{ $item->note }}</p>
                            <div class="text-center">

                                <p class="animate-pulse">Rp. {{ convert_to_rupiah($item->harga)}}</p>
                            </div>
                            <div class="beli">
                                <a href="{{ route('checkout.edit', $item->slug) }}" type="button" class="btn btn-primary" style="border-radius: 10px!important" value="{{ $item->id }}"
                                    id="button-beli" data-slug="{{ $item->slug }}">
                                    Beli Sekarang
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
            <div class="container-agenda" style="padding: 70px 150px 70px 200px" id="agenda">
                <div class="row">
                    <div class="col-3 mt-5">
                        <div class="flex justify-left">
                            <h1 class="judulfixfaq mt-3">FAQ</h1>
                        </div>
                        <h5 class="sub-title" style="line-height: 25px">Pertanyaan yang <br>sering diajukan</h5>

                    </div>
                    <div class="col-9">
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Topik Apa Saja Yang Biasanya Dibahas Dalam Seminar Perpajakan?
                                    </h5>
                                    <p class="sub-judul-faq text-justify">Seminar Pajak diselenggarakan sesuai dengan
                                        kebutuhan terkini dengan topik yang hangat sesuai permintaan pasar dibulan dan
                                        tahun bersangkutan. Adapun topik-topik umum yang dibuat untuk seminar sebagai
                                        berikut
                                        <br><br>
                                        - FAKTUR PAJAK DAN PERMASALAHANNYA <br>
                                        - PERENCANAAN PAJAK KHUSUS PPN <br>
                                        - PPN ATAS EKSPOR DAN IMPOR BARANG DAN JASA DI LUAR DAERAH PABEAN <br>
                                        - AKUNTANSI PERPAJAKAN DAN JURNAL-JURNALNYA <br>
                                        - AKUNTANSI PERPAJAKAN DAN PSAK 46 <br>
                                        - PAJAK PENGHASILAN FINAL <br>
                                        - PAJAK PENGHASILAN BONUS THR DAN PESANGON CHAPTER 1 DAN CHAPTER 2 <br>
                                        - PAJAK PENGHASILAN KARYAWAN BEKERJA ATAU BERHENTI DI TENGAH TAHUN <br>
                                        - PAJAK PENGHASILAN PEGAWAI TIDAK TETAP, HARIAN, MINGGUAN, DAN BULANAN <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Siapa Peserta Yang Dapat Mengikuti Seminar Perpajakan?</h5>
                                    <p class="sub-judul-faq text-justify">Peserta yang menjadi target dalam seminar
                                        perpajakan ini adalah masyarakat umum, karyawan bagian akuntansi dan perpajakan
                                        serta mahasiswa yang menginginkan update dan pemahaman perpajakan yang lebih
                                        dalam dan detail disertai dengan praktek dan konsultasi dengan pembicara.</p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Siapa Pembicara atau Fasilitatornya?</h5>
                                    <p class="sub-judul-faq text-justify">
                                        Pembicara di seminar IC Education diisi oleh ahli-ahli perpajakan dari berbagai
                                        kalangan, antara lain
                                        <br>
                                        - PRAKTISI DARI DJP (DIREKTORAT JENDERAL PAJAK) SEBAGAI REGULATOR PERPAJAKAN DI
                                        INDONESIA<br>
                                        - PRAKTISI PERPAJAKAN DARI KAMPUS - KAMPUS TERNAMA<br>
                                        - KONSULTAN PAJAK YANG MEMEGANG IZIN/LISENSI RESMI SEBAGAI ANGGOTA IKPI ( IKATAN
                                        KONSULTAN PAJAK INDONEISA )<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Apa Saja Fasilitas Yang Didapatkan Peserta?
                                    </h5>
                                    <p class="sub-judul-faq text-justify">
                                        Seminar berkala dalam perencanaan programnya akan diselenggarakan dengan dua
                                        pilihan, yaitu di hotel dan di premis lokasi mandiri di Jakarta, sehingga
                                        fasilitasnya disesuaikan dengan lokasi kegiatan. Saat ini Masyarakat banyak
                                        melakukan kegiatan dengan sistem ONLINE, belajar atau mengikuti seminar pun
                                        dilakukan dengan ONLINE yang hanya dengan perangkat Laptop dan koneksi internet
                                        yang cukup peserta seminar sudah bisa mengikuti. Seminar Pajak Online dilakukan
                                        secara live menggunakan aplikasi ZOOM. Setelah mengikuti Seminar Pajak Online
                                        peserta akan mendapatkan E-SERTIFIKAT jika sudah mengikuti syarat yang
                                        ditentukan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-item-faq">
                            <div class="d-flex justify-content-start">
                                <i class="fa-solid fa-chevron-right chevron-icon me-4"></i>
                                <div class="item">
                                    <h5 class="judul">Apa Keunggulan Seminar Perpajakan Yang Diselenggarakan Oleh
                                        IC-Education?</h5>
                                    <p class="sub-judul-faq text-justify">
                                        Pelatihan/seminar perpajakan di IC Education lebih mengutamakan solusi
                                        permasalahan yang dihadapi oleh wajib pajak di lapangan, tidak sekedar
                                        menyampaikan materi yang bersifat teori semata tapi lebih mengedepankan praktek
                                        di lapangan.
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
