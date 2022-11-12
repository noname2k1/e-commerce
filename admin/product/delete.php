<?php
include_once '../../model/product.php';

if (isset($_POST['id']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $id=$_POST['id'];

    $delete = delete_product($id);
    if ($delete === true) {
        $products = get_all_product();
        echo json_encode($products);
    } else {
        if (str_contains((string) $delete, 'error')) {
            if (str_contains((string) $delete, 'Duplicate')) {
                $error_str = 'products...';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $delete);
            }

        }
    }
}