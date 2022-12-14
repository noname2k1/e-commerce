<?php
include_once '../../model/product.php';
session_start();
if (isset($_POST['name']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
 $name             = $_POST['name'];
 $price            = $_POST['price'];
 $size             = $_POST['size'];
 $color            = $_POST['color'];
 $img              = $_POST['img'];
 $specs            = $_POST['specs'];
 $description      = $_POST['description'];
 $quantity         = $_POST['quantity'];
 $discount_percent = $_POST['discount_percent'];
 $category_id      = $_POST['category_id'];
 $brand_id         = $_POST['brand_id'];
 $desc_and_specs   = [
  'description' => $description,
  'specs'       => $specs,
 ];
 $display = 1;
 if ($_SESSION['role'] === 'mod') {
  $display = 0;
 }
 $insert = add_product($name, $price, $size, $color, $img, json_encode($desc_and_specs, JSON_UNESCAPED_UNICODE), $quantity, $discount_percent, $category_id, $brand_id, $display);
 if ($insert === true) {
  $products = isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ? get_all_product() : get_all_product_by_mod();
  echo json_encode($products);
 } else {
  if (str_contains((string)$insert, 'error')) {
   if (str_contains((string)$insert, 'Duplicate')) {
    $error_str = 'infor already exists!';
    echo json_encode($error_str);
   } else {
    echo json_encode((string)$insert);
   }

  }
 }
}