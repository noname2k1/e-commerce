<?php
session_start();
include_once '../../model/cart.php';
include_once '../../model/product.php';
// add to cart
if (isset($_POST['productid']) && isset($_POST['quantity']) && isset($_POST['color']) && isset($_POST['size']) && isset($_SESSION['id'])) {
 $my_cart = get_cart_by_userid($_SESSION['id']);
 if (empty($my_cart)) {
  create_cart($_SESSION['id']);
  $my_cart = get_cart_by_userid($_SESSION['id']);
 }
 $cart_id    = $my_cart['id'];
 $product_id = $_POST['productid'];
 $quantity   = $_POST['quantity'];
 $color      = $_POST['color'];
 $size       = $_POST['size'];
 json_encode($quantity);
 $add_cart_item = add_cart_item($cart_id, $product_id, $color, $size, $quantity);
 if ((string)$add_cart_item && str_contains((string)$add_cart_item, 'error')) {
  echo json_encode(false);
 }
//  patch_product('quantity', 'quantity' . ' - ' . $quantity, $product_id);
 $get_cart_items = get_all_cart_items_by_userid($_SESSION['id']);
 echo json_encode($get_cart_items, JSON_UNESCAPED_UNICODE);
} else {
 echo json_encode('You must login to use cart');
}