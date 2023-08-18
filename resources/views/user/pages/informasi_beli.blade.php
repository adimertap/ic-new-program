@extends('layouts.user')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
      class="
        d-flex
        justify-content-between
        flex-wrap flex-md-nowrap
        align-items-center
        pt-3
        pb-2
        mt-3
        mb-3
      "
    >
      <div class="container-fluid content">
        <div class="path_file">
          <h4>Katalog Kelas</h4>
          <p>Home > Katalog Kelas</p>
        </div>
        <div class="form_beli brevet">
          <h5>Form Pemesanan</h5>
          <div class="row justify-content-around info_beli">
            <div class="col-lg-12">
              <div class="row">
                <div class="col">
                  <h6>Nama Lengkap</h6>
                </div>
                <div class="col">
                  <p>Muhammad</p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h6>Status Tagihan</h6>
                </div>
                <div class="col" style="background-color: #ffa800">
                  <p>Menunggu Pembayaran</p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h6>Batas Pembayaran</h6>
                </div>
                <div class="col">
                  <p>10:46 PM</p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h6>Metode Pembayaran</h6>
                </div>
                <div class="col">
                  <p>BNI</p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h6>Kode Pembayaran</h6>
                </div>
                <div class="col">
                  <p>98823012379438</p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h6>Jumlah Pembayaran</h6>
                </div>
                <div class="col">
                  <p>2,250,000.00</p>
                </div>
              </div>
            </div>
          </div>
          <button
            class="btn btn-danger"
            style="margin-top: 40px; right: 0"
          >
            Upload Bukti Pembayaran
          </button>
        </div>
      </div>
    </div>
  </main>

@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ url('user_dashboard/frontend/styles/menu-html.css')}}" />
@endpush
