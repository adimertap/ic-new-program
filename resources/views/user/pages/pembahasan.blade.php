@extends('user.layouts.user-app')

@section('content')

<main class="col ms-sm-auto px-md-4 header_content">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <div class="container-fluid content">
            <div class="path_file">
                <div class="row justify-content-between px-3">
                    <h4 class="d-none d-md-block">Pembahasan Soal Tentang {{ $nama_materi->description }}</h4>
                    <h4 class="d-sm-block d-md-none">Pembahasan <br>Tentang {{ $nama_materi->description }}</h4>

                    <div class="{{ ($lulus == 'Lulus') ? 'text-success' : 'text-danger'}}">
                        <h4>Nilai : <strong>{{ $nilai }}</strong> | <strong>{{$abjad}} ( {{$lulus}} )</strong></h4>
                    </div>

                </div>
                @if ($lulus == 'Lulus')
                <div class="alert alert-success" role="alert">
                    <strong>Congratulations!</strong> Kamu Berhasil, <a href="{{ route('hasil-ujian')}}">Yuk Lihat Hasil Ujian
                        Kamu</a>
                </div>
                @else
                <div class="alert alert-warning" role="alert">
                    <strong>Jangan Kecewa!</strong> Bagaimana kalau kita <a href="{{ route('list')}}">coba lagi </a>?
                </div>
                @endif
            </div>

            <hr class="sidebar-divider">
            <div class="container">
                <div class="row row-cols-5 text-center g-2">
                    @foreach ($noSoal as $item => $value)
                    <div class="col">
                        <strong><a href="{{ url('/pembahasan/'.$value->materi_id.'?page='.$item+1)}}" class="{{ $value->benar == 1 ? 'text-success' : 'text-danger'}} text-decoration-none">{{ $item + 1 }}</a></strong>
                    </div>
                    @endforeach
                </div>
            </div>
            @foreach ($bahas as $item)
            <div class="brevet">
                <div class="row">
                    <div class="col">
                        <div id="soalUjian" class="bg-white d-block rounded py-3 px-5 mt-3">
                            {{ $item->soal->soal }}
                        </div>
                    </div>
                </div>
                @if ($item->jawaban == $item->soal->jawaban)
                <div class="row justify-content-center d-block mt-3">
                    <div class="col">
                        <div class="bg-success rounded d-block py-3 px-5 text-white">

                            @switch($item->jawaban)
                            @case('a')
                            <p> <strong>Jawaban Kamu Benar</strong> <br> {{ $item->soal->a }}</p>
                            @break

                            @case('b')
                            <p> <strong>Jawaban Kamu Benar</strong> <br>{{ $item->soal->b }}</p>
                            @break

                            @case('c')
                            <p> <strong>Jawaban Kamu Benar</strong> <br>{{ $item->soal->c }}</p>
                            @break

                            @case('d')
                            <p> <strong>Jawaban Kamu Benar</strong> <br>{{ $item->soal->d }}</p>
                            @break
                            @default

                            @endswitch

                            <br>
                            {{ $item->soal->pembahasan }}
                        </div>
                    </div>
                </div>

                @elseif ($item->jawaban != $item->soal->jawaban)
                @if ($item->jawaban)
                <div class="row justify-content-center d-block mt-3">
                    <div class="col">
                        <div class="bg-danger rounded d-block py-3 px-5 text-white">

                            @switch($item->jawaban)
                            @case('a')
                            <p> <strong>Jawaban Kamu Salah</strong> <br> {{ $item->soal->a }}</p>
                            @break

                            @case('b')
                            <strong>Jawaban Kamu Salah</strong> <br> {{ $item->soal->b }}</p>
                            @break

                            @case('c')
                            <strong>Jawaban Kamu Salah</strong> <br> {{ $item->soal->c }}</p>
                            @break

                            @case('d')
                            <strong>Jawaban Kamu Salah</strong> <br> {{ $item->soal->d }}</p>
                            @break
                            @default

                            @endswitch

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center d-block mt-3">
                    <div class="col">
                        <div class="bg-white rounded d-block py-3 px-5">

                            @switch($item->soal->jawaban)
                            @case('a')
                            <p> <strong>Jawaban Yang Benar</strong> <br> {{ $item->soal->a }}</p>
                            @break

                            @case('b')
                            <p> <strong>Jawaban Yang Benar</strong> <br> {{ $item->soal->b }}</p>
                            @break

                            @case('c')
                            <p> <strong>Jawaban Yang Benar</strong> <br> {{ $item->soal->c }}</p>
                            @break

                            @case('d')
                            <p> <strong>Jawaban Yang Benar</strong> <br> {{ $item->soal->d }}</p>
                            @break
                            @default

                            @endswitch
                            <p><strong>Pembahasan</strong>
                                <br>{{ $item->soal->pembahasan }}
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="row justify-content-center d-block mt-3">
                    <div class="col">
                        <div class="bg-warning rounded d-block py-3 px-5 text-white">
                            <p>Kamu Tidak Menjawab</p>
                        </div>
                    </div>
                </div>
                @endif
                @endif

                <div class="row d-block mt-3 text-center">
                    <div class="bg-white rounded p-3 d-block">
                        <div class="container">
                            <div id="pagination-wrapper">{{ $bahas->links('vendor.pagination.bootstrap-5') }}</div>
                        </div>
                    </div>
                </div>

            </div>

            @endforeach

        </div>
    </div>
</main>

@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ url('user_dashboard/frontend/styles/menu-html.css')}}" />
@endpush

@section('addon-script')
<script>
    // $(document).ready(function () {
    //   $('#exampleModal').modal('show');
    // });

</script>
@endsection
