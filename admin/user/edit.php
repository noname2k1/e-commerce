<?php
include_once '../../model/user.php';

if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $edit_able= true;
    $id = $_POST['id'];
    $fetch_user = get_user_by_id($id);
    if($_SESSION['role'] === 'mod' && ($fetch_user['role'] === 'admin' || $fetch_user['role'] === 'mod')){
        $edit_able = false;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if($edit_able) {
        $execute_result = update_user($id, $username, $password, $email, $role);
        if ($execute_result === true) {
            $users = get_all_user();
            echo json_encode($users);
        } else {
        if (str_contains((string) $execute_result, 'error')) {
            if (str_contains((string) $execute_result, 'Duplicate')) {
                $error_str = 'username or email exists!';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $execute_result);
            }

        }
    }
    } else {
        $error_str = 'You can not edit this user!';
        echo json_encode($error_str);
    }
}