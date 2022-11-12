<?php
include_once '../../model/category.php';

if (isset($_POST['name']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $name = $_POST['name'];

    $insert = add_category($name);
    if ($insert === true) {
        $categories = get_all_category();
        echo json_encode($categories);
    } else {
        if (str_contains((string) $insert, 'error')) {
            if (str_contains((string) $insert, 'Duplicate')) {
                $error_str = 'category already exists!';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $insert);
            }

        }
    }
}