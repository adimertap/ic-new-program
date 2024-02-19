@extends('user.layouts.user-app')

@section('title')
Kumpulan Materi
@endsection

@section('content')

<main class="col ms-sm-auto px-md-4 header_content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-3 mb-3">
        <div class="container-fluid">
            <div class="path_file" style="margin-bottom: 30px">
                <h4>Kelas Ujian</h4>
                <h6>Materi Ujian Kelas Brevet AB/C</h6>
            </div>

            @if ($keterangan != "")
            <div class="alert alert-danger text-center" role="alert">
                <strong>{{ $keterangan }}</strong>
            </div>
            @endif

            <div class="brevet">

                @if ($materi != null && $reqSertif != 1)
                @foreach ($materi as $key => $materi )
                <div class="row container mt-2 d-md-flex text-center">
                    <div class="bg-circle col-lg-10 bg-white">
                        <h5 class="mt-2">{{ $materi['description'] }}</h5>
                    </div>
                    @if (isset($materi->peserta) && $materi->peserta->slug_product == $kelas)
                        @if (count($materi->keranjang) && $materi->keranjang[0]->used != 'used')
                            @if ($materi->keranjang[0]['payment_status'] == 'Pending')
                                <div class="col-lg-2">
                                    <div class="text-center d-block bg-warning rounded">
                                        <button class="btn" disabled>
                                            <span class="text-white">Menunggu Konfirmasi</span>
                                        </button>
                                    </div>
                                </div>
                            @elseif ($materi->keranjang[0]['payment_status'] == 'Cicilan' ||
                                    $materi->keranjang[0]['payment_status'] == 'Paid')
                                    <div class="col-lg-2">
                                        <div class="text-center d-block bg-warning rounded ">
                                            <a href="{{ route('soal',['id'=>$materi['id'],'slug'=>$slug]) }}"
                                                class="btn text-white">Ujian Ulang</a>
                                        </div>
                                    </div>
                            @endif
                        @else
                        <div class="col-lg-2">
                            <div
                                class="text-center d-block rounded {{ $materi->peserta->lulus == 'Lulus' ? 'bg-success' : 'bg-danger'}}">
                                <button type="button" class="btn ulangFunction" value="{{ $materi->id }}"
                                    data-slug="{{ $materi->slug }}" {{ isset($cekUjian) && $cekUjian->payment_status ==
                                    'Pending' || isset($cekUjian) && $cekUjian->used == null ? 'disabled' : '' }}>
                                    <span class="text-white">Ambil Lagi (<strong> {{ $materi->peserta->nilai_abjad }}
                                        </strong>)</span>
                                </button>
                            </div>
                        </div>
                        @endif
                    @else
                    <div class="col-lg-2">
                        <div class="text-center d-block bg-primary rounded">
                            <a href="{{ route('rules', ['id'=>$materi['id'],'slug'=>$slug]) }}"
                                class="btn text-white">Kerjakan
                                Ujian</a>
                        </div>
                    </div>
                    @endif

                </div>

                @endforeach

                @else
                <div class="row container mt-2 d-md-flex justify-content-center">
                    <h3 class="text-danger">{{ $reqSertif == 1 ? 'Terima kasih telah mengikuti ujian online' : 'Belum
                        Waktunya Ujian' }}</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Ujian Ulang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kelas-ujian-ulang') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="materi_id" id="materi_id" value="">
                    <p class="small text-muted">Pilih Tipe Pembayaran</p>
                    <p>Ulang Ujian akan dikenakan biaya Rp. 50.000, <br> Pilih metode pembayaran dibawah</p>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type_radio" value="Manual"
                                    checked>
                                <label class="form-check-label" for="type_radio">
                                    Manual
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type_radio"
                                    value="Otomatis" disabled>
                                <label class="form-check-label" for="type_radio">
                                    Otomatis
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Bayar</button>

                </div>
            </form>

        </div>
    </div>
</div>


@endsection

@push('addon-script')
<script>
    $(document).ready(function () {
        $('.ulangFunction').click(function (e) {
            e.preventDefault();

            var id = $(this).val();
            $('#materi_id').val(id)
            $('#confirmModal').modal('show')
        })
    })
    // const username = "{{ auth()->user()->username ?? 'null' }}"

    // const buttonBeli = document.querySelectorAll('#btn-beli-ujian')
    // buttonBeli.forEach( (element, index) => {
    //     element.addEventListener('click', (event)=>{
    //         const slug = buttonBeli[index].getAttribute('data-slug')
    //         let urlRegister = "{{ route('register', ':slug' )}}"
    //         let urlLogin = "{{ route('login', ':slug' )}}"
    //         urlLogin = urlLogin.replace(':slug', slug)
    //         urlRegister = urlRegister.replace(':slug', slug)

    //         if (username == 'null') {
    //             window.location.href = urlRegister
    //         } else {
    //             window.location.href = urlLogin
    //         }
    //     })
    // });

</script>
@endpush