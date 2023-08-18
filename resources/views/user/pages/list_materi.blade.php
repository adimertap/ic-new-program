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

          <!-- website version -->
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
            @elseif ($materi->keranjang[0]['payment_status'] == 'Cicilan' || $materi->keranjang[0]['payment_status'] ==
            'Paid')
            <div class="col-lg-2">
              <div class="text-center d-block bg-warning rounded ">
                <a href="{{ route('soal',['id'=>$materi['id'],'slug'=>$slug]) }}" class="btn text-white">Ujian Ulang</a>
              </div>
            </div>
            @endif

            @else
            <div class="col-lg-2">
              <div
                class="text-center d-block rounded {{ $materi->peserta->lulus == 'Lulus' ? 'bg-success' : 'bg-danger'}}">
                <button type="button" class="btn" onclick="ulangFunction({{ $materi->id }})"
                  data-slug="{{ $materi->slug }}" {{ isset($cekUjian) && $cekUjian->payment_status == 'Pending' ||
                  isset($cekUjian) && $cekUjian->used == null ? 'disabled' : '' }}>
                  <span class="text-white">Ambil Lagi (<strong> {{ $materi->peserta->nilai_abjad }} </strong>)</span>
                </button>
                <form id="ulang-form-{{ $materi->id }}" action="{{ route('kelas-ujian-ulang') }}" method="POST"
                  style="display: none">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi->id }}">
                </form>
              </div>
            </div>

            @endif

            @else
            <div class="col-lg-2">
              <div class="text-center d-block bg-primary rounded">
                <a href="{{ route('rules', ['id'=>$materi['id'],'slug'=>$slug]) }}" class="btn text-white">Kerjakan
                  Ujian</a>
              </div>
            </div>
            @endif

          </div>

          @endforeach

        @else
        <div class="row container mt-2 d-md-flex justify-content-center">
          <h3 class="text-danger">{{ $reqSertif == 1 ? 'Terima kasih telah mengikuti ujian online' : 'Belum Waktunya
            Ujian' }}</h3>
        </div>
        @endif
      </div>
    </div>
  </div>
</main>

@endsection

@push('addon-script')
<script>
  function ulangFunction(materi_id) {
        $('#materi_id').val(materi_id)
        Swal.fire({
            title: 'Ulangi Ujian',
            text: "Ulang Ujian akan dikenakan biaya Rp. 50.000, Apakah Anda bersedia?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Bersedia!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById(`ulang-form-${materi_id}`).submit()
            }
        })
    }
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