@extends('admin.app')

@section('title')
Master Bank Soal
@endsection

@push('css')
<link href="{{ asset('/public/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="section-description section-description-inline">
            <h1>Bank Soal</h1>
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
                data-bs-target="#addNewQuestion">Add New Question
              </button>
              <table id="datatable4" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Soal</th>
                    <th>Materi</th>
                    <th>Soal</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>Jawaban Benar</th>
                    <th>Pembahasan</th>
                    <th>Kode Soal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($bankSoal as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_soal ?? 'user deleted' }}</td>
                    <td>{{ $item->materi->description?? 'user deleted'}}</td>
                    <td>{{ $item->soal ?? 'user deleted'}}</td>
                    <td>{{ $item->a ?? 'user deleted'}}</td>
                    <td>{{ $item->b ?? 'user deleted'}}</td>
                    <td>{{ $item->c ?? 'user deleted'}}</td>
                    <td>{{ $item->d ?? 'user deleted'}}</td>
                    <td>{{ $item->jawaban ?? 'user deleted'}}</td>
                    <td>{{ $item->pembahasan ?? 'user deleted'}}</td>
                    <td>{{ $item->kode_soal ?? 'user deleted'}}</td>
                    <td>
                      <form action="{{ route('admin-ujian-destroy-soal', $item->id )}}" method="post"
                        id="delete-produk" class="d-inline"> 
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger p-0" id="btn-delete-produk">
                          <span class="material-icons-outlined p-2">delete</span>
                        </button>
                      </form>
                      <button class="btn btn-sm btn-outline-warning p-0 flex align-item-center" id="edit-soal" data-id="{{ $item->id }}">
                        <span class="material-icons-outlined p-2">edit</span>
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

<div class="modal fade" id="addNewQuestion" tabindex="-1" aria-labelledby="addNewQuestionLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewQuestionLabel">Add New Questions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formSoal" id="formSoal" class="row g-3" action="{{ route('admin-ujian-store-soal')}}" method="post">
          @csrf
          <input type="hidden" name="id">
          <div class="col-md-2">
            <label for="inputNomor" class="form-label">Nomor Soal</label>
            <input type="number" class="form-control" id="inputNomor" name="no_soal">
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-6">
            <label for="inputMateri" class="form-label">Materi</label>
            <select id="inputMateri" class="form-select" name="materi_id">
              <option selected>Pilih Materi</option>
              @foreach ($materi as $item)
              <option value="{{ $item->id }}">{{ $item->description}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12">
            <div class="form-label" for="inputKodeSoal">Kode Soal</div>
            <input type="text" class="form-control" id="inputKodeSoal" placeholder="" name="kode_soal">
          </div>
          <div class="col-12">
            <label for="inputSoal" class="form-label">Soal</label>
            <textarea type="text" class="form-control" id="inputSoal" rows="5" name="soal"></textarea>
          </div>
          <div class="col-12">
            <div class="input-group m-b-sm">
              <div class="input-group-text">A</div>
              <input type="text" class="form-control" id="inputPilihanA" placeholder="" name="a">
            </div>
            <div class="input-group m-b-sm">
              <div class="input-group-text">B</div>
              <input type="text" class="form-control" id="inputPilihanB" placeholder="" name="b">
            </div>
            <div class="input-group m-b-sm">
              <div class="input-group-text">C</div>
              <input type="text" class="form-control" id="inputPilihanC" placeholder="" name="c">
            </div>
            <div class="input-group m-b-sm">
              <div class="input-group-text">D</div>
              <input type="text" class="form-control" id="inputPilihanD" placeholder="" name="d">
            </div>
          </div>
          <div class="col-md-6">
            <label for="inputJawaban" class="form-label">Jawaban Benar</label>
            <select id="inputJawaban" class="form-select" name="jawaban">
              <option>Choose...</option>
              <option value="a">A</option>
              <option value="b">B</option>
              <option value="c">C</option>
              <option value="d">D</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputPembahasan" class="form-label">Pembahasan</label>
            <textarea type="text" class="ckeditor form-control" id="inputPembahasan" name="pembahasan"></textarea>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Selesai</button>
          </div>
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
<script src='https://cdn.ckeditor.com/4.20.0/full/ckeditor.js'></script>
<script>
  CKEDITOR.replace('pembahasan', {
        extraPlugins : 'tab',
        tabSpaces : 4
    })

  $('body').on('click', '#edit-soal', function () {
    $('#formSoal').trigger("reset")
    const id = $(this).data('id')
    let url = "{{ route('admin-ujian-edit-soal', ':id') }}"
    url = url.replace(':id', id)

    $.get(url, (data) => {
      console.log(data)
      $('#addNewQuestion').modal('show')
      $('.modal-title').html("Edit Soal")
        $('[name="id"]').val(data.id)
        $('[name="no_soal"]').val(data.no_soal)
        $('[name="materi_id"]').val(data.materi_id)
        $('[name="kode_soal"]').val(data.kode_soal)
        $('[name="soal"]').val(data.soal)
        $('[name="a"]').val(data.a)
        $('[name="b"]').val(data.b)
        $('[name="c"]').val(data.c)
        $('[name="d"]').val(data.d)
        $('[name="jawaban"]').val(data.jawaban)
        $('[name="pembahasan"]').prepend(data.pembahasan)
    })
  })
</script>
@endpush