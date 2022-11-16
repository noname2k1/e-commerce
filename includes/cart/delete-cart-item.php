<?php
include_once '../../model/cart.php';
session_start();
if (isset($_POST['cartItemId'])) {
 $delete_cart_item = delete_cart_item($_POST['cartItemId']);
 if ((string)$delete_cart_item && str_contains((string)$delete_cart_item, 'error')) {
  echo json_encode($delete_cart_item);
 }
 $get_cart_items = get_all_cart_items_by_userid($_SESSION['id']);
 echo json_encode($get_cart_items, JSON_UNESCAPED_UNICODE);
}