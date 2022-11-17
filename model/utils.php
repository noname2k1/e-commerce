<?php
//connect to PDO
include_once 'profile.php';
include_once 'user.php';
$status = "dev";
function connect_to_mysql_using_PDO()
{
 global $status;
 if ($status == 'prod') {
  $db_localhost = "o2olb7w3xv09alub.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  $db_name      = "mvxw697fpl0bwu4d";
  $db_user      = "lsh6t63uwmzzjta8";
  $db_pass      = "cfn9xj3igrnl9hbl";
  $db_port      = "3306";
 } else {
  $db_localhost = "localhost";
  $db_name      = "ecommerce";
  $db_user      = "root";
  $db_pass      = "";
  $db_port      = "3306";
 }
 // mysql://lsh6t63uwmzzjta8:cfn9xj3igrnl9hbl@o2olb7w3xv09alub.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/mvxw697fpl0bwu4d
 $pdo_conn = new PDO("mysql:host={$db_localhost};port={$db_port};dbname={$db_name}", $db_user, $db_pass);
 $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 return $pdo_conn;
}
//fetch all using PDO
function pdo_fetch_all($query)
{
 $sql_arcs = array_slice(func_get_args(), 1);
 try {
  $conn = connect_to_mysql_using_PDO();
  $stmt = $conn->prepare($query);
  $stmt->execute($sql_arcs);
  $result = $stmt->fetchAll();
  return $result;
 } catch (PDOException $e) {
  return "error: " . $e->getMessage();
 } finally {
  // disconnect
  unset($conn);
 }

}
//fetch only one  using PDO
function pdo_fetch_one($query)
{
 $sql_arcs = array_slice(func_get_args(), 1);
 try {
  $conn = connect_to_mysql_using_PDO();
  $stmt = $conn->prepare($query);
  $stmt->execute($sql_arcs);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
 } catch (PDOException $e) {
  return "error: " . $e->getMessage();
 } finally {
  // disconnect
  unset($conn);
 }
}
// excute INSERT,UPDATE,DELETE
function pdo_execute($query)
{
 $sql_arcs = array_slice(func_get_args(), 1);
 try {
  $conn = connect_to_mysql_using_PDO();
  $stmt = $conn->prepare($query);
  $stmt->execute($sql_arcs);
  return true;
 } catch (PDOException $e) {
  return "error: " . $e->getMessage();
 } finally {
  // disconnect
  unset($conn);
 }
}

//get last insert id
function pdo_last_insert($table_name)
{
 try {
  $conn = connect_to_mysql_using_PDO();
  $stmt = $conn->prepare("SELECT * FROM {$table_name} ORDER BY id DESC LIMIT 1");
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
 } catch (PDOException $e) {
  return "error: " . $e->getMessage();
 } finally {
  // disconnect
  unset($conn);
 }
}

function save_user_to_session($user, $remember)
{
 //save user info to session
 $profile = get_profile_by_userid($user['id']);
 if (!$profile || $profile == null || (is_string($profile) && str_contains((string)$profile, 'error'))) {
  user_logout('sign-in.php');
 }
 $_SESSION['profileid'] = $profile['id'];
 $_SESSION['id']        = $user['id'];
 $_SESSION['role']      = $user['role'];
 $_SESSION['name']      = $profile['name'];
 $_SESSION['img']       = $profile['img'];
 if ($remember) {
  //save user info to cookie
  $data_to_save = "id={$user['id']}&profileid={$profile['id']}&role={$user['role']}&name={$profile['name']}&img={$profile['img']}";
  setcookie('user', $data_to_save, time() + 60 * 60 * 24 * 30, '/');
  //set session expire time for 30 days
  $days               = 30;
  $_SESSION['expire'] = time() + 60 * 60 * 24 * $days;
 } else {
  //set session expire time for 30 minutes
  $minutes            = 30;
  $_SESSION['expire'] = time() + 60 * $minutes;
 }
}

function format_currency($number, $currency = 'VND', $pos)
{
 $number = (float)$number;
 $number = number_format($number, 0, ',', '.');
 if ($pos == 'left') {
  return $currency . ' ' . $number;
 } else {
  return $number . ' ' . $currency;
 }
}