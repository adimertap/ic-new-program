@extends('admin.app')

@section('title')
Master Materi
@endsection

@push('css')
<link href="{{ asset('/public/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="section-description section-description-inline">
            <h1>Materi</h1>
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
            <div class="card-body">
              <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal"
                data-bs-target="#addNewProduct">Add Product</button>
              <table id="datatable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($materi as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="d-flex flex-row">
                      <button class="btn btn-sm btn-warning m-r-sm" id="edit-materi" data-id="{{ $item->id }}">
                        <span class="material-icons-outlined">create</span>
                      </button>
                      <form action="{{ route('admin-materi-delete', $item->id )}}" method="post" id="delete-materi">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" id="btn-delete-materi">
                          <span class="material-icons-outlined">delete</span>
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
        <form id="myForm" name="myForm" class="form-horizontal" action="{{ route('admin-materi-store')}}" method="POST">
          @csrf
          <input type="hidden" name="id">
          <div class="form-group m-b-sm">
            <div class="col-sm-12">
              <label class="control-label">Description</label>
              <textarea class="form-control" name="description" autocomplete="off" autocorrect="off" spellcheck="false"
                required></textarea>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-sm-12">
              <label class="control-label">Active</small></label>
              <select class="form-control" name="active" autocomplete="off" autocorrect="off" spellcheck="false"
                required>
                <option value="1">Y</option>
                <option value="0">N</option>
              </select>
            </div>
          </div>
          <strong><label class="control-label m-b-sm">Buat Produk Ujian Materi Brevet</label></strong>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Harga</label>
              <input type="text" class="form-control Idr" name="harga" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <input type="hidden" name="nama_produk" value="ujian">

          <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('/public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datepickers.js')}}"></script>
<script>
  $('body').on('click', '#edit-materi', function(){
        document.getElementById("myForm").reset();
        const id = $(this).data('id')
        let url = "{{ route('admin-materi-edit', ':id')}}"
        url = url.replace(':id', id)

        $.get(url, (data) => {
            $('#addNewProduct').modal('show')
            $('.modal-title').html("Edit Galeri")
			      $('[name="id"]').val(data.id)
			      $('[name="description"]').val(data.description)
			      $('[name="active"]').val(data.active)
            $('[name="harga"]').val(data.produk.harga)
        })
    })
</script>
@endpush