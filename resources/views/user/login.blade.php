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
    <link rel="stylesheet" href="{{asset('css/user/login.css')}}">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/579cfae55e.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <title>aid4home</title>
</head>


<body>
    <div class="main-container">
        <div class="center-container">

            <!-- cover -->
            <div class="cover">
                <h1 class="cover-heading">aid4home
                    <br>
                    <small>A few clicks is all it takes.</small>
                </h1>
                <button class="change-login">Register</button>
            </div>


            <!-- user -->
            <div class="user-half">

                <!-- heading -->
                <h2 class="heading">User Login ...</h2>
                <!-- form -->
                <form action="/userLogin" method="POST">
                    @csrf
                    <!-- email -->
                    <div class="group">
                        <input type="text" name="email" id="email" placeholder="Email">
                    </div>
                    <!-- password -->
                    <div class="group">
                        <div class="password-input">

                            <input type="password" class="password" name="login_password" id="login_password" placeholder="Password">

                            <!-- show/hide -->
                            <div class="show-hide">
                                <i class="fa fa-eye-slash eye-icon fa-sm" aria-hidden="true"></i>
                            </div>

                        </div>
                    </div>

                    <!-- error -->
                    <div class="error-message" id="sError">
                        @if(isset($error))
                        {{$error}}
                        @endif
                    </div>

                    <!-- login -->
                    <button type="submit" class="login-btn" name="user-login">Login</button>

                </form>
            </div>


            <!-- register -->
            <div class="register-half">
                <h2 class="heading">User Registration ...<br></h2>
                </h2>

                <!-- form -->
                <form action="/userRegister" method="POST">
                    @csrf
                    <!-- name -->
                    <div class="group">
                        <input type="text" name="name" id="name" placeholder="Name">
                    </div>
                    <!-- email -->
                    <div class="group">
                        <input type="text" name="email" id="email" placeholder="Email">
                    </div>
                    <!-- phone -->
                    <div class="group">
                        <input type="text" name="phone" id="phone" placeholder="Phone">
                    </div>
                    <!-- address -->
                    <div class="group">
                        <input type="text" name="address" id="address" placeholder="Address">
                    </div>
                    <!-- password -->
                    <div class="group">
                        <div class="password-input">
                            <input type="password" class="password" name="register_password" id="register_password" placeholder="Password">
                            <!-- show/hide -->
                            <div class="show-hide">
                                <i class="fa fa-eye-slash eye-icon  fa-sm" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>

                    <!-- error -->
                    <div class="error-message" id="tError">
                        @if(isset($error))
                        {{$error}}
                        @endif
                    </div>

                    <!-- login -->
                    <button type="submit" class="login-btn">Register</button>

                </form>
            </div>



        </div>
    </div>






    <!-- cover / nav -->
    <script>
        $(".show-hide").click(function() {

            $(".eye-icon").toggleClass("fa-eye");
            $(".eye-icon").toggleClass("fa-eye-slash");

            if ($(".password").attr("type") == "password") {
                $(".password").attr("type", "text");
            } else if ($(".password").attr("type") == "text") {
                $(".password").attr("type", "password");
            }
        });

        $var = 0;

        $(".change-login").click(function() {
            if ($var == 0) {
                $(".error-message").html("");

                $(".cover").animate({
                    'margin-left': '0%'
                });
                $(".change-login").html("user Login");
                setTimeout(() => {
                    $(".cover").css("border-radius", "0px");
                    $(".cover").css("border-bottom-left-radius", "20px");
                    $(".cover").css("border-top-left-radius", "20px");
                }, 300);

                $var = 1;
            } else {
                $(".error-message").html("");

                $(".cover").animate({
                    'margin-left': '50%'
                });
                $(".change-login").html("register Login");
                setTimeout(() => {
                    $(".cover").css("border-radius", "0px");
                    $(".cover").css("border-bottom-right-radius", "20px");
                    $(".cover").css("border-top-right-radius", "20px");
                }, 300);
                $var = 0;
            }
        });
    </script>

</body>

</html>