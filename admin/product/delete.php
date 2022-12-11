<?php
include_once '../../model/product.php';
session_start();
if (isset($_POST['id']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
 $id = $_POST['id'];

 $delete = delete_product($id);
 if ($delete === true) {
  $products = isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ? get_all_product() : get_all_product_by_mod();
  echo json_encode($products);
 } else {
  if (str_contains((string)$delete, 'error')) {
   if (str_contains((string)$delete, 'Duplicate')) {
    $error_str = 'products...';
    echo json_encode($error_str);
   } else {
    echo json_encode((string)$delete);
   }

  }
 }
}