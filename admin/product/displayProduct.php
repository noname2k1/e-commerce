<?php
include_once '../../model/product.php';
session_start();
if (isset($_POST['id']) && $_SESSION['role'] === 'admin') {
 $id      = $_POST['id'];
 $display = $_POST['display'];
 //limit permission for moderator
 $update_query = "update product set display = '{$display}' where id = '{$id}'";
 $update       = pdo_execute($update_query);
 if ($update === true) {
  $products = isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ? get_all_product() : get_all_product_by_mod();
  echo json_encode($products);
 } else {
  if (str_contains((string)$update, 'error')) {
   if (str_contains((string)$update, 'Duplicate')) {
    $error_str = 'Product...';
    echo json_encode($error_str);
   } else {
    echo json_encode((string)$update);
   }

  }
 }
}