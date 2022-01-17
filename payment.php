<?php
    /* Tell mysqli to throw an exception if an error occurs */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    include("admin/config.php");
    
    $productCategory = $_GET['CATEGORY'];
    $productId = $_GET['ID'];

    session_start();
    $_SESSION['CATEGORY'] = $productCategory;
    $_SESSION['PRODUCTID'] = $productId;

    $sql = "SELECT NUMBEROFPRODUCT FROM {$productCategory} WHERE ID = '{$productId}'";
    $result = mysqli_query($conn, $sql) or die("first query not running");
    $row = mysqli_fetch_assoc($result);
    if($row['NUMBEROFPRODUCT'] > 0){
        $sql = "UPDATE {$productCategory} SET NUMBEROFPRODUCT = NUMBEROFPRODUCT - 1 WHERE ID = {$productId}";
        $result = mysqli_query($conn, $sql) or die("second query not running");
        header("location: PaytmKit/TxnTest.php?CATEGORY=".$productCategory."&PRODUCTID=".$productId);
    }else{
        header("location: card-details.php?CATEGORY=".$productCategory."&ID=".$productId);
    }
?>