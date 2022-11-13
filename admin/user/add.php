<?php
session_start();
include_once '../../model/utils.php';
include_once '../../model/user.php';
include_once '../../model/profile.php';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mod')) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_SESSION['role'] === 'admin' ? $_POST['role'] : 'user';

    $create_user = add_user($username, $password, $email, $role);
    if ($create_user === true) {
        $fetch_newest_user_query = 'select * from user order by id desc limit 1';
        $newest_user = pdo_fetch_one($fetch_newest_user_query);
        //create profile for new user
        $default_avatar_link = 'https://res.cloudinary.com/ninhnam/image/upload/v1657259293/default_avatar/male_avatar_t0yrqe.png';
        $create_profile = add_profile($username,$default_avatar_link,'NULL',$newest_user['id']);
        if($create_profile === true){
            $users = get_all_user();
            echo json_encode($users);
        }
    } else {
        if (str_contains((string) $create_user, 'error') ) {
            if (str_contains((string) $create_user, 'Duplicate') ) {
                $error_str = 'username or email already exists!';
                echo json_encode($error_str);
            } else {
                echo json_encode((string) $create_user);
            }

        }
    }
}