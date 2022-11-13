<?php
include_once '../../model/brand.php';
session_start();
if (isset($_POST['id']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $id=$_POST['id'];
 
    $delete = delete_brand($id);
    if ($delete === true) {
        $brands = get_all_brand();
        echo json_encode($brands);
    } else {
        if (str_contains((string) $delete, 'error')) {
            if (str_contains((string) $delete, 'Duplicate')) {
                $error_str = 'brand already exists!';
                echo json_encode($error_str);
            } else if (str_contains((string) $delete, 'foreign')) {
                echo json_encode('brand is being used!');
            } else {
                echo json_encode((string) $delete);
            }

        }
    }
}