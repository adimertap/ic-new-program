<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Responsive Admin Dashboard Template">
  <meta name="keywords" content="admin,dashboard">
  <meta name="author" content="stacks">
  <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Title -->
  <title>Detail Transaksi</title>

  <!-- Styles -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
  <link href="{{ asset('/public/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/public/assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
  <link href="{{ asset('/public/assets/plugins/pace/pace.css') }}" rel="stylesheet">


  <!-- Theme Styles -->
  <link href="{{ asset('/public/assets/css/main.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/public/assets/css/custom.css') }}" rel="stylesheet">

  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/public/images/ic-bulet.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/public/images/ic-bulet.png') }}" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="background-signin">
  <div class="app align-content-stretch d-flex flex-wrap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card invoice">
            <div class="card-body">
              <div class="invoice-header" style="background-color: #b12027">
                <div class="row">
                  <div class="col-9">
                    <h3>Invoice</h3>
                  </div>
                </div>
              </div>
              <div class="row">
                <p class="invoice-description">{{ $keranjang->no_invoice }}</p>
              </div>
            </div>
            <div class="card-footer">
              <form action="{{ route('voucher-verif') }}" name="voucherForm" method="POST" class="form-horizontal">
                @csrf
                <div class="row invoice-summary">
                  <div class="col-lg-8">
                    <div class="invoice-info">
                      <p>Kelas/Materi <span>{{ $keranjang->produk->kelas }}</span></p>
                      <p>Harga <span>Rp {{ convert_to_rupiah( $keranjang->produk->harga ) }},-</span></p>
                      <p>Tanggal <span>{{ tgl_indo($keranjang->produk->tgl_mulai) }} - {{
                          tgl_indo($keranjang->produk->tgl_selesai) }}</span></p>
                      <p>Jam <span>{{ indo_time($keranjang->produk->jam_mulai) }} - {{
                          indo_time($keranjang->produk->jam_selesai) }}</span></p>
                      @if ($is_ujian == '0')
                      <p>Voucher Diskon
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="voucher" id="voucher">
                        <button class="btn btn-outline-success is_applied" type="button"
                          name="is_applied">Apply</button>
                      </div>
                      </p>
                      <p class="text-success" id="jumlahDiskon"></p>
                      <p hidden id="teksTotal">{{ $keranjang->produk->harga }}</p>
                      <p class="bold">Total <span id="hargaAkhir">Rp {{ convert_to_rupiah(
                          $keranjang->produk->harga) }}.-</span></p>
                      @else
                      <p hidden id="teksTotal">{{ $keranjang->produk->harga }}</p>
                      <p class="bold">Total <span id="hargaAkhir">Rp {{ convert_to_rupiah( $keranjang->produk->harga )
                          }}.-</span></p>
                      @endif
                    </div>
                  </div>
                  <div class="invoice-info">
                    <div class="invoice-info-actions justify-content-end">
                      <button type="submit" class="btn btn-primary" type="button">Checkout</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Javascripts -->
  <script src="{{ asset('/public/assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('/public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/public/assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/public/assets/plugins/pace/pace.min.js') }}"></script>
  <script src="{{ asset('/public/assets/js/main.min.js') }}"></script>
  <script src="{{ asset('/public/assets/js/custom.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(function() {
      $(".is_applied").click(function() {
        var kode = document.querySelector("#voucher").value
        var total = document.getElementById("teksTotal").innerHTML
        console.log(total)

        $.ajax({
          type: 'GET',
          dataType: 'json',
          cache: false,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('potong-harga') }}",
          data: {'kodeInput':kode, 'hargaAwal':total},
          success: function (response) {
            Swal.fire({
            icon: 'success',
            title: 'Kode voucher berhasil digunakan',
            showConfirmButton: false,
            timer: 1300
            })

            let diskon = `
            Selamat anda mendapatkan potongan sebesar Rp ${ response.hargaRupiah }.-
            `

            let hasil = `
            Rp ${ response.setelahPotong }.-
            `

            document.getElementById('jumlahDiskon').innerHTML = diskon
            document.getElementById('hargaAkhir').innerHTML = hasil

            console.log(`${response.setelahPotong}`)
            console.log(`${response.diskon.nilai}`)
          },
          error: function(response) {
            Swal.fire({
            icon: 'error',
            title: 'Kode voucher tidak ditemukan',
            showConfirmButton: false,
            timer: 1300
            })
          }
        })
      })
    })
  </script>
</body>

</html>