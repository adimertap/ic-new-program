<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ICEDUCATION - USER</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/ic-bulet.png')}}" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/b8880a1207.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

    @include('user.includes.styles')

    <!-- addon-style -->
    @stack('addon-style')

</head>

<body id="page-top">
    <div id="wrapper">
        @if (Request::segment(1) != 'soal' && Request::segment(1) != 'soal-rules')
          @include('user.includes.sidebar')
        @endif
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('user.includes.topbar')
                @yield('content')
            </div>
            @include('user.includes.footer')
        </div>
    </div>
    @include('user.includes.script')
    @stack('addon-script')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>

</html>
