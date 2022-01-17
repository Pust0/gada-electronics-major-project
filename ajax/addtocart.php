<?php
    include("../admin/config.php");
    $productCategory = $_POST['categoryName'];
    $productId = $_POST['productId'];
    session_start();

    $tablename = "normaluser_cart_".$_SESSION['ID'];

    // echo $tablename;
    // echo "<br>";
    // echo $productCategory;
    // echo "<br>";
    // echo $productId;

    $sql = "SELECT * FROM $tablename WHERE PRODUCTCATEGORY = '{$productCategory}' AND PRODUCTID = '{$productId}'";
    $result = mysqli_query($conn, $sql) or die("First query is not running");
    if(mysqli_num_rows($result) > 0){
        echo "Already Present In Your Cart";
    }else{
        $sql = "INSERT INTO $tablename(PRODUCTCATEGORY,PRODUCTID) VALUES('{$productCategory}','{$productId}')";
        $result = mysqli_query($conn,$sql) or die("Second query is not running");
        echo "Added Successfully.";
    }

?>