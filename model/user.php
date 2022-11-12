<?php
include_once 'utils.php';
// Path: model\user.php
function user_login($username, $password)
{

    $sql = "SELECT * FROM user WHERE username = '{$username}'";
    $user = pdo_fetch_one($sql);
    if($user) {
        if(password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}

// function user_register($username, $password, $email, $fullname, $phone, $address)
// {
//     $sql = "INSERT INTO users(username, password, email, fullname, phone, address) VALUES(?, ?, ?, ?, ?, ?)";
//     $result = pdo_execute($sql, $username, $password, $email, $fullname, $phone, $address);
//     return $result;
// }

function get_all_user()
{
    $sql = "SELECT * FROM user";
    $result = pdo_fetch_all($sql);
    return $result;
}

function get_user_by_id($id)
{
    $sql = "SELECT * FROM user WHERE id = '{$id}'";
    $result = pdo_fetch_one($sql);
    return $result;
}

function add_user($username, $password, $email, $role)
{
    $options = [
        'cost' => 12,
    ];
    $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
    $sql = "INSERT INTO user(username,email,password,role,isActivate) VALUES('{$username}','{$email}','{$password_hash}','{$role}','0')";
    $result = pdo_execute($sql);
    return $result;
}
function update_user($id, $username, $password, $email, $role)
{
    $options = [
        'cost' => 12,
    ];
    $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
    $sql = "UPDATE user SET username = '{$username}', email = '{$email}', password = '{$password_hash}', role = '{$role}' where id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
function delete_user($id)
{
    $sql = "DELETE FROM user WHERE id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
?>