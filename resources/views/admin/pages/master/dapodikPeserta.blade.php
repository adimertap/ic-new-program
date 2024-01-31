@extends('admin.app')

@section('title')
Users - Dapodik
@endsection

@push('css')
<link href="{{ asset('/public/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}"
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
            <h1>Users {{ $dapodik->nama_lengkap ?? '' }}</h1>
          </div>
          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p>Data Dapodik Peserta</p>
                    <p class="text-danger">Credential Data!</p>
                </div>
              <hr>
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->nama_lengkap ?? '' }}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">NIK</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->nik ?? '' }}" readonly>
                    </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Jenis Kelamin</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->jenis_kelamin ?? '' }}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Nama Ibu</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->nama_ibu ?? '' }}" readonly>
                    </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Tempat Lahir</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->tempat_lahir ?? '' }}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->tanggal_lahir ?? '' }}" readonly>
                    </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Last Update</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $dapodik->updated_at ?? '' }}" readonly>
                    </div>
                </div>
              </div>
            </div>
            <div class="card-footer p-4">
                <a href="{{ route('admin-user') }}" class="btn btn-primary">Back to Master Page</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>

</script>
<script src="{{ asset('/public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datatables.js')}}"></script>

@endpush