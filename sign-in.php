<?php
session_start();
include_once 'model/user.php';
include_once 'model/profile.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = user_login($username, $password);
    isset($_POST['remember']) ? $remember = true : $remember = false;
    if ($user) {
        $_SESSION['user'] = $user;
        $profile = get_profile_by_userid($user['id']);
        $_SESSION['profileid'] = $profile['id'];
        $_SESSION['id'] =  $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $profile['name'];
        if ($remember) {
            setcookie('username', $username, time() + 3600 * 24 * 30);
            setcookie('password', $password, time() + 3600 * 24 * 30);
        }
        echo "<script>document.addEventListener('DOMContentLoaded',function(){
            toastr.success('login successfuly, redirect to homepage','LOGIN SYSTEM',{timeOut:3000})
        })</script>";
        header('Refresh: 1; URL=index.php');
    } else {
        echo "<script>document.addEventListener('DOMContentLoaded',function(){
            toastr.error('login failed, please try again!','LOGIN SYSTEM',{timeOut:2000})
        })</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>auth - page</title>
    <link rel="icon" href="./assets/img/Chomerce - logo.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/grid/grid.css" />
    <link rel="stylesheet" href="assets/css/auth/auth.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <section id="auth-container">
        <div class="auth-wrapper">
            <h1 class="title">Sign in <a href="index.php" class="go-home">
                    <img src="assets/img/come-back.svg" alt="thuong-mai-dien-tu">Home
                </a></h1>
            <form method="POST">
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="username or email..." />
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="password" autocomplete="0" />
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember" placeholder="remember" />
                    <label for="remember">Remember me</label>
                </div>
                <button class="sign-in__button">Sign in</button>
            </form>
            <a href="#" class="forgot-password__button">
                Fogot password
            </a>
            <a href="sign-up.php" class="sign-up__button">Sign up</a>
            <p>or</p>
            <a href="#" class="social-login__button">
                <img src="assets/img/google-icon.svg" alt="thuong-mai-dien-tu" />Continue with Google
            </a>
            <a href="#" class="social-login__button">
                <img src="assets/img/facebook-icon.svg" alt="thuong-mai-dien-tu" />Continue with Facebook
            </a>
            <a href="#" class="social-login__button">
                <img src="assets/img/apple-icon.svg" alt="thuong-mai-dien-tu" />Continue with Apple
            </a>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>