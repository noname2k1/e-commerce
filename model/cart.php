<?php
include_once 'utils.php';
function get_all_products_from_cart_by_userid($id)
{
 $sql  = "SELECT * FROM cart WHERE userid = '{$id}'";
 $cart = pdo_fetch_one($sql);
 if ($cart != null) {
  if ($cart['data'] != null) {
   $cartArray        = json_decode($cart['data'], true);
   $sql              = "SELECT * FROM product WHERE id IN (" . implode(',', array_keys($cart)) . ")";
   $products_in_cart = pdo_fetch_all($sql);
  } else {
   return false;
  }
  return [
   'cart'     => $cartArray,
   'products' => $products_in_cart,

  ];
 } else {
  return false;
 }
}

function create_cart($userid)
{
 $sql    = "INSERT INTO cart(userid) VALUES ('{$userid}')";
 $result = pdo_execute($sql);
 return $result;
}

function update_cart_by_userid($id, $data)
{
 $sql    = "UPDATE cart SET data = '{$data}' where userid = '{$id}'";
 $result = pdo_execute($sql);
 return $result;
}