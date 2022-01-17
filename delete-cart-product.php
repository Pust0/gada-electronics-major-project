<?php
    include("admin/config.php");
    $userid = $_GET['USERID'];
    $productId = $_GET['ID'];

    $tablename = "normaluser_cart_".$userid;

    $sql = "DELETE FROM {$tablename} WHERE ID = {$productId}";

    mysqli_query($conn, $sql) or die("Query not running");

    header("location: cart.php?ID=".$userid);
?>