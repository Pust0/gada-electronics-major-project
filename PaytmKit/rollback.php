<?php
    include("../admin/config.php");
    session_start();
    if(!isset($_SESSION["EMAIL"])){
        header("location: ../index.php");
    }

    $productCategory = $_SESSION['CATEGORY'];
    $productId = $_SESSION['PRODUCTID'];
    $sql = "UPDATE {$productCategory} SET NUMBEROFPRODUCT = NUMBEROFPRODUCT + 1 WHERE ID = {$productId}";
    $result = mysqli_query($conn, $sql) or die("second query not running");
    echo "<b>Transaction status is failure</b>" . "<br/>";

    echo "<br><br>";
    echo '<button onclick=window.location.href="../index.php">Home</button>';
?>