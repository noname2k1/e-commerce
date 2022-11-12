<?php
include_once '../../model/user.php';
include_once '../../model/profile.php';


if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $delete_able = true;
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    if($_SESSION['role'] === 'mod' && ($_POST['role'] === 'admin' || $_POST['role'] === 'mod') || $_SESSION['id'] === $id){
        $delete_able = false;
    }
    $role = $_POST['role'];
    // echo $id, $username, $password, $email, $role;
    if($delete_able){
        $delete_profile = delete_profile_by_userid($id);
        $execute_result = delete_user($id);
        if ($execute_result === true && $delete_profile === true) {
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
    }else{
        $error_str = 'You can not delete this user!';
        echo json_encode($error_str);
    }
}