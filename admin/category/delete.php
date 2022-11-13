<?php
include_once '../../model/category.php';
session_start();
if (isset($_POST['id']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $id=$_POST['id'];
   
    $delete = delete_category($id);
    if ($delete === true) {
        $categories = get_all_category();
        echo json_encode($categories);
    } else {
        if (str_contains((string) $delete, 'error')) {
            if (str_contains((string) $delete, 'Duplicate')) {
                $error_str = 'category already exists!';
                echo json_encode($error_str);
            } else if(str_contains((string) $delete, 'foreign key constraint fails')) {
                echo json_encode('category is being used!');
            } else {
                echo json_encode((string) $delete);
            }
        }
    }
}