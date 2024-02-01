@extends('admin.app')

@section('title')
Master Gallery
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline">
                        <h1>Gallery</h1>
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
                            <table id="datatable1" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Caption</th>
                                        <th>Title</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galleries as $galeri)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/gallery/'.$galeri->image ) }}" alt="" srcset="" width="75%">
                                        </td>
                                        <td>{{ $galeri->caption }}</td>
                                        <td>{{ $galeri->title }}</td>
                                        <td>{{ $galeri->active }}</td>
                                        <td class="d-flex flex-row">
                                            <button class="btn btn-sm btn-warning m-r-sm" id="edit-galeri"
                                                data-id="{{ $galeri->id }}">
                                                <span class="material-icons-outlined">create</span>
                                            </button>
                                            <form action="{{ route('admin-galery-delete', $galeri->id )}}"
                                                method="post" id="delete-produk">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    id="btn-delete-produk">
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
                <form id="myForm" name="myForm" class="form-horizontal" action="{{ route('admin-galery-store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
					<input type="hidden" name="id">
					<div class="form-group m-b-sm">
						<div class="col-sm-12">
							<label class="control-label">Caption</label>
							<textarea class="form-control" name="caption" autocomplete="off" autocorrect="off" spellcheck="false" required></textarea>
						</div>
					</div>
					<div class="form-group m-b-sm">
						<div class="col-sm-12">
							<label class="control-label">Title</label>
							<input type="text" name="title" class="form-control" autocomplete="off" autocorrect="off" spellcheck="false" required>
						</div>
					</div>
					<div class="form-group m-b-sm">
						<div class="col-sm-12">
							{{-- <label class="control-label">Image</small></label>
							<input type="file" class="form-control" id="image" name="image" autocomplete="off" autocorrect="off" spellcheck="false"> --}}
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="formFile" name="image">
						</div>
					</div>
					<div class="form-group m-b-sm">
						<div class="col-sm-12">
							<label class="control-label">Active</small></label>
							<select class="form-control" name="active" autocomplete="off" autocorrect="off" spellcheck="false" required>
								<option value="1">Y</option>
								<option value="0">N</option>
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
@endsection

@push('js')
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datepickers.js')}}"></script>
<script>
    $('body').on('click', '#edit-galeri', function(){
        document.getElementById("myForm").reset();
        const id = $(this).data('id')
        let url = "{{ route('admin-galery-edit', ':id')}}"
        url = url.replace(':id', id)

        $.get(url, (data) => {
            console.log(data)
            $('#addNewProduct').modal('show')
            $('.modal-title').html("Edit Galeri")
			$('[name="id"]').val(data.id)
			$('[name="caption"]').val(data.caption)
			$('[name="title"]').val(data.title)
			$('[name="active"]').val(data.active)
        })
    })
</script>
@endpush