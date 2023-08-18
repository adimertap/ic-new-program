<!doctype html>
<html lang="en">

<head>
    <title>
        @yield('name')
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,400;1,500;1,600&display=swap" rel="stylesheet"> --}}
        
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            /* font-family: Roboto; */
            margin: 0;
            padding: 0;
        }

        /* .certificate-container {
            width: 80vw;
            height: 100vh;
            display: flex !important;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        } */
        .certificate-container {
            width: 100vw;
            height: 100vh;
            position: relative;
        }

        /* .certificate {
            position: relative;
            background-image: url('snap_depan.jpg');
            background-position: center center;
            background-size: cover;
            width: 100%;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
            margin: 0;
        } */

        .certificate {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-image: url('snap_belakang.png');
            background-size: cover;
            width: 100%;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
            margin: 0;
            text-align: center;
        }
        .certificate:after {
            content: '';
            top: 0px;
            left: 0px;
            bottom: 0px;
            right: 0px;
            position: absolute;
            /* background-image: url(https://image.ibb.co/ckrVv7/water_mark_logo.png); */
            background-size: 100%;
            z-index: -1;
        }

        .no-padding-margin {
            margin: 0;
            padding: 0;
        }
        .content{
            margin-top: 100px;
            padding-left: 120px;
            padding-right: 120px;
        }
        .judul{
            font-size: 35px;
            font-weight: 400;
            margin-bottom: 0;
            text-transform: uppercase;
        }
        .sub-judul{
            margin-top: 0;
            font-size: 33px;
            font-weight: 500;
            color: #cd194c;
        }
        .nomor{
            margin-top: 5px;
            font-size: 17px;
            font-weight: normal;
        }
        table {
            margin-top:15px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ffffff;
            text-align: center !important;
        }
        .number-cell {
           width: 2px !important; /* Adjust the width as needed */
       }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="certificate no-padding-margin">
            <div class="content">
                <p class="judul">NILAI UJIAN 
                    @if($cek->produk->nama_produk == 'seminar')
                    Seminar {{ $cek->kelas }}
                    @elseif($cek->produk->nama_produk == 'brevet-ab')
                    Brevet A&B
                    @elseif($cek->produk->nama_produk == 'brevet-c')
                    Brevet C
                    @else
                    Brevet
                    @endif
                </p>
                <p class="sub-judul">IC EDUCATION </p>
                <i class="nomor">Nomor: {{ $sertif->nomor }}</i>

                <table>
                    <thead>
                        <tr>
                            <th class="number-cell">NO</th>
                            <th style="width: 200px">MATERI</th>
                            <th style="width: 50px">NILAI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $item->description }}</td>
                            @if($item->peserta)
                            <td style="text-align: center">{{ $item->peserta->nilai_angka }} | {{ $item->peserta->nilai_abjad }}</td>
                            @else
                            <th colspan="3">Belum ambil</th>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                
        </div>
    </div>
</body>


</html>