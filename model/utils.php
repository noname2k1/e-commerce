<?php
//connect to PDO
function connect_to_mysql_using_PDO()
{
    $db_localhost = "ql-banhang.cajq2vqpa1ir.ap-northeast-3.rds.amazonaws.com";
    $db_name = "ecommerce";
    $db_user = "admin";
    $db_pass = "Nam123456";
    $port='3306';

    $pdo_conn = new PDO("mysql:host={$db_localhost};port={$port};dbname={$db_name}", $db_user, $db_pass);
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