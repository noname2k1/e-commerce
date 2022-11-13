<?php
include_once '../../model/product.php';
session_start();
if (isset($_POST['id']) && isset($_POST['name']) &&
    isset($_POST['price']) && isset($_POST['size']) &&
    isset($_POST['color']) && isset($_POST['img']) &&
    isset($_POST['description']) && isset($_POST['category_id']) &&
    isset($_POST['brand_id']) && isset($_POST['quantity'])  &&
($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) 
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $img = $_POST['img'];
    $specs = $_POST['specs'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $discount_percent = $_POST['discount_percent'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $desc_and_specs = json_encode([
        'description' => $description,
        'specs' => $specs
    ],JSON_UNESCAPED_UNICODE);
    $update_query = '';
    //limit permission for moderator
    if($_SESSION['role'] === 'admin') {
        $update_query = "update product set name = '{$name}', price = '{$price}', size = '{$size}', color = '{$color}', img = '{$img}', description_and_specs = '{$desc_and_specs}',discount_percent='{$discount_percent}' ,quantity = '{$quantity}', category_id = '{$category_id}', brand_id = '{$brand_id}' where id = '{$id}'";
    } else if($_SESSION['role'] === 'mod') {
        $update_query = "update product set name = '{$name}', size = '{$size}', color = '{$color}', img = '{$img}', description_and_specs = '{$description_and_specs}' where id = '{$id}'";
    }
    $update = pdo_execute($update_query);
    if ($update === true) {
        $products = get_all_product();
        echo json_encode($products);
    } else {
        if (str_contains((string) $update, 'error')) {
            if (str_contains((string) $update, 'Duplicate')) {
                $error_str = 'Product...';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $update);
            }

        }
    }
}