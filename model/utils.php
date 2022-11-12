<?php
//connect to PDO
function connect_to_mysql_using_PDO()
{
    $db_localhost = "o2olb7w3xv09alub.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $db_name = "mvxw697fpl0bwu4d";
    $db_user = "lsh6t63uwmzzjta8";
    $db_pass = "cfn9xj3igrnl9hbl";
    $db_port = "3306";
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