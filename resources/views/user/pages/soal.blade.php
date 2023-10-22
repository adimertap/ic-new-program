@extends('user.layouts.user-app')

@section('content')

<main class="col ms-sm-auto px-md-5 header_content mb-5 pb-5">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-5">
        <div class="container-fluid content">
            <div class="path_file">
                <div class="row justify-content-between px-3">
                    <h4 class="d-none d-md-block my-auto">Materi dan Soal Tentang {{ $materi->description }}</h4>
                    <h4 class="d-sm-block d-md-none">Materi dan Soal <br>Tentang {{ $materi->description }}</h4>
                    <div class="d-inline-block my-auto"><strong id="time"></strong></div>
                    {{-- <button class="btn btn-outline-success d-none d-md-block btn-submit" style="width: 150px">
                        <strong> Kumpulkan </strong>
                    </button> --}}
                    <p class="text-primary">Waktu: <span class="countdown"></span></p>
                    <button
                        class="btn btn-outline-success float-right d-sm-block d-md-none align-self-center btn-submit">
                        <i class="bi bi-check2-square"></i>
                    </button>
                </div>
                <p class="text-muted mt-1">Jenis Soal Pilihan Ganda: Anda harus memilih satu</p>

            </div>
            <hr class="sidebar-divider">
            <div class="brevet">
                @foreach ($soal as $index => $item)
                <form action="" id="form" method="POST">
                    @csrf
                    <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                    <input type="hidden" name="soal_id" value="{{ $item->id }}">
                    <p class="mt-5" style="line-height: 30px; font-size:1.1rem"><b class="number mr-3">{{ $index + 1
                            }}.</b>
                        {{ $item->soal }}</p>
                    <div class="ml-3 pt-1 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" id="flexRadioDefault1" type="radio" name="jawaban" value="a"
                                {{ $item->jawaban_user === 'a' ? 'checked' : '' }} />
                            A. <label class="form-check-label ml-3" for="jawaban">{{ $item->a }}</label>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" id="jawaban" type="radio" name="jawaban" value="b" {{
                                $item->jawaban_user === 'b' ? 'checked' : '' }} />
                            B. <label class="form-check-label ml-3" for="jawaban">{{ $item->b }}</label>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" id="jawaban" type="radio" name="jawaban" value="c" {{
                                $item->jawaban_user === 'c' ? 'checked' : '' }} />
                            C. <label class="form-check-label ml-3" for="jawaban">{{ $item->c }}</label>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" id="jawaban" type="radio" name="jawaban" value="d" {{
                                $item->jawaban_user === 'd' ? 'checked' : '' }} />
                            D. <label class="form-check-label ml-3" for="jawaban">{{ $item->d }}</label>
                        </div>
                    </div>
                </form>

                <div class="mt-5 pagination" style="margin-top:150px!important;display: flex; justify-content: center;">
                    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center">
                        <div class="flex">
                            @if ($soal->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md disabled">
                                &laquo;
                            </span>
                            @else
                            <a href="{{ $soal->previousPageUrl() }}" id="previousButton"
                                class="btn btn-secondary relative inline-flex items-center px-3 py-1 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                &laquo;
                            </a>
                            @endif

                            @foreach ($soal->getUrlRange(1, $soal->lastPage()) as $page => $url)
                            <a href="{{ $url }}"
                                class="btn btn-primary relative inline-flex items-center px-3 py-1 ml-3 text-sm font-medium {{ $soal->currentPage() === $page ? 'text-white bg-blue-500' : 'text-gray-700 bg-white' }} border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {{ $page }}
                            </a>
                            @endforeach

                            @if (!$soal->hasMorePages())
                            <button onclick="saveFunction()" type="button"
                                class="btn btn-primary relative inline-flex items-center px-3 py-1 ml-3 text-sm font-medium text-white bg-blue-500 border border-gray-300 leading-5 rounded-md hover:bg-blue-600 focus:outline-none focus:ring ring-blue-300 active:bg-blue-700 transition ease-in-out duration-150">
                                Selesai
                            </button>
                            <form id="form_save" action="{{ route('simpanJawaban') }}" method="POST"
                                style="display: none">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="materi_id" name="materi_id" value="{{ $materi->id }}">
                                <input type="hidden" id="soal_id" name="soal_id" value="{{ $item->id }}">
                                <input type="hidden" id="slug_id" name="slug" value="{{ $slug }}">
                                <input type="hidden" id="type_id" name="type" value="waktu_belum_habis">
                            </form>
                            @else
                            <a href="{{ $soal->nextPageUrl() }}" id="nextButton"
                                class="relative inline-flex items-center px-3 py-1 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                &raquo;
                            </a>
                            @endif
                        </div>
                    </nav>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>

<script>
    function saveFunction() {
        Swal.fire({
            title: 'Selesai Test',
            text: "Apakah Anda Yakin untuk Menyimpan Seluruh Jawaban Kuis Ini? Jika Iya, Anda tidak dapat kembali dan jawaban Anda telah disimpan ke Sistem",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Selesai!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById('form_save').submit()
            }
        })
    }

    $(document).ready(function () {
        $('input[name="jawaban"]').change(function () {
            var form = $('#form');
            var soal_id = $('input[name="soal_id"]').val();
            var materi_id = $('input[name="materi_id"]').val();
            var token = $('input[name="_token"]').val();
            var jawaban = $('input[name="jawaban"]:checked').val();

            if (jawaban != undefined || jawaban != null) {
                var data = {
                    _token: token,
                    materi_id: materi_id,
                    soal_id: soal_id,
                    jawaban: jawaban,
                };
                console.log(data);

                $.ajax({
                    url: '/soal/jawaban/user',
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Form data submission failed:', error);
                    }
                });
            }
        });

        var csrfToken = '<?php echo csrf_token(); ?>';
        var time = 60 * 60;
        // var time = 1 * 60;


        var countdownValue = <?php echo session('countdown_value', 0); ?> || time;
        var targetTime = new Date().getTime() + (countdownValue * 1000);
        var countdownInterval = setInterval(function () {
            var now = new Date().getTime();
            var timeRemaining = targetTime - now;
            if (timeRemaining <= 0) {
                var materi_id = $('#materi_id').val();
                var soal_id = $('#soal_id').val();
                var token = $('#_token').val();

                var data = {
                    _token: token,
                    materi_id: materi_id,
                    soal_id: soal_id,
                    type: "waktu_habis"
                }

                clearInterval(countdownInterval);
                $('.countdown').text('Habis! Redirect to Next Page');
                
                $.ajax({
                    url: '/simpan-jawaban',
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Waktu Habis',
                            text: `Selamat Anda telah menyelesaikan Kuis`,
                        })
                        window.location.href = '/pembahasan/' + response.materi_id
                        console.log('Times up, Form Submitted');
                    },
                    error: function(xhr, status, error) {
                        console.error('Form data submission failed:', error);
                    }
                });
                return;
            }

            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            $('.countdown').text(minutes + ' minutes, ' + seconds + ' seconds');

            $.ajax({
                url: '/countdown',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                data: {
                    countdown_value: Math.floor(timeRemaining / 1000)
                },
                success: function(response) {
                    console.log('Countdown value stored in session via controller.');
                },
                error: function(xhr, status, error) {
                    console.error('Error storing countdown value in session via controller: ' + error);
                }
            });
        }, 1000);
    })

</script>
@endpush