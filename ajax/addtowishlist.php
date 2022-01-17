<?php
    include("../admin/config.php");
    $productCategory = $_POST['categoryName'];
    $productId = $_POST['productId'];
    session_start();

    $tablename = "normaluser_wishlist_".$_SESSION['ID'];

    $output = "";

    $sql = "SELECT * FROM $tablename WHERE PRODUCTCATEGORY = '{$productCategory}' AND PRODUCTID = '{$productId}'";
    $result = mysqli_query($conn, $sql) or die("First query is not running");
    if(mysqli_num_rows($result) > 0){
        $output = "Already Present In Your Wishlist";
    }else{
        $sql = "INSERT INTO $tablename(PRODUCTCATEGORY,PRODUCTID) VALUES('{$productCategory}','{$productId}')";
        $result = mysqli_query($conn,$sql) or die("Second query is not running");
        $output = "Added Successfully.";
    }

    echo $output;
?>