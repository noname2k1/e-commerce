<?php
include_once 'model/cart.php';
include_once 'model/utils.php';
$cart       = false;
$cart_items = false;
if (isset($_SESSION['id'])) {
 $id   = $_SESSION['id'];
 $cart = get_cart_by_userid($id);
 if (!$cart || $cart == null) {
  create_cart($id);
  $cart = get_cart_by_userid($id);
 }
 $total      = 0;
 $cart_items = get_all_cart_item_of_cart($cart['id']);
//  print_r($cart_items);
} else {
 echo "<script>alert('You are not logged in');window.location='sign-in.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/base.css" />
    <link rel="stylesheet" href="./assets/css/grid/grid.css" />
    <link rel="stylesheet" href="./assets/css/cart/cart.css" />
</head>

<body>
    <section id="cart-container" class="grid wide">
        <h1>
            <button class="mobile previous-page__button">
                <img src="./assets/img/arrow-left.svg" alt="thuong-mai-dien-tu" /></button>Shop cart
        </h1>
        <ul class="products-list">
            <?php
if (!$cart_items || $cart_items == null) {
 echo "<li class='product-item no-product'>
                    <div class='no-product'>No product found in shop cart. <a href='?target=product'>Add product.</a></div>
                </li>";
} else {
 foreach ($cart_items as $cart_item) {
  $raw_price = $cart_item['price'] * $cart_item['quantity'];
  $price     = format_currency($raw_price, 'đ', 'right');
  $size      = $cart_item['size'] == null || $cart_item['size'] == 0 ? false : $cart_item['size'];
  echo "<li class='product-item'>
        <input type='checkbox' name='productid' value='{$cart_item['cart_item_id']}' data-price='{$raw_price}'/>
        <img src='{$cart_item['img']}' alt='thương-mại-điện-tử-e-commerce' />
        <div class='product-info'>
            <h3 class='product-name'>{$cart_item['name']}</h3>
            <div class='infor'>
                <p class='product-price'>{$price}</p>
                <div class='quantity'>
                    <span class='num'>x{$cart_item['quantity']}</span>
                </div>
                <div class='specs'>" .
   "<span class='color'>color: {$cart_item['color']}</span>" . ($size ? "<span class='size'>size: {$size}</span>" : "") .
   "</div>
            </div>
        </div>
        <button class='delete-cart-item' data-cart-item-id='{$cart_item['cart_item_id']}'>X</button>
    </li>";
 }
}
?>

        </ul>
        <?php
if ($cart_items && $cart_items != null) {
 $total = format_currency($total, 'đ', 'right');
 echo "<div class='end-cart__element'></div>
            <div class='total'>
                <span class='total-num'>total: <span class='num'>{$total}</span></span>
                <button class='btn btn-primary'>Process to payment</button>
            </div>";
}
?>
    </section>
    <script src="assets/js/cart.js"></script>
</body>

</html>