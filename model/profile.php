<?php
include_once 'utils.php';
// Path: model\profile.php
function get_profile_one($id)
{
    $sql = "SELECT * FROM profile WHERE id = '{$id}'";
    $result = pdo_fetch_one($sql);
    return $result;
}
function get_profile_by_userid($userid)
{
    $sql = "SELECT * FROM profile WHERE userid = '{$userid}'";
    $result = pdo_fetch_one($sql);
    return $result;
}
function get_profile_all()
{
    $sql = "SELECT * FROM profile";
    $result = pdo_fetch_all($sql);
    return $result;
}

function add_profile($name, $img, $phone, $userid) {
    $sql = "INSERT INTO profile(name, img, phone, userid) VALUES ('{$name}','{$img}','{$phone}', '{$userid}')";
    $result = pdo_execute($sql);
    return $result;
}
function update_profile($id, $name, $img, $phone, $userid)
{
    $sql = "UPDATE profile SET name = '{$name}', img = '{$img}', phone = '{$phone}', userid = '{$userid}' where id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
function delete_profile($id)
{
    $sql = "DELETE FROM profile WHERE id = '{$id}'";
    $result = pdo_execute($sql);
    return $result;
}
function delete_profile_by_userid($userid)
{
    $sql = "DELETE FROM profile WHERE userid = '{$userid}'";
    $result = pdo_execute($sql);
    return $result;
}
?>