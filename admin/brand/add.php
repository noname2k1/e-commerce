<?php
include_once '../../model/brand.php';

if (isset($_POST['name']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $name = $_POST['name'];

    $insert = add_brand($name);
    if ($insert === true) {
        $brands = get_all_brand();
        echo json_encode($brands);
    } else {
        if (str_contains((string) $insert, 'error') ) {
            if (str_contains((string) $insert, 'Duplicate') ) {
                $error_str = 'name already exists!';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $insert);
            }

        }
    }
}