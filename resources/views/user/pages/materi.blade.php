@extends('layouts.user')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 header_content">
    <div
      class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-3"
    >
      <div class="container-fluid content">
        <div class="path_file">
          <div class="row justify-content-between" style="color: white">
            <div class="col-5">
              <h4>Selasa dan Kamis</h4>
              <p>
                25 Mei 2021 - 26 Agt 2021 <br />
                18.00 - 21.00 <br />
                Brevet AB <br />
              </p>
            </div>
            <div class="col-5">
              <h4>
                Pembahasan <br />
                Materi dan Soal Tentang KUP
              </h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="modul_materi">
            <h5>Modul Materi akan ditampilkan disini</h5>
          </div>
          <div class="d-flex flex-wrap justify-content-lg-between mt-3">
            <button class="btn btn-danger" style="width: 40%">
              Sebelumnya
            </button>
            <button class="btn btn-success" style="width: 40%">
              Selanjutnya
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ url('user_dashboard/frontend/styles/menu-html.css')}}" />
@endpush
