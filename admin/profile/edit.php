<?php
include_once '../../model/utils.php';

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['img']) && isset($_POST['phone']) && isset($_POST['userid']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $img = $_POST['img'];
    $phone = $_POST['phone'];
    $userid = $_POST['userid'];
    if($_SESSION['profile_id'] == $id && $_SESSION['id'] == $userid || $_SESSION['role'] === 'admin') {
        $fetch_query = 'select * from profile order by updatedAt desc';
        $update_query = "update profile set name = '{$name}', img = '{$img}', phone = '{$phone}' where id = '{$id}' AND userid = '{$userid}'";
        $update = pdo_execute($update_query);
        if ($update === true) {
            $brands = pdo_fetch_all($fetch_query);
            echo json_encode($brands);
        } else {
            if (str_contains((string) $update, 'error')) {
                if (str_contains((string) $update, 'Duplicate')) {
                    $error_str = 'infor already exists!';
                    echo json_encode($error_str);
                } else {
                    echo json_encode((string) $update);
                }
    
            }
        }
    } else {
        $error_str = 'You are not allowed to edit this profile!';
        echo json_encode($error_str);
    }
}