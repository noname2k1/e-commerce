<?php
include_once '../../model/category.php';
session_start();
if (isset($_POST['id']) && isset($_POST['name']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $update = update_category($id, $name);
    if ($update === true) {
        $categories = get_all_category($fetch_query);
        echo json_encode($categories);
    } else {
        if (str_contains((string) $update, 'error')) {
            if (str_contains((string) $update, 'Duplicate')) {
                $error_str = 'category already exists!';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $update);
            }

        }
    }
}