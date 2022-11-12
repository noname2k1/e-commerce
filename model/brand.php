<?php 
include_once 'utils.php';
// Path: model\brand.php
function get_all_brand()
{
    $sql = "SELECT * FROM brand";
    $result = pdo_fetch_all($sql);
    return $result;
}
function get_brand_by_id($id)
{
    $sql = "SELECT * FROM brand WHERE id = '{$id}'";
    $result = pdo_fetch_one($sql);
    return $result;
}
function add_brand($name)
{
    $sql = "INSERT INTO brand(name) VALUES ('{$name}')";
    $result = pdo_execute($sql);
    return $result;
}
function update_brand($id, $name)
{
    $sql = "UPDATE brand SET name = '{$name}' where id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
function delete_brand($id)
{
    $sql = "DELETE FROM brand WHERE id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
?>