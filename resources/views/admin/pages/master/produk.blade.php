@extends('admin.app')

@section('title')
Master Produk
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="section-description section-description-inline">
            <h1>Produk</h1>
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

          <div class="card">
            <div class="card-body small">
              <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal"
                data-bs-target="#addNewProduct">Add Product</button>
              <table id="datatable1" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Note</th>
                    <th>Nama Produk</th>
                    <th>Angkatan</th>
                    <th>Aktif</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->kelas }}</td>
                    <td>{{ $product->harga }}</td>
                    <td>{{ $product->diskon }}</td>
                    <td>{{ $product->tgl_mulai }}</td>
                    <td>{{ $product->tgl_selesai }}</td>
                    <td>{{ $product->jam_mulai }}</td>
                    <td>{{ $product->jam_selesai }}</td>
                    <td>{{ $product->note }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->angkatan }}</td>
                    <td>{{ $product->aktif }}</td>
                    <td class="d-flex flex-row">
                      {{-- <form action="{{ route('admin-produk-isOnline', $product->id )}}" method="post"
                        class="btn btn-sm {{ $product->online == null || $product->online == '0' ? 'btn-warning' : 'btn-success' }} m-r-sm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="onlineStatus" id="onlineStatus"
                          value="{{ $product->online == null || $product->online == '0' ? '1' : '0' }}">
                        <button type="submit" class="btn text-white" id="online-product"
                          style="padding: 6px 0px !important">
                          {{ $product->online == null || $product->online == '0' ? 'Offline' : 'Online' }}
                        </button>
                      </form> --}}
                      <button class="btn btn-sm btn-info m-r-sm p-0" id="sertifikat-product" data-id="{{ $product->id }}">
                        <span class="p-2">Sertifikat</span>
                      </button>
                      <button class="btn btn-sm btn-warning m-r-sm p-0" id="edit-product" data-id="{{ $product->id }}">
                        <span class="material-icons-outlined p-2">create</span>
                      </button>
                      <form action="{{ route('admin-produk-delete', $product->id )}}" method="post" id="delete-produk">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger p-0" id="btn-delete-produk">
                          <span class="material-icons-outlined p-2">delete</span>
                        </button>
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

<div class="modal fade" id="addNewProduct" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="addNewProductLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="addNewProductLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="myForm" name="myForm" class="form-horizontal" action="{{ route('admin-produk-store')}}" method="POST">
          @csrf
          <input type="hidden" name="id">
          <input type="hidden" name="slug">
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Kelas</label>
              <input type="text" class="form-control" name="kelas" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Harga</label>
              <input type="text" class="form-control Idr" name="harga" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Diskon</label>
              <input type="text" class="form-control" name="diskon" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Tgl Mulai</label>
              <input class="form-control flatpickr1" name="tgl_mulai" type="text" placeholder="Select Date..">
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Tgl Selesai</label>
              <input class="form-control flatpickr1" name="tgl_selesai" type="text" placeholder="Select Date..">
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Jam Mulai</label>
              <input type="text" class="form-control timepickr" name="jam_mulai" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Jam Selesai</label>
              <input type="text" class="form-control timepickr" name="jam_selesai" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Nama Produk</label>
              <select class="form-control" name="nama_produk" autocomplete="off" autocorrect="off" spellcheck="false"
                required>
                <option value="">--Pilih Produk</option>
                <option value="brevet-ab">Brevet AB</option>
                <option value="brevet-c">Brevet C</option>
                <option value="uskp-a">USKP A</option>
                <option value="uskp-b">USKP B</option>
                <option value="uskp-c">USKP C</option>
                <option value="seminar">Seminar</option>
                <option value="ujian">Ujian Brevet</option>
              </select>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Angkatan</label>
              <input type="number" class="form-control" name="angkatan" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Note</label>
              <input type="text" class="form-control" name="note" autocomplete="off" autocorrect="off"
                value="Rp. 3.000.000,00" spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Description</label>
              <textarea rows="10" class="form-control" name="description" autocomplete="off" autocorrect="off"
                spellcheck="false"></textarea>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Gratis</label>
              <select name="gratis" class="form-control" autocomplete="off" autocorrect="off" spellcheck="false">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Aktif</label>
              <select name="aktif" class="form-control" autocomplete="off" autocorrect="off" spellcheck="false">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Online</label>
              <select name="online" class="form-control" autocomplete="off" autocorrect="off" spellcheck="false"
                required>
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addNewSertifikat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="addNewSertifikatLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewSertifikatLabel">Upload Sertifikat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <form action="{{ route('admin-product-addSertifikat')}}" method="POST" enctype="multipart/form-data"
          id="formNewSertifikat">
          @csrf
          <button type="button" class="btn btn-primary" id="uploadSertif">Upload Sertifikat Depan</button>
          <input type="file" name="sertifikat" id="mediaFile" class="d-none">
          <input type="hidden" name="id" id="id">
          <div class="border border-dark mt-3 m-b-sm">
            <img src="" alt="" id="showSertif" width="474px" height="318px">
          </div>
          <button type="button" class="btn btn-primary" id="uploadSertif_nilai">Upload Sertifikat
            Nilai</button>
          <input type="file" name="sertifikat_nilai" id="mediaFile_nilai" class="d-none">
          <div class="border border-dark mt-3">
            <img src="" alt="" id="showSertif_nilai" width="474px" height="318px">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      </form>
    </div>

  </div>
