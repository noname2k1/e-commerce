<?php
include_once 'utils.php';
// path: model\category.php
function get_all_category()
{
    $sql = "SELECT * FROM category";
    $result = pdo_fetch_all($sql);
    return $result;
}

function get_category_by_id($id)
{
    $sql = "SELECT * FROM category WHERE id = '{$id}'";
    $result = pdo_fetch_one($sql);
    return $result;
}

function add_category($name)
{
    $sql = "INSERT INTO category(name) VALUES ('{$name}')";
    $result = pdo_execute($sql);
    return $result;
}

function update_category($id, $name)
{
    $sql = "UPDATE category SET name = '{$name}' where id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}

function delete_category($id)
{
    $sql = "DELETE FROM category WHERE id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
?>