<?php
//connect to PDO
include_once 'profile.php';
$status = "prod";
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

function save_user_to_session($user)
{
 //save user info to session
 $_SESSION['user']      = $user;
 $profile               = get_profile_by_userid($user['id']);
 $_SESSION['profileid'] = $profile['id'];
 $_SESSION['id']        = $user['id'];
 $_SESSION['role']      = $user['role'];
 $_SESSION['name']      = $profile['name'];
}
