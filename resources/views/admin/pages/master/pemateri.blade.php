@extends('admin.app')

@section('title')
Pemateri
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="section-description section-description-inline">
            <h1>Pemateri</h1>
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
            <div class="card-body">
              <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal"
                data-bs-target="#addPemateri">Add Pemateri</button>
              <table id="datatable1" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Kode Soal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->user->username }}</td>
                    <td>{{ $user->kode_soal }}</td>
                    <td>
                      <form action="{{ route('admin-delete-pemateri', $user->id )}}" method="post" id="delete-user">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" id="btn-delete-user">
                          <span class="material-icons-outlined">delete</span>
                        </button>
                      </form>
                      <button class="btn btn-sm btn-warning mt-2" id="btn-edit-user">
                        <span class="material-icons-outlined">edit</span>
                      </button>
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

<div class="modal fade" id="addPemateri" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="addPemateriLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="addPemateriLabel">Add New Pemateri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="myForm" name="myForm" class="form-horizontal" action="{{ route('admin-create-pemateri')}}"
          method="POST">
          @csrf
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="name" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label">Username</label>
              <input type="text" class="form-control" name="username" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
          </div>
          <div class="row form-group m-b-sm">
            <div class="col-6">
              <label class="control-label">Password</label>
              <input type="text" class="form-control" name="password" autocomplete="off" autocorrect="off"
                value="pemateri123" spellcheck="false" readonly>
            </div>
            <div class="col-6">
              <label class="control-label">Materi</label>
              <select class="form-control" name="materi_id" autocomplete="off" autocorrect="off" spellcheck="false"
                required>
                @foreach ($materi as $item)
                <option value="{{ $item->id }}">{{ $item->description }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-group m-b-sm align-items-end">
            <div class="col-6">
              <label class="control-label">No Hp</label>
              <input type="text" class="form-control" name="no_hp" autocomplete="off" autocorrect="off"
                spellcheck="false" required>
            </div>
            <div class="col-2">
              <label for="jumlahSoal" class="control-label">Jumlah Kode Soal</label>
              <input type="number" class="form-control" name="jumlah_soal" id="jumlahSoal" autocomplete="off"
                autocorrect="off">
            </div>
            <div class="col-2">
              <span class="btn btn-lg bg-primary text-white" onclick="showElement()">Cetak</span>
            </div>
          </div>
          <div class="form-group m-b-sm" id="formKodeSoal"></div>
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
<script>
  const jumlahSoalInput = document.getElementById("jumlahSoal");
    const wrapperKodeSoal = document.getElementById("formKodeSoal");

    function addElement(index) {
        wrapperKodeSoal.innerHTML += `
        <label class="control-label">Kode Soal ${index}</label>
        <input type="text" class="form-control" name="kode_soal[]" autocomplete="off" autocorrect="off"
            spellcheck="false" required>`
    }

    function displayElement(length) {
        for (let index = 0; index < length; index++) {
            addElement(index+1)
        }
    }

    function showElement() {
        displayElement(jumlahSoalInput.value);
    }
</script>
@endpush