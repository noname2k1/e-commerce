<?php
include_once 'utils.php';
include_once 'product.php';
//cart
function get_cart_by_userid($userid)
{
 $sql  = "SELECT * FROM cart WHERE userid = '{$userid}'";
 $cart = pdo_fetch_one($sql);
 return $cart;
}

function create_cart($userid)
{
 $sql    = "INSERT INTO cart(userid) VALUES ('{$userid}')";
 $result = pdo_execute($sql);
 return $result;
}

//cart_item

function get_all_cart_item_of_cart($cart_id)
{
 $sql        = "SELECT * FROM cart_item WHERE cart_id = '{$cart_id}'";
 $cart_items = pdo_fetch_all($sql);
 if (!$cart_items || $cart_items == null) {
  return null;
 }
 $result = [];
 if (is_array($cart_items)) {
  foreach ($cart_items as $cart_item) {
   $product = get_product_by_id($cart_item['product_id']);
   if ($product) {
    $product['cart_item_id'] = $cart_item['id'];
    $product['quantity']     = $cart_item['quantity'];
    $product['color']        = $cart_item['color'];
    $product['size']         = $cart_item['size'];
    $result[]                = $product;
   }
  }
  return $result;
 }
}

function get_all_cart_items_by_userid($userid)
{
 $cart = get_cart_by_userid($userid);
 if (!$cart || $cart == null) {
  return null;
 }
 $cart_id = $cart['id'];
 return get_all_cart_item_of_cart($cart_id);
}

function add_cart_item($cart_id, $product_id, $color, $size, $quantity)
{
 $sql    = "INSERT INTO cart_item(product_id,color,size,quantity,cart_id) VALUES ('{$product_id}','{$color}','{$size}','{$quantity}','{$cart_id}')";
 $result = pdo_execute($sql);
 return $result;
}

function update_quantity__cart_item($id, $quantity)
{
 $sql    = "UPDATE cart_item SET quantity = {$quantity} where id = '{$id}'";
 $result = pdo_execute($sql);
 return $result;
}

function delete_cart_item($id)
{
 $sql    = "DELETE FROM cart_item WHERE id = '{$id}'";
 $result = pdo_execute($sql);
 return $result;
}