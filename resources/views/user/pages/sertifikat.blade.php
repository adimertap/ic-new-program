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
            background-image: url('snap_depan.jpg');
            background-size: cover;
            width: 100%;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
            margin: 0;
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

        .content {
            margin-top: 345px;
            text-align: center;
            text-align: center;
        }

        .number {
            text-weight: 700;
            font-size: 21px;
            margin-left: 100px;
            margin-bottom: 10px !important;
        }

        .body-content {
            margin-left: 275px;
        }

        .this {
            font-size: 20px;
            font-weight: lighter;
            /* font-family: 'Fredoka', sans-serif; */
            margin-top: 0 !important;
        }

        .name {
            font-size: 34px;
            font-style: italic;
            padding: 5px 5px 5px 0px !important;
            margin-top: 10px !important;
            margin-bottom: 10px !important;

        }

        .sukses {
            font-size: 20px;
            line-height: 30px;
            font-weight:lighter;
            /* font-family: 'Montserrat', sans-serif; */
            margin-bottom: 0;

        }

        .tes {
            padding: 0px 150px 10px 0px !important;
        }

        .tanggal {
            font-size: 20px;
            line-height: 30px;
            font-weight:lighter;
            /* font-family: 'Montserrat', sans-serif; */
            margin-top: 0;
        }

        .ttd {
            z-index: 11;
            position: absolute; /* Use absolute positioning for precise placement */
            bottom: 100px;
            margin-right: 215px;
            float: right
        }

        .image-container {
            z-index: 99;
            margin-top: 200px;
        }

        .text-container {
            z-index: 1;
            margin-right: 30px;
            /* Adjust margin as needed */
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="certificate no-padding-margin">
            <div class="content">
                <p class="number">NUMBER : <i style="font-weight: 700">
                        @if($sertif->request == 2)
                        {{ $sertif->nomor }}
                        @else
                        -
                        @endif
                    </i></p>
            </div>
            <div class="body-content">
                <p class="this">This Certifies That:</p>

                <p class="name">{{ $user->name }}</p>
                <div class="tes">
                    <p class="sukses">has successfully completed and Passed this course of <b>
                        @if($cek->produk->nama_produk == 'seminar')
                        Seminar {{ $cek->kelas }}
                        @elseif($cek->produk->nama_produk == 'brevet-ab')
                        Brevet Pajak Terapan A dan B
                        @elseif($cek->produk->nama_produk == 'brevet-c')
                        Brevet Pajak C
                        @else
                        Brevet
                        @endif
                    </b>
                      
                        Provided by IC Education Held in
                    </p>
                </div>

                <p class="tanggal">This course applied on: <i> {{ date('j F Y', strtotime($cek->created_at)) }}</i> </p>
                @if($sertif->request == 2)
                    {{-- <img src="{{ url('/tandatangan/'.$ttd->gambar) }}" class="ttd" width="170" height="120" alt=""> --}}
                    <img src="{{ public_path('/tandatangan/'.$ttd['gambar']) }}" class="ttd" width="170" height="120" alt="">

                @endif


            </div>

        </div>
    </div>
</body>

</html>