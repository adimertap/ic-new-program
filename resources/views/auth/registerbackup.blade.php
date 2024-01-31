<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Template Mo">
  <meta name="csrf-token" content="{{ csrf_token()}}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">

  <title>Registers | IC - Education</title>

  <!-- Modal Neptune CSS Files -->
  {{--
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  --}}
  {{--
  <link href="{{ asset('/public/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
  {{--
  <link href="{{ asset('/public/assets/plugins/perfectscroll/perfect-scrollbar.css')}}" rel="stylesheet"> --}}
  <link href="{{ asset('/public/assets/plugins/pace/pace.css')}}" rel="stylesheet">

  <link href="{{ asset('/public/assets/css/main.css')}}" rel="stylesheet">
  <link href="{{ asset('/public/assets/css/custom.css')}}" rel="stylesheet">

  <!-- Additional CSS Files -->

  <link rel="stylesheet" type="text/css" href="{{ asset('/public/landing_page/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap"
    rel="stylesheet" />
  {{-- theme --}}
  <link href="{{ asset('landing_page/assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{ asset('landing_page/assets/css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet" />
</head>

<body>

  <div id="preloader">
    <div data-loader="circle-side"></div>
  </div>

  <main>
    <div class="container" id="form_container">
      <div class="container text-center mb-4">
        <div class="row">
          <div class="col">
            <a href="{{ route('home-beranda')}}"><img src="{{ asset('/public/images/ic-edu-logo.png')}}" alt="" /></a>
          </div>
        </div>
      </div>
      <div class="row" style="background-color: white">
        <div class="col-lg-5" style="padding: 0">
          <div id="left_form">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/images/ic-bulet.png')}}" alt="" style="width: 30%" />
                  </figure>
                  <h2>Jasa - IC Consultant</h2>
                  <p>
                    Tax - Customs - Accounting - Audit - Legal - Appraisal -
                    Curator - CSR - Management
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/Tax.svg')}}" alt="" style="width: 30%" />
                  </figure>
                  <h2>Jasa Konsultan Pajak</h2>
                  <p>
                    Pajak adalah kontribusi wajib kepada negara yang terutang
                    oleh orang pribadi atau badan yang bersifat memaksa
                    berdasarkan Undang-Undang, dengan tidak mendapatkan
                    imbalan secara langsung dan digunakan untuk keperluan
                    negara bagi sebesarbesarnya kemakmuran rakyat.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/Secure Payment.svg')}}" alt=""
                      style="width: 30%" />
                  </figure>
                  <h2>Jasa Konsultan Bea Cukai</h2>
                  <p>
                    Bea Cukai merupakan suatu tindakan pungutan pemerintah
                    terhadap barang ekspor dan impor serta suatu barang yang
                    memiliki karakteristik khusus.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/registration_bg.svg')}}" alt=""
                      style="width: 30%" />
                  </figure>
                  <h2>Jasa Accounting / Pembukuan</h2>
                  <p>
                    Pembukuan adalah pencatatan transaksi keuangan. Transaksi
                    meliputi penjualan, pembelian, pendapatan, dan pengeluaran
                    oleh perseorangan maupun organisasi.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/Calculator.svg')}}" alt=""
                      style="width: 30%" />
                  </figure>
                  <h2>Jasa Audit</h2>
                  <p>
                    Audit merupakan pengumpulan dan pemeriksaan bukti terkait
                    informasi untuk menentukan dan membuat laporan mengenai
                    tingkat kesesuaian antara informasi dan kriteria yang
                    ditetapkan. Audit harus dilakukan oleh seseorang yang
                    kompeten dan independen.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/Law Book.svg')}}" alt="" width="30%" />
                  </figure>
                  <h2>Jasa Konsultan Hukum</h2>
                  <p>
                    Hukum adalah hukum/ peraturan atau adat yang secara resmi
                    dianggap mengikat, yang dikukuhkan oleh penguasa atau
                    pemerintah.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/Male Lawyer.svg')}}" alt="" width="30%" />
                  </figure>
                  <h2>Jasa Konsultan Manajemen</h2>
                  <p>
                    Definisi manajemen adalah ini: dari kata "Manage".
                    Artinya: mengelola/mengurus, mengendalikan, mengusahakan
                    dan juga memimpin.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/CSR.svg')}}" alt="" width="30%" />
                  </figure>
                  <h2>Jasa Konsultan CSR dan Sustainability</h2>
                  <p>
                    Definisi manajemen adalah ini: dari kata "Manage".
                    Artinya: mengelola/mengurus, mengendalikan, mengusahakan
                    dan juga memimpin.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                  <figure>
                    <img src="{{ asset('/public/landing_page/assets/images/register/Report.svg')}}" alt="" width="30%" />
                  </figure>
                  <h2>Jasa Konsultan Property dan Bisnis</h2>
                  <p>
                    Definisi manajemen adalah ini: dari kata "Manage".
                    Artinya: mengelola/mengurus, mengendalikan, mengusahakan
                    dan juga memimpin.
                  </p>
                  <a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div id="wizard_container">
            <div id="top-wizard">
              @if(Session::has('alert-success'))
              <div class="alert alert-success">
                <small>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</small>
              </div>
              @endif
            </div>
            <!-- /top-wizard -->
            <form action="{{ route('register-auth')}}" name="example-1" id="wrapped" method="POST"
              enctype="multipart/form-data">
              @csrf
              <input id="website" name="website" type="text" value="" />
              <input type="hidden" name="tgl_mulai">
              <!-- Leave for security protection, read docs for details -->
              <div id="middle-wizard">
                <div class="step">
                  <h3 class="main_question">
                    <strong>1/2</strong>Masukkan Identitas Anda
                  </h3>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="text" name="nama" class="form-control required" placeholder="Nama Lengkap" />
                      </div>
                    </div>
                  </div>
                  <!-- /row -->

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="nomor_indo">+62</span>
                          </div>
                          <input type="text" name="no_hp" id="no_hp" class="form-control required"
                            placeholder=" Masukan nomor handphone valid" onblur="mobilevalid(this);" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /row -->

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="text" name="pekerjaan" class="form-control required" placeholder="Pekerjaan" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p class="float-left">sudah punya akun ? <a
                          href="{{ route('login', ['slug' => request()->segment(2)])}}"
                          style="font-size:22px;font-weight:bold;">Login</a></p>
                    </div>
                  </div>
                  {{-- row --}}
                </div>

                <!-- /step-->

                <div class="submit step">
                  <h3 class="main_question">
                    <strong>2/2</strong>Masukkan Informasi Tambahan Anda
                  </h3>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="email" name="email" class="form-control required" placeholder="Email"
                          onblur="emailvalid(this);" />
                      </div>
                      <div class="form-group">
                        <select name="kerjasama" class="form-control">
                          <option value="">ASAL INSTANSI/LEMBAGA</option>
                          @foreach ($instansi as $row => $lembaga)
                          <option value="{{ $row }}">{{ $lembaga->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- /col-sm-12 -->
                  </div>
                  <!-- /row -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="password" name="password" class="form-control required"
                          placeholder="Masukkan Password Anda" onkeyup="CheckpasswordStrength(this);" />
                        <span class="help-block password"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="password" name="password2" class="form-control required"
                          placeholder="Ulangi Password Anda" onblur="match_password(this)" />
                        <span class="help-block password2"></span>
                      </div>
                    </div>
                  </div>
                  <!-- /row -->
                  @if (request()->segment(2) == null)

                  {{-- <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="styled-select">
                          <select class="" name="nama_produk">
                            <option value="" selected>Pilih Produk</option>
                            <option value="brevet-ab">BREVET AB</option>
                            <option value="seminar">SEMINAR</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="styled-select">
                          <select class="" name="slug">
                            <option value="" selected>
                              Pilihan Hari / Judul
                            </option>
                            @foreach($produk as $item)
                            <option data-id="{{ $item->nama_produk }}" value="{{ $item->slug }}" style="display: none;">
                              {{str_replace('-', ' ', strtoupper($item->nama_produk)).' - '.$item->kelas.' -
                              '.$item->tgl_mulai }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div> --}}

                  @else
                  <input type="hidden" name="slug" value="{{ request()->segment(2) }}">
                  @endif
                  <!-- /row -->
                </div>
              </div>
              <!-- /middle-wizard -->
              <div id="bottom-wizard">
                <button type="button" name="backward" class="backward">
                  Backward
                </button>
                <button type="button" name="forward" class="forward">
                  Forward
                </button>
                <button type="submit" class="submit" id="js-contact-btn">
                  Submit
                </button>
                {{-- <button type="button" class="submit" id="js-contact-btn" data-bs-toggle="modal"
                  data-bs-target="#LihatInvoice">
                  Submit
                </button> --}}
              </div>
              @include('auth.includes.modal_detail_transaksi')
              <!-- /bottom-wizard -->
            </form>
          </div>
          <!-- /Wizard container -->
        </div>
      </div>
      <!-- /Row -->
    </div>
    <!-- /Form_container -->
  </main>

  <footer class="mt-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-12 col-sm-12">
          <p class="copyright">Copyright &copy;<span class="copyright-year"></span> PT. INDONESIA CONSULTINDO
            GLOBAL | All rights reserved </a></p>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12">
          <ul class="social">
            <li><a href="https://www.facebook.com/ICConsultant"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/ic_consultant"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/iceducation_id/"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/channel/UC86sBE9jgdoFPt_UkyfXmbw"><i class="fa fa-youtube"></i></a>
            </li>
            <li><a href="https://wa.me/628111474251" class="float" target="_blank"><i class="fa fa-whatsapp"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="{{ asset('/public/landing_page/assets/js/jquery-2.1.0.min.js')}}"></script>

  <!-- Bootstrap -->
  <script src="{{ asset('/public/landing_page/assets/js/popper.js')}}"></script>
  <script src="{{ asset('/public/landing_page/assets/js/bootstrap.min.js')}}"></script>

  <script type="text/javascript">
    var BASE_URL = "{{ url('')}}"
  </script>
  <script type="text/javascript">
    var USERNAME = "{{empty(Auth::user()) ? "" : Auth::user()->username}}";
  </script>

  <!-- Plugins -->
  <script src="{{ asset('/public/landing_page/assets/js/owl-carousel.js')}}"></script>
  <script src="{{ asset('/public/landing_page/assets/js/scrollreveal.min.js')}}"></script>
  <script src="{{ asset('/public/landing_page/assets/js/waypoints.min.js')}}"></script>
  <script src="{{ asset('/public/landing_page/assets/js/jquery.counterup.min.js')}}"></script>
  <script src="{{ asset('/public/landing_page/assets/js/imgfix.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Global Init -->
  <script src="{{ asset('/public/landing_page/assets/js/custom.js')}}"></script>

  <!-- Common script -->
  <script src="{{ asset('/public/landing_page/assets/js/common_scripts_min.js')}}"></script>
  <!-- Wizard script -->
  <script src="{{ asset('/public/landing_page/assets/js/registration_wizard_func.js')}}"></script>
  <!-- Theme script -->
  <script src="{{ asset('/public/landing_page/assets/js/functions.js')}}"></script>
  {{-- default --}}
  <script src="{{ asset('/public/landing_page/assets/js/loadingoverlay.min.js')}}"></script>

  <script type="text/javascript">
    $("#wrapped").submit(function(e){
        e.preventDefault();
        $(".text-danger").remove();
        if(is_empty($('[name="nama"]').val())) {
            $('[name="nama"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Nama dibutuhkan silahkan isi dahulu</p>');
            $('[name="nama"]').focus();
            return false;
        } else if(is_empty($('[name="no_hp"]').val())) {
            $('[name="no_hp"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> No HP dibutuhkan silahkan isi dahulu</p>');
            $('[name="no_hp"]').focus();
            return false;
        } else if(is_empty($('[name="email"]').val())) {
            $('[name="email"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Email dibutuhkan silahkan isi dahulu</p>');
            $('[name="email"]').focus();
            return false;
        } else if(is_empty($('[name="password"]').val())) {
            $('.password').html('<p class="text-danger"><i class="fa fa-info-circle"></i> Password dibutuhkan silahkan isi dahulu</p>');
            $('[name="password"]').focus();
            return false;
        } else if($('[name="password"]').val().length < 8) {
            $('.password').html('<p class="text-danger"><i class="fa fa-info-circle"></i> Password harus 8 karakter</p>');
            $('[name="password"]').focus();
            return false;
        } else if(is_empty($('[name="password2"]').val())) {
            $('[name="password2"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Ulangi Password dibutuhkan silahkan isi dahulu</p>');
            $('[name="password2"]').focus();
            return false;
        } else {
            $('[name="pilihan_hari"]').removeAttr("disabled");
            $('[name="nama_produk"]').removeAttr("disabled");
            $.LoadingOverlay("show");
            $(this).unbind('submit').submit();
            return true;
        }
      });
    
      function is_empty(MyVar){
        return ((typeof MyVar== 'undefined') || (MyVar == null) || (MyVar == false) || (MyVar == ""));
      }
    
      $('[name="email"]').blur(function(e) {
        e.preventDefault();
        if (!is_empty(e.target.value)) {
            $.ajax({
              method: "POST",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{ route('register-check-email')}}",
              data: {
                "email": e.target.value
              },
              dataType: "json",
              beforeSend: function( xhr ) {
                    $.LoadingOverlay("show");
                },
                complete: function() {
                    $.LoadingOverlay("hide");
                },
                success: function (data) {
                    if (data.message > 0) {
                        Swal.fire({
                          icon: 'error',
                          text: 'Email sudah digunakan silahkan ganti email lain.',
                        }).then((result) => {
                            $('[name="email"]').val('');
                            $('[name="email"]').focus();
                        });
                    }
                },
            });
            return false;
        } else {
            return true;
        }
      });
    
      function mobilevalid(target) {
        $(".text-danger").remove();
        var nomor_hape = '+62' + document.getElementById('#no_hp').value;
        var filter = /^(^\+62\s?)(\d{3,4}-?){2}\d{3,4}$/g;
        if (!filter.test(target.value)) {
            $('[name="'+target.name+'"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> No handphone tidak valid.</p>');
            target.value = "";
            target.focus();
            return false;
        }
        return true;
      }
    
      function  emailvalid(target) {
        $(".text-danger").remove();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(target.value.trim())) {
            $('[name="'+target.name+'"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Email tidak valid.</p>');
            target.value = "";
            target.focus();
            return false;
        }
        return true;
      }
    
      function CheckpasswordStrength(e) {
        $(".text-danger").remove();
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
    
        var passed = 0;
    
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(e.value)) {
                passed++;
            }
        }
    
        //Validate for length of password.
        if (passed > 2 && e.value.length > 8) {
            passed++;
        }
    
        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
                strength = "lemah";
                color = "red";
                break;
            case 2:
                strength = "bagus";
                color = "darkorange";
                break;
            case 3:
            case 4:
                strength = "kuat";
                color = "green";
                break;
            case 5:
                strength = "sangat kuat";
                color = "darkgreen";
            break;
        }
        $('.password').html('<p class="text-danger" style="background:'+color+';padding:3px;color:white !important;margin-top:7px;"><i class="fa fa-info-circle"></i> password '+strength+'</p>');
      }
    
      function match_password(e) {
        if($('[name="password"]').val() != $('[name="password2"]').val()) {
            $('.password2').html('<p class="text-danger"><i class="fa fa-info-circle"></i> password tidak sama</p>');
            $(this).focus();
            $('[name="password2"]').val('');
            return false;
        }
        $('.password2').html('<p class="text-success"><i class="fa fa-info-circle"></i> password sama</p>');
        return true;
      }
    
      function toggle_password(e) {
        $(e).toggleClass("fa-eye-slash");
        var toggle = $(e).attr("toggle");
        var input = $(toggle);
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
      }
    
      $(document).ready(function() {
        $('[name="nama_produk"]').on('change',function(e) {
            $('[name="pilihan_hari"]').children('option').hide();
            var params = $('[name="pilihan_hari"]').children('option[data-id="'+e.target.value+'"]');
            for (var i = 0; i < params.length; i++) {
                $(params).show();
            }
        });
      });
  </script>
</body>