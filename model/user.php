<?php
include_once 'utils.php';
include_once 'profile.php';
// Path: model\user.php
function get_user_by_username_and_password($username, $password)
{

 $sql  = "SELECT * FROM user WHERE username = '{$username}'";
 $user = pdo_fetch_one($sql);
 if ($user) {
  if (password_verify($password, $user['password'])) {
   return $user;
  }
 }
 return false;
}

function user_register($username, $password, $cfpassword, $email, $role)
{
 if ($cfpassword !== $password) {
  return false;
 }
 $options = [
  'cost' => 12,
 ];
 $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
 $sql           = "INSERT INTO user(username,email,password,role,isActivate) VALUES('{$username}','{$email}','{$password_hash}','{$role}','0')";
 $create_user   = pdo_execute($sql);
 if ($create_user !== true) {
  return $create_user;
 }
 $user = get_user_by_username_and_password($username, $password); //get last insert user
 if (is_array($user)) {
  $avatar_default = 'https://res.cloudinary.com/ninhnam/image/upload/v1657259293/default_avatar/male_avatar_t0yrqe.png';
  $sql            = "INSERT INTO profile(name, img, phone, userid) VALUES ('{$user['username']}','{$avatar_default}','NULL', '{$user['id']}')";
  $result         = pdo_execute($sql);
  return $result;
 } else {
  return false;
 }
}

function get_all_user()
{
 $sql    = "SELECT * FROM user";
 $result = pdo_fetch_all($sql);
 return $result;
}

function get_user_by_id($id)
{
 $sql    = "SELECT * FROM user WHERE id = '{$id}'";
 $result = pdo_fetch_one($sql);
 return $result;
}

function add_user($username, $password, $email, $role)
{
 $options = [
  'cost' => 12,
 ];
 $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
 $sql           = "INSERT INTO user(username,email,password,role,isActivate) VALUES('{$username}','{$email}','{$password_hash}','{$role}','0')";
 $result        = pdo_execute($sql);
 return $result;
}
function update_user($id, $username, $password, $email, $role)
{
 $options = [
  'cost' => 12,
 ];
 $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
 $sql           = "UPDATE user SET username = '{$username}', email = '{$email}', password = '{$password_hash}', role = '{$role}' where id = '{$id}'";
 $result        = pdo_execute($sql);
 return $result;
}
function delete_user($id)
{
 $sql    = "DELETE FROM user WHERE id = '{$id}'";
 $result = pdo_execute($sql);
 return $result;
}

function user_logout($page_redirect_to)
{
 session_destroy();
 setcookie('user', '', time() - 3600, '/');
 header("location: " . $page_redirect_to . " ");
}