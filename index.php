<?php
//path: index.php
if(isset($_POST['logout']) && $_POST['logout']) {
    session_destroy();
    header('Location: sign-in.php');
}
include_once "includes/partials/header.php";

if(isset($_GET['rdt']) && $_GET['rdt']) {
    $rdt = $_GET['rdt'];
    switch($rdt) {
        case 'product-detail':
            include_once "includes/product/product-detail.php";
            break;
        default:
            include_once "includes/home.php";
            break;
    }

}
else {
    include_once "includes/home.php";
}
include_once "includes/partials/footer.php";
?>