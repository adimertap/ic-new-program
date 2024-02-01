@extends('admin.app')

@section('title')
Master Sertifikat
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@endpush

@section('content')
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="section-description section-description-inline">
            <h1>Sertifikat</h1>
          </div>

          @if (session()->has('success'))
          <div class="alert alert-success alert-style-light" role="alert">
            {{ session('success')}}
          </div>
          @elseif (session()->has('error'))
          <div class="alert alert-danger alert-style-light" role="alert">
            {{ session('error') }}
          </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger alert-style-light" role="alert">
            <ul>
              @foreach ($errors->all() as $item)
              <li>
                {{ $item }}
              </li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="card">
            <div class="card-body small">
              <nav class="mb-5">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Master Sertifikat</button>
                  <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history"
                    type="button" role="tab" aria-controls="nav-history" aria-selected="true">History
                    Sertifikat</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tanda Tangan</button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                  tabindex="0">
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Sertifikat</th>
                        <th>Slug Product</th>
                        <th>Username</th>
                        <th>Status Bayar</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sertifikat as $item )
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor }}</td>
                        <td>{{ $item->slug_product}}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                          @if($item->status_bayar == 2)
                          Lunas
                          @else
                          Belum Lunas
                          @endif
                        </td>
                        <td class="d-flex flex-row"> 
                          <a class="btn btn-sm btn-primary m-r-sm" id="unduh-depan"
                          href="{{ route('admin-sertifikat-admin', $item->id )}}">
                          Lihat
                        </a>
                          <button class="btn btn-sm btn-success m-r-sm ttd_sertif" value="{{ $item->id }}"
                            type="button">
                            Tanda Tangan
                          </button>

                          {{-- <a class="btn btn-sm btn-primary m-r-sm" id="unduh-depan"
                            href="{{ route('admin-unduh-sertifikat', $item->id )}}">
                            Depan
                          </a>
                          <a class="btn btn-sm btn-success m-r-sm" id="edit-materi"
                            href="{{ route('admin-unduh-sertifikat-nilai', $item->id)}}">
                            Belakang
                          </a> --}}
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab" tabindex="0">
                  <table id="example3" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Sertifikat</th>
                        <th>Slug Product</th>
                        <th>Username</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sertif_lama as $item )
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor }}</td>
                        <td>{{ $item->slug_product}}</td>
                        <td>{{ $item->username }}</td>
                        <td class="d-flex flex-row">
                          <a class="btn btn-sm btn-primary m-r-sm" id="unduh-depan"
                            href="{{ route('admin-sertifikat-admin', $item->id )}}">
                            Lihat
                          </a>
                          <button onclick="ulangiFunction({{ $item->id }})" class="btn btn-sm btn-success m-r-sm ttd_ulangi" value="{{ $item->id }}"
                            type="button">
                            Ulangi
                          </button>
                          <form id="ulangi-form-{{ $item->id }}" action="{{ route('admin-sertifikat-ulang-ttd', $item->id) }}" method="post" style="display: none">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                  tabindex="0">
                  <button type="button" class="btn btn-primary m-b-sm mb-4 mt-1" data-bs-toggle="modal"
                    data-bs-target="#modalTambah">Tambah Tanda Tangan</button>
                  <table id="example2" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ttd as $item )
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                          @if($item->status == 1)
                          Aktif
                          @else
                          Tidak Aktif
                          @endif
                        </td>
                        <td class="text-center">
                          {{-- <button href="" class="btn btn-sm btn-light text-center editBtn"
                            style="padding-right:5px" value="{{ $item->id_ttd }}" type="button"><i
                              class="fa-solid fa-pen-to-square fa-xs" style="font-size:16px"></i>
                          </button> --}}
                          <button href="" class="btn btn-sm btn-danger text-center deleteBtn" style="padding-right:2px"
                            value="{{ $item->id_ttd }}" type="button" onclick="myFunction({{ $item->id_ttd }})">
                            <i class="fa-solid fa-trash fa-xs" style="font-size:16px"></i>
                          </button>
                          <form id="delete-form-{{ $item->id_ttd }}"
                            action="{{ route('admin-ttd.destroy', $item->id_ttd) }}" method="post"
                            style="display: none">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalTandaTangan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title h4" id="addInstansiLabel">Tanda Tangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data"
          action="{{ route('admin-ttd.update', '1')}}" method="POST">
          @method('PUT')
          @csrf
          <input type="hidden" id="id_sertif_ttd" name="id_sertif_ttd">
          <div class="form-group m-b-sm">
            <div class="col-12 mt-1">
              <label for="jenis">Pilih Tanda Tangan</label><span class="mr-4 mb-3" style="color: red">*</span>
              <select class="form-select" id="ttd_pilih" name="ttd_pilih">
                <option value="">Pilih Tanda Tangan</option>
                @foreach ($ttd_jenis as $item)
                <option value="{{ $item->id_ttd }}">{{ $item->keterangan }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <p class="mt-3 mb-1 small">Konfirmasi Tanda Tangan, simak gambar berikut</p>
          <div class="text-center">
            <div class="border border-dark mt-3 m-b-sm">
              <img src="" alt="" id="showSertif" width="500" height="300">
            </div>
          </div>

      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-info" id="dismis-modal-create">Back</button>
        <button type="submit" class="btn btn-primary" value="create">Tanda Tangani</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title h4" id="addInstansiLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data"
          action="{{ route('admin-ttd.store')}}" method="POST">
          @csrf
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Keterangan </label> <span class="mr-4 mb-3" style="color: red">*</span>
              <textarea type="text" value="{{ old('keterangan') }}"
                placeholder="Input Keterangan dari Tanda Tangan atau Stempel" class="form-control form-control-sm"
                name="keterangan" autocomplete="off" autocorrect="off" spellcheck="false" required></textarea>
            </div>
            <div class="col-12 mt-3">
              <label class="control-label">Upload Gambar <span class="mr-4 mb-3" style="color: red">*</span></label>
              <input type="file" class="form-control form-control-sm" name="gambar" accept=".png" required>
            </div>
            <p class="text-danger small mt-3">(*) Wajib diisi</p>
          </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-info" id="dismis-modal-create">Back</button>
        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- <div class="modal fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title h4" id="addInstansiLabel">Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data"
          action="{{ route('admin-ttd.store')}}" method="POST">
          @csrf
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Keterangan </label>
              <input type="text" class="form-control form-control-sm" id="keterangan_edit" />
            </div>
            <div class="row">
              <div class="col-6">
                <label class="control-label">Jenis </label>
                <input type="text" class="form-control form-control-sm" id="jenis_edit" />
              </div>
              <div class="col-6">
                <label class="control-label">Status </label>
                <input type="text" class="form-control form-control-sm" id="status_edit" />
              </div>
            </div>


          </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-info" id="dismis-modal-create">Back</button>
      </div>
      </form>
    </div>
  </div>
</div> --}}

@endsection

@push('js')
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datepickers.js')}}"></script>

<script>
   function ulangiFunction(itemId) {
        Swal.fire({
            title: 'Ulangi Tanda Tangan?',
            text: "Apakah Kamu Yakin Mengulang Tanda Tangan pada Seritfikat Ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ulangi!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById(`ulangi-form-${itemId}`).submit()
            }
        })
    }
  $(document).ready(function () {
      var table = $('#example').DataTable();
      table.on('click', '.ttd_sertif', function () {
            var id = $(this).val()
            $('#modalTandaTangan').modal('show');
            $('#id_sertif_ttd').val(id)
            $('#showSertif').css('src', '') 
        })
      $('#ttd_pilih').on('change', function(){
          var tes = $(this).val()
          $.ajax({
              method: 'get',
              url: '/master/ttd/' + tes,
              success: function (response) {
                console.log(response)
                $('#showSertif').attr('src', '../../tandatangan/' + response.gambar); 
              },
              error: function (response) {
                  console.log(response)
              },
          })
      })
      $('#example2').DataTable();
      $('#example3').DataTable();


   })
  //  ttd_sertif
   function myFunction(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById(`delete-form-${itemId}`).submit()
            }
        })
    }
</script>
@endpush