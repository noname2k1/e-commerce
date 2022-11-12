<?php
session_start();
echo $_SERVER['HTTP_HOST'];
echo $_SERVER['REQUEST_URI'];
    if(isset($_POST['username']) && isset($_POST['password']) &&isset($_POST['cfpassword']) &&isset($_POST['email']) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];
        $email = $_POST['email'];
        if($password === $cfpassword) {
            $insert = add_user($username, $password, $email, 'user');
            if ($insert === true) {
                echo "<script>document.addEventListener('DOMContentLoaded',function(){
                    toastr.success('register successfuly','REGISTER SYSTEM',{timeOut:3000})
                })</script>";
                header('Refresh: 1; URL=index.php');
            } else {
                if (str_contains((string) $insert, 'error') ) {
                    if (str_contains((string) $insert, 'Duplicate') ) {
                        $error_str = 'infor already exists!';
                        echo json_encode($error_str);
                    } else {
                        echo json_encode((string) $insert);
                    }
                }
                
            }
        } else {
            $error_str = 'password and confirm password not match!';
            echo json_encode($error_str);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIGN UP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/grid/grid.css" />
    <link rel="stylesheet" href="assets/css/auth/auth.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <section id="auth-container">
        <div class="auth-wrapper">
            <h1 class="title">Sign up <a href="index.php" class="go-home">
                    <img src="assets/img/come-back.svg" alt="thuong-mai-dien-tu">Home
                </a></h1>
            <form action="" method="POST" id='crud'>
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="username" />
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="password" autocomplete="0" />
                </div>
                <div class="form-group">
                    <input type="password" name="cfpassword" id="cfpassword" placeholder="confirm password"
                        autocomplete="0" />
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="email" />
                </div>
                <button class="sign-in__button">Sign up</button>
            </form>
            <a href="sign-in.php" class="sign-up__button">Sign in</a>
            <p>or</p>
            <a class="social-login__button">
                <img src="assets/img/google-icon.svg" alt="thuong-mai-dien-tu" />Continue with Google
            </a>
            <a class="social-login__button">
                <img src="assets/img/facebook-icon.svg" alt="thuong-mai-dien-tu" />Continue with Facebook
            </a>
            <a class="social-login__button">
                <img src="assets/img/apple-icon.svg" alt="thuong-mai-dien-tu" />Continue with Apple
            </a>
        </div>
        <div class="toast-container top-0 end-0 p-3">
            <div role="alert" aria-live="assertive" aria-atomic="true"
                class="toast align-items-center text-bg-success border-0"></div>
        </div>
        <div class="toast-container top-0 end-0 p-3">
            <div role="alert" aria-live="assertive" aria-atomic="true"
                class="toast align-items-center text-bg-danger border-0">
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="assets/js/execute.js"></script>
    <script src="assets/js/Toast.js"></script>
    <script src="assets/js/validate.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        validateForm(
            function() {
                ajaxCallPOST(
                    '', {
                        username: $('#username').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        cfpassword: $('#cfpassword').val()
                    },
                    function(data) {

                    }
                )
            }
        )
    })
    </script>
</body>

</html>