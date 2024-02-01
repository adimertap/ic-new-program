
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>Admin | @yield('title')</title>

    @include('pemateri.includes.styles')
    @stack('css')

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/ic-bulet.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/ic-bulet.png')}}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>
    <div class="app align-content-stretch d-flex flex-wrap">

        @include('pemateri.includes.sidebar')

        <div class="app-container">
            
            @include('pemateri.includes.topbar')
            @yield('content')

        </div>
    </div>
    
    <!-- Javascripts -->
    @include('pemateri.includes.scripts')
    @stack('js')

</body>
</html>