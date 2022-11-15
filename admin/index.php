<?php
session_start();
//path: admin\index.php
if (isset($_SESSION['role'])) {
 if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod') {
  include_once "partials/header.php";
  $target = isset($_GET['target']) ? $_GET['target'] : '';
  switch ($target) {
   case 'user':
    include "user/index.php";
    break;
   case 'profile':
    include "profile/index.php";
    break;
   case 'brand':
    include "brand/index.php";
    break;
   case 'category':
    include "category/index.php";
    break;
   case 'product':
    include "product/index.php";
    break;
   default:
    include "user/index.php";
  }
  include_once "partials/footer.php";
 } else {
  header('Location: sign-in.php');
 }

} else {
 header('Location: sign-in.php');
}
