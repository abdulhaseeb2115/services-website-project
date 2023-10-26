<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- main css file -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- custom css file -->
    <link rel="stylesheet" href="{{asset('css/worker/layout.css')}}">

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
            <a href="{{url('/worker/dashboard')}}"><i class="fa-solid fa-handshake-angle"></i></a>
        </div>

        <nav class="navbar">
            <a href="{{url('/worker/dashboard')}} " class="{{ (Request::path() == 'worker/dashboard') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
            </a>

            <a href="{{url('/worker/history')}}" class="{{ (Request::path() == 'worker/history') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-history"></i>
            </a>

            <a href="{{url('/worker/settings')}}" class="{{ (Request::path() == 'worker/settings') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-gear"></i>
            </a>
        </nav>

        <div class="logout">
            <a href="{{url('/worker/logout')}}">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>

    </div>

    <!-- Pages -->
    @yield('content')

</body>

</html>