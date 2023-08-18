@extends('user.layouts.user-app')

@section('content')
<main class="col-md-12 ms-sm-auto px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-3 mb-3">
    <div class="container-fluid content">
      @if ( session()->has('success'))
      <div class="alert alert-success shadow mx-3">
        {{ session('success')}}
      </div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger mt-3">
        <ul>
          @foreach ($errors->all() as $item)
          <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="row path_file justify-content-between mb-4">
        <h4>Profile</h4>
        <button type="button" class="btn btn-danger">
          <a href="{{ route('forgot-password')}}" class="text-white">Ubah Password</a>
        </button>
      </div>
      <div class="row">
        <div class="col-md-2 text-center">
          <img class=""
            src="{{ ($data->image_name) ? asset('storage/userImage/'.$data->image_name) : asset('userAdmin/img/profil.png') }}"
            alt="" width="80%">
        </div>
        <div class="col-md-8 my-auto">
          <div class="card-body">
            <div class="card-text">
              <p><strong>Email: {{ $data->email }}</strong></p>
            </div>
            <div class="card-text">
              <p><strong>Nomor Hp: {{ $data->no_hp }}</strong></p>
            </div>
            <form action="{{ route('upload-photo')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="file" name="image">
              <input type="submit" value="Upload">
            </form>
          </div>
        </div>
      </div>
      <div class="row path_file mt-4 justify-content-between mb-4">
        <h4>Data Dapodik</h4>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#editDataDapodik">
          Edit Data DAPODIK
        </button>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <th>Nama Lengkap</th>
            <td>{{ $dapodik->nama_lengkap ?? $data->name }}</td>
          </tr>
          <tr>
            <th>Nomor NIK</th>
            <td>{{ $dapodik->nik ?? 'belum ada data' }}</td>
          </tr>
          <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $dapodik->jenis_kelamin ?? 'belum ada data' }}</td>
          </tr>
          <tr>
            <th>Tempat Lahir</th>
            <td>{{ $dapodik->tempat_lahir ?? 'belum ada data' }}</td>
          </tr>
          <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $dapodik->tanggal_lahir ?? 'belum ada data'}}</td>
          </tr>
          <tr>
            <th>Nama Ibu Kandung</th>
            <td>{{ $dapodik->nama_ibu ?? 'belum ada data' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>

<div class="modal fade" id="editDataDapodik" tabindex="-1" role="dialog" aria-labelledby="confirmRequestSertifTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Dapodik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('data-dapodik')}}" method="post">
        @csrf
        @method('put')
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"
              value="{{ $data->name }}">
          </div>
          <div class="form-group">
            <label for="nik">Nomor NIK</label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nomor NIK" required>
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
              <option value="Laki laki">Laki laki</option>
              <option value="Perempuan">Perempuan</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Jakarta Selatan"
              required>
          </div>
          <div class="form-group">
            <label class="control-label">Tanggal Lahir</label>
            <input class="form-control tanggal" name="tanggal_lahir" type="text" required placeholder="Select Date..">
          </div>
          <div class="form-group">
            <label for="nama_ibu">Nama Ibu Kandung</label>
            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu Kandung">
          </div>
        </div>
        <div class="modal-footer">
          <p class="text-danger">*Data anda digunakan untuk keperluan dapodik dan tidak untuk keperluan yang lain</p>
          <button class="btn btn-primary" type="submit">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('addon-style')
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
@endpush

@push('addon-script')
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script>
  $(".tanggal").flatpickr({
        altInput: true,
        altFormat: "d F Y",
        dateFormat: "d F Y",
    });
</script>
@endpush