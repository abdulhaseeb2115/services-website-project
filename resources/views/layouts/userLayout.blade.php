<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
    </script>

    <!-- main css file -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- custom css file -->
    <link rel="stylesheet" href="{{asset('css/user/layout.css')}}">

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
            <a href="{{url('/user/dashboard')}}"><i class="fa-solid fa-handshake-angle"></i> aid4home</a>
        </div>

        <nav class="navbar">
            <a href="{{url('/user/dashboard')}} " class="{{ (Request::path() == 'user/dashboard') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>

            <a href="{{url('/user/request')}} " class="{{ (Request::path() == 'user/request') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-cart-arrow-down"></i> Place Order
            </a>

            <a href="{{url('/user/history')}}" class="{{ (Request::path() == 'user/history') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-history"></i> History
            </a>

            <a href="{{url('/user/settings')}}" class="{{ (Request::path() == 'user/settings') ? 'navbar-active' : '' }}">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>

        <div class="logout">
            <a href="{{url('/user/logout')}}">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>

    </div>

    <!-- Pages -->
    @yield('content')

</body>

</html>