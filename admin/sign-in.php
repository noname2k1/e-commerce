<?php
session_start();
// require_once '../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();
require_once '../model/user.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
 //check form
 $usr      = isset($_POST['username']) ? (string)$_POST['username'] : false;
 $pwd      = isset($_POST['password']) ? (string)$_POST['password'] : false;
 $username = $_POST['username'];
 $password = $_POST['password'];
 // query
 $user = get_user_by_username_and_password($usr, $pwd);
 if ($user && $user['username'] == $username) {
  echo "<script>document.addEventListener('DOMContentLoaded',function(){
            toastr.success('login successfuly, redirect to admin dashboard!','LOGIN SYSTEM',{timeOut:3000})
        })</script>";
  $_SESSION['id']   = $user['id'];
  $_SESSION['role'] = $user['role'];
  // header('Location: ');
  header('Refresh: 1; URL=index.php');
 } else {
  echo "<script>document.addEventListener('DOMContentLoaded',function(){
            toastr.error('login failed, please try again!','LOGIN SYSTEM',{timeOut:3000})
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
    <title>SIGNIN (management)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../assets/img/Chomerce - logo.svg" type="image/x-icon" />
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/grid/grid.css" />
    <link rel="stylesheet" href="../assets/css/auth/auth.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <section id="auth-container">
        <div class="auth-wrapper">
            <h1 class="title">Sign in (admin)</h1>
            <form method="POST">
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="username or email..." />
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="password" autocomplete="0" />
                </div>
                <button class="sign-in__button">Sign in</button>
                <button class="forgot-password__button">
                    Fogot password
                </button>
            </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    toastr.options.closeButton = true;
    toastr.options.closeMethod = 'fadeOut';
    toastr.options.closeDuration = 300;
    toastr.options.closeEasing = 'swing';
    </script>
</body>

</html>
