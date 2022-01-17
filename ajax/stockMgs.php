<?php
    include("../admin/config.php");
    $productId = $_POST['productId'];
    $productCategory = $_POST['categoryName'];

    $sql = "SELECT NUMBEROFPRODUCT from {$productCategory} WHERE ID = {$productId}";
    $result = mysqli_query($conn, $sql) or die("Select query is not running");
    $row = mysqli_fetch_assoc($result);
    echo $row['NUMBEROFPRODUCT'];
?>