</div>

@endsection

@push('js')
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datepickers.js')}}"></script>
<script>
  $('body').on('click', '#edit-product', function(){
        $('#myForm').trigger("reset")
        const id = $(this).data('id')
        let url = "{{ route('admin-produk-edit', ':id')}}"
        url = url.replace(':id', id)

        $.get(url, (data) => {
            console.log(data)
            $('#addNewProduct').modal('show')
            $('.modal-title').html("Edit Produk")
			$('[name="id"]').val(data.id)
			$('[name="kelas"]').val(data.kelas)
			$('[name="harga"]').val(data.harga)
			$('[name="diskon"]').val(data.diskon)
			$('[name="tgl_mulai"]').val(data.tgl_mulai)
			$('[name="tgl_selesai"]').val(data.tgl_selesai)
			$('[name="jam_mulai"]').val(data.jam_mulai)
			$('[name="jam_selesai"]').val(data.jam_selesai)
			$('[name="jam_selesai"]').val(data.jam_selesai)
			$('[name="note"]').val(data.note)
			$('[name="nama_produk"]').val(data.nama_produk)
			$('[name="angkatan"]').val(data.angkatan)
			$('[name="aktif"]').val(data.aktif)
			$('[name="gratis"]').val(data.gratis)
			$('[name="online"]').val(data.online)
			$('[name="tmp_slug"]').val(data.slug)
            $('[name="description"]'.val(data.description))
        })
    })

    $('body').on('click', '#sertifikat-product', function(){
        $('#formNewSertifikat').trigger("reset")
        $('#showSertif').css('content', '')
        $('#showSertif_nilai').css('content', '')
        const id = $(this).data('id')

        $('#addNewSertifikat').modal('show')
        $('[name="id"]').val(id)

        //sertifikat depan
		$('#uploadSertif').on('click', function (e) {
			$('#mediaFile').click();
		})
		$('#mediaFile').change(function(e) {
			var input = e.target;
			if (input.files && input.files[0]) {
			var file = input.files[0];

			var reader = new FileReader();

			reader.readAsDataURL(file);
			reader.onload = function(e) {
					$('#showSertif').css('content', 'url(' + reader.result + ')');
				}
			}
		})

		//sertifikat nilai
		$('#uploadSertif_nilai').on('click', function (e) {
			$('#mediaFile_nilai').click();
		})
		$('#mediaFile_nilai').change(function(e) {
			var input = e.target;
			if (input.files && input.files[0]) {
			var file = input.files[0];

			var reader = new FileReader();

			reader.readAsDataURL(file);
			reader.onload = function(e) {
					$('#showSertif_nilai').css('content', 'url(' + reader.result + ')');
				}
			}
		})
    })
</script>
@endpush