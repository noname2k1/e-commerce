<?php
include_once 'model/utils.php';
include_once 'model/user.php';
include_once 'model/profile.php';
session_start();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cfpassword']) && isset($_POST['email'])) {
 $username   = $_POST['username'];
 $password   = $_POST['password'];
 $cfpassword = $_POST['cfpassword'];
 $email      = $_POST['email'];
 if ($password === $cfpassword) {
  $insert = user_register($username, $password, $cfpassword, $email, 'user');
  if ($insert === true) {
   $my_user = get_user_by_username_and_password($username, $password);
   save_user_to_session($my_user);
   $success_str = 'Sign up successfully!';
   echo json_encode($success_str);
  } else {
   if (str_contains((string)$insert, 'error')) {
    if (str_contains((string)$insert, 'Duplicate')) {
     $error_str      = 'infor already exists!';
     echo $errorjson = json_encode($error_str);
     die;
    } else {
     echo json_encode($insert);
     die;
    }
   }
  }
 } else {
  $error_str = 'password and confirm password not match!';
  echo json_encode($error_str);
 }
}
