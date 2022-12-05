<?php
include_once 'model/user.php';
include_once 'model/utils.php';
session_start();
if (isset($_COOKIE['user'])) {
 parse_str($_COOKIE['user'], $user);
 save_user_to_session($user, true);
}
if (isset($_SESSION['expire'])) {
 if ($_SESSION['expire'] < time()) {
  session_destroy();
  header('Location: sign-in.php');
 }
}

//path: index.php
if (isset($_POST['logout']) && $_POST['logout']) {
 user_logout('sign-in.php');
}
include_once "includes/partials/header.php";

if (isset($_GET['target']) && $_GET['target']) {
 $target = $_GET['target'];
 switch ($target) {
  case 'product-detail':
   include_once "includes/product/product-detail.php";
   break;
  case 'cart':
   include_once "includes/cart.php";
   break;
  default:
   include_once "includes/home.php";
   break;
 }

} else {
 include_once "includes/home.php";
}
include_once "includes/partials/footer.php";