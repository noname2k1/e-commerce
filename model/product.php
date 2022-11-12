<?php 
include_once 'utils.php';
// Path: model\product.php
function get_product_by_id($id)
{
    $sql = "SELECT * FROM product WHERE id = '{$id}'";
    $result = pdo_fetch_one($sql);
    return $result;
}
function get_product_by_id_and_name($id, $name)
{
    $sql = "SELECT * FROM product WHERE id =  '{$id}' AND name = '{$name}'";
    $data = pdo_fetch_one($sql);
    if($data) {
        $current_price = $data['price'] - ($data['price'] * $data['discount_percent'] / 100);
        $seller = '';
        if($data['seller_id'] != null) {
            $seller = pdo_fetch_one("SELECT * FROM profile WHERE id = '{$data['seller_id']}'");
        }
        $description_and_specs = preg_replace('/[[:cntrl:]]/', '', $data['description_and_specs'] );
        $result = [
            'id' => $data['id'],
            'name' => $data['name'],
            'before_price' => $data['price'],
            'size' => $data['size'],
            'color' => $data['color'],
            'current_price' => $current_price,
            'discount_percent' => $data['discount_percent'],
            'seller' => $seller,
            'quantity' => $data['quantity'],
            'img' => $data['img'],
            'description_and_specs'=> $description_and_specs,
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
        ];
        return $result;
    }
}
function get_all_product()
{
    $sql = "SELECT * FROM product";
    $result = pdo_fetch_all($sql);
    return $result;
}

function get_product_by_limit($limit)
{
    $sql = "SELECT * FROM product LIMIT {$limit}";
    $result = pdo_fetch_all($sql);
    return $result;
}

function get_product_lastest_by_limit($limit)
{
    $sql = "SELECT * FROM product ORDER BY id DESC LIMIT {$limit}";
    $result = pdo_fetch_all($sql);
    return $result;
}

function add_product( $name, $price, $size, $color, $img, $description_and_specs, $quantity,$discount_percent, $category_id, $brand_id) {
    $profileid = isset($_SESSION['profileid']) ? $_SESSION['profileid'] : '';
    $sql = "INSERT INTO product(name,price,size,color,img,description_and_specs,quantity,discount_percent,seller_id,category_id,brand_id) VALUES ('{$name}','{$price}','{$size}','{$color}','{$img}','{$description_and_specs}','{$quantity}','{$discount_percent}','{$profileid}','{$category_id}','{$brand_id}')";
    $result = pdo_execute($sql);
    return $result;
}

function update_product($id, $name, $price, $size, $color, $img, $description_and_specs, $quantity,$discount_percent, $category_id, $brand_id)
{
    $sql = "UPDATE product SET name = '{$name}', price = '{$price}', size = '{$size}', color = '{$color}', img = '{$img}', description_and_specs = '{$description_and_specs}', quantity = '{$quantity}',discount_percent = '{$discount_percent}'. category_id = '{$category_id}', brand_id = '{$brand_id}' where id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}

function delete_product($id)
{
    $sql = "DELETE FROM product WHERE id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
?>