<!DOCTYPE html>
<html lang="en" class="scroll-smooth no-scrollbar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/public/images/ic-bulet.png')}}" />
    <link rel="stylesheet" href="{{ asset('/public/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/new/css/main.css') }}" type="text/css">
    {{-- <link href="{{ asset('/public/assets/css/custom.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="{{ asset('/public/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2a6de0a323.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6a9458011a.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/public/js/scripts.js') }}"></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

<body style="background-color: {{ request()->segment(1) != 'checkout'  && request()->segment(1) != 'register-data' ? '#fafafa' : '#f3f3f3'  }}">
    @include('sweetalert::alert')
    {{-- header start --}}
    {{-- @include('home.includes.topbar') --}}
    @if(request()->segment(1) != 'checkout' && request()->segment(1) != 'payment' && request()->segment(1) != 'register-data' )
        @include('home.includes.navbar')
    @endif

    {{-- header selesai --}}

    {{-- content start--}}
    @yield('content')
    {{-- content selesai --}}

    
    @if(request()->segment(1) != 'checkout' && request()->segment(1) != 'payment' && request()->segment(1) != 'register-data' )
        @include('home.includes.footer')
    @endif

    @stack('js')
</body>

</html>