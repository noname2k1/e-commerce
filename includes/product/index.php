<?php
    include_once 'model/product.php';
    if(isset($_GET['product']) && isset($_GET['name'])){
        $id = $_GET['product'];
        $name = $_GET['name'];
        $product = get_product_by_id_and_name($id, $name);
    }
?>