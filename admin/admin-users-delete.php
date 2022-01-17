<?php 
include('config.php');
$id = $_GET['ID'];
$sql = "DELETE FROM adminuser WHERE ID = {$id}";
mysqli_query($conn,$sql) or die("Delete query not running");
header('location: admins.php'); 
?>