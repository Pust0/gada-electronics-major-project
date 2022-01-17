<?php
include('admin/config.php');
session_start();
if(!isset($_SESSION['EMAIL'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="customCss/index.css">
    <link rel="stylesheet" type="text/css" href="customCss/setting.css">
  </head>

  <body>
  <?php include('navbar.php');?>
  <div class="container bg-light" id="con">
    <h4 class="text-green">My Account</h4>

    <?php
        $id = $_GET['ID'];
        $sql = "SELECT * FROM normaluser WHERE ID = {$id}";
        $result = mysqli_query($conn, $sql) or die("Select query not running");
        while($row = mysqli_fetch_assoc($result)){
    ?>
    
    <div class="section-title"> <!-- staring of about section -->
        <h2>Basic Info</h2>       <!-- For line -->
    </div>   <!-- section title div -->

    <div class="personal-info-box">
        <p>User Name : <?php echo $row['NAME'];?></p>
        <p>Registered Email : <?php echo $row['EMAIL'];?></p>
        <p>Registered Phone Number : <?php echo $row['PHONE'];?></p>
    </div>

    <div class="section-title"> <!-- staring of about section -->
        <h2>Address Info</h2>       <!-- For line -->
    </div>   <!-- section title div -->

    <div class="address-info-box">
        <p>Address : <?php echo $row['ADDRESS'];?></p>
        <p>City : <?php echo $row['CITY'];?></p>
        <p>Pincode : <?php echo $row['PINCODE'];?></p>
        <p>State : <?php echo $row['STATE'];?></p>
        <p>Country : <?php echo $row['COUNTRY'];?></p>
    </div>

    <?php } ?>
  </div>
  
  <br>
  <?php include('footer.php');?> 

  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
  </body>
</html>