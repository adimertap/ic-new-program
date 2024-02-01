@extends('admin.app')

@section('title')
Users
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}"
  rel="stylesheet">
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
            <h1>Users</h1>
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
            <div class="card-body" style="font-size: 12px">
              <div id="tableExample"
                data-list='{"valueNames":["no","jenis","nama","diskon_online","diskon_angka"],"page":20,"pagination":true}'>
                <div class="table-responsive scrollbar">
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead class="bg-200 text-900">
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Pekerjaan</th>
                        <th>Domisili</th>
                        <th>Jenis Kelamin</th>
                        <th>Instansi</th>
                        <th style="width: 200px">Action</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      @foreach ($users as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->pekerjaan }}</td>
                        <td>{{ $user->domisili }}</td>
                        <td>{{ $user->jenis_kelamin }}</td>
                        <td>{{ $user->kerjasama->nama ?? '' }}</td>
                        <td class="row">
                          <button href="" class="btn btn-sm btn-warning resetBtn" value="{{ $user->id }}"
                            type="button" onclick="resetFunction({{ $user->id }})">
                            Reset
                          </button>
                          <a href="{{ route('admin-user-dapodik', $user->id) }}"
                            class="btn btn-sm btn-primary me-2">Dapodik</a>
                          <form action="{{ route('admin-delete-user', $user->id )}}" method="post" id="delete-user">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" id="btn-delete-user">
                              delete
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
  </div>
</div>

<div class="modal fade" id="modalReset" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Reset Password User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formCreate" name="myForm" class="form-horizontal" action="{{ route('admin-user-reset-password')}}"
        method="POST">
        <div class="modal-body small">
          <input type="hidden" name="user_id" id="resetUserId" value="">
          @csrf
          <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="control-label mb-1">New Password</label><span class="mr-4 mb-3" style="color: red">*</span>
              <input type="password" class="form-control form-control-sm" name="password"
                placeholder="Masukan Password Baru User" required>
            </div>
            <div class="col-12 mt-3">
              <label class="control-label mb-1">Masukan Ulang</label><span class="mr-4 mb-3" style="color: red">*</span>
              <input type="password" class="form-control form-control-sm" name="n_password"
                placeholder="Masukan Ulang" required>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light d-flex justify-content-end">
          <button type="button" class="btn btn-info" id="btnCancel" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary ms-3" id="saveBtn" value="create">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  function resetFunction(itemId) {
      $('#modalReset').modal('show')
      $('#resetUserId').val(itemId)
    }
  $(document).ready(function () {
    var table = $('#example').DataTable();
  })
</script>
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>

@endpush