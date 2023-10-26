<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- main css file -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- custom css file -->
    <link rel="stylesheet" href="{{asset('css/admin/layout.css')}}">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/579cfae55e.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <title>aid4home</title>
</head>

<body>

    <!-- Side Nav -->
    <div class="sidenav">

        <div class="logo">
            <a href="{{url('/dashboard')}}"><i class="fa-solid fa-handshake-angle"></i></a>
        </div>

        <nav class="navbar">
            <a href="{{url('/dashboard')}}" class="{{ (Request::path() == 'dashboard') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
            </a>

            <a href="{{url('/requests')}}" class="{{ (Request::path() == 'requests') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-rotate"></i>
            </a>

            <a href="{{url('/workers')}}" class="{{ (Request::path() == 'workers') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </a>

            <a href="{{url('/category')}}" class="{{ (Request::path()=='category') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-circle-plus"></i>
            </a>

            <a href="{{url('/feedbacks')}}" class="{{ (Request::path()=='feedbacks') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-comment"></i>
            </a>
        </nav>

        <div class="settings">
            <a href="{{url('/settings')}}" class="{{ (Request::path()=='settings') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-gear"></i>
            </a>
        </div>

    </div>

    <!-- Pages -->
    @yield('content')

</body>

</html>