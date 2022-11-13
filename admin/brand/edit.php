<?php
include_once '../../model/brand.php';
session_start();
if (isset($_POST['id']) && isset($_POST['name']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $update = update_brand($id, $name);
    if ($update === true) {
        $brands = get_all_brand();
        echo json_encode($brands);
    } else {
        if (str_contains((string) $update, 'error')) {
            if (str_contains((string) $update, 'Duplicate')) {
                $error_str = 'brand already exists!';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $update);
            }

        }
    }
}