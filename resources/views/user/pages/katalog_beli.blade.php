@extends('layouts.user')

@section('title', 'Katalog Kelas')

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
          <div
            class="row justify-content-around"
            style="margin-top: 30px"
          >
            <div class="col tabel_pesan">
              <h6>Nama Lengkap</h6>
              <p>
                Nama lengkap yang benar dibutuhkan untuk sertifikat
                nantinya
              </p>
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>
              <h6>Nama Handphone / Whatsapp</h6>
              <p>
                Invoice, resi dan konfirmasi akun lainnya akan dikirim via
                WhatsApp
              </p>
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>
              <h6>Alamat Email</h6>
              <p>
                Harap isi alamat email dengan benar, sertifikat akan
                dikirim via email
              </p>
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="form_beli brevet">
          <h5>Form Pemesanan</h5>
          <div
            class="row justify-content-around"
            style="margin-top: 30px"
          >
            <div class="col-md-5 tabel_pesan">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BrevetAB-2505-1800</td>
                    <td>2,250,000.00</td>
                    <td>2,250,000.00</td>
                  </tr>
                  <tr></tr>
                  <tr>
                    <td colspan="2">Total</td>
                    <td>2,250,000.00</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{ route('katalog')}}">
                <button type="button" class="btn btn-success">
                    Beli Kelas Lain
                  </button>
              </a>
            </div>
            <div class="col-md-5 tabel_pesan">
              <div class="row m-auto">
                <div class="col">
                  <a href=""
                    ><img src="{{ url('user_dashboard/frontend/image/bri.svg')}}" alt=""
                  /></a>
                  <a href=""
                    ><img
                      src="{{ url('user_dashboard/frontend/image/bca.svg')}}"
                      alt=""
                      style="margin-top: 5px"
                  /></a>
                  <a href="{{ route('katalog')}}">
                    <button class="btn btn-danger" style="margin-top: 10px">
                        BATALKAN PEMBAYARAN
                      </button>
                  </a>
                </div>
                <div class="col">
                  <a href=""
                    ><img src="{{ url('user_dashboard/frontend/image/mandiri.svg')}}" alt=""
                  /></a>
                  <a href=""
                    >
                    <img
                      src="{{ url('user_dashboard/frontend/image/bni.svg')}}"
                      alt=""
                      style="margin-top: 5px"
                  /></a>
                  <a
                    href="{{ route('informasi')}}"
                    class="btn btn-success"
                    style="margin-top: 10px"
                  >
                    LANJUTKAN PEMBAYARAN
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ url('user_dashboard/frontend/styles/menu-html.css')}}" />
@endpush
