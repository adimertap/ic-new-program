@extends('user.layouts.user-app')

@section('content')

<main class="col ms-sm-auto px-md-4 header_content mb-5 pb-5">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <div class="container-fluid content"  style="padding-bottom: 100px">
            <h3 class="ketentuan-judul">Ketentuan Ujian</h3>

            <div class="materi-row px-4">
                {{-- <h5 class="materi-temp">Materi dan Soal Tentang {{ $materi->description }}</h5> --}}
                <div class="materi-row">
                    <h5 class="materi-temp">Materi dan Soal Tentang {{ $materi->description }}</h5>
                    <p class="jam-temp text-primary">Waktu Pengerjaan: 1 Jam (60 Menit)</p>
                </div>
            </div>
            <hr>
            <div class="ketentuan-temp">

                    <section class="tata-tertib mt-3">
                        <i>Tata Tertib Ujian Online IC EDUCATION</i>
                        <ul class="mt-2">
                            <li>Sudah melakukan Pembayaran <b>angsuran
                                    kedua</b> </li>
                            <li>Jadwal ujian sesuai jadwal yang sudah
                                dibagikan</li>
                            <li>Waktu: <b>60 menit</b> setiap materi ujian
                            </li>
                            <li> Pastikan peserta ujian sudah melihat
                                video tutorial ujian sebelum mulai mengerjakan soal ujian online</li>
                            <li>Jika menemukan kendala terkait teknis
                                ujian (ada masalah sistem pada saat proses ujian dsb) kontak segera
                                admin dan halaman eror di capture dikirimkan ke admin</li>
                            <li>Ujian disarankan menggunakan laptop dengan
                                koneksi internet yang cukup (ukurannya jika koneksi dipakai
                                youtube tidak</li>
                            <li>Peserta tidak lulus ujian atau <b>nilai <
                                        60 </b>bisa mengikuti ujian ulang dengan batas waktu yang akan ditentukan tim
                                        ujian</li> <li>Biaya Ujian Ulang
                                        atau perbaikan nilai Rp 50.000 setiap materi</li>
                        </ul>
                    </section>


                    <section class="tata-tertib mt-3">
                        <i>Panduan Ujian Online IC EDUCATION</i>
                        <ul class="mt-2">
                            <li>Passing grade (lulus jika nilai minimal
                                60)</li>
                            <li>Soal akan terkumpul dengan sendirinya jika
                                waktu telah habis</li>
                            <li> Ujian open book tidak boleh kerjasama
                            </li>
                            <li> Memastikan internet berjalan dengan baik,
                                ketersediaan kuota dan laptop dalam kondisi baik</li>
                            <li>Saat mengerjakan soal dengan status belum
                                selesai mengerjakan tidak diperkenankan kembali ke halaman kelas ujian atau materi ujian
                            </li>
                        </ul>
                    </section>

            </div>
            <div class="text-center mt-5 pt-3">
                <a href="{{ route('soal',['id'=>$materi['id'],'slug'=>$slug]) }}" class="btn btn-primary" style="padding-left: 50px; padding-right:50px" >Mulai Ujian</a>
            </div>
        </div>
    </div>
</main>


@endsection

@push('addon-style')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>
@endpush

@push('addon-script')

@endpush
