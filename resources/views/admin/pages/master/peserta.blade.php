@extends('admin.app')

@section('title')
Users
@endsection

@push('css')
<link href="{{ asset('assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
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
            <div class="card-body">
              <table id="datatable1" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Pekerjaan</th>
                    <th>Domisili</th>
                    <th>Jenis Kelamin</th>
                    <th>Instansi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->pekerjaan }}</td>
                    <td>{{ $user->domisili }}</td>
                    <td>{{ $user->jenis_kelamin }}</td>
                    <td>{{ $user->kerjasama->nama ?? '' }}</td>
                    <td>
                      <form action="{{ route('admin-delete-user', $user->id )}}" method="post" id="delete-user">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" id="btn-delete-user">
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
@endsection

@push('js')
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/datatables.js')}}"></script>
@endpush