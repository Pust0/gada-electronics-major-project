<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
if(isset($_POST['ADD'])) {
       
       $name = $_POST['NAME'];
       $email = $_POST['EMAIL'];
       $mobile = $_POST['MOBILE'];
       $password = $_POST['PASSWORD'];
       
       $sql1 = "SELECT * FROM normaluser WHERE EMAIL = '{$email}'";
       $result = mysqli_query($conn,$sql1) or die("Select query not running");
       if(mysqli_num_rows($result)>0) {
          echo'<script type="text/javascript"> alert("An Account already exist with this Email-Id");
               window.location="users-add.php" </script>';
        } else {
       $sql = "INSERT INTO normaluser(NAME,EMAIL,PHONE,PASSWORD) values('{$name}','{$email}','{$mobile}','{$password}')";
       mysqli_query($conn, $sql) or die("Insert Query not running");
       header('location: users.php');
       }
 }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Users</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
</head>
 <body class="bg-light">
 <?php include('navbar.php');?>

  <div class="container" id="carouselCon">
    <h1>Add Users</h1>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
       <div class="form-group">
          <label>Name *</label>
          <input type="text" class="form-control" name="NAME" placeholder="Name" required>
       </div>
       
       <div class="form-group">
          <label>Email-Address *</label>
          <input type="email" class="form-control" name="EMAIL" placeholder="Email" required>
       </div>
       
       <div class="form-group">
          <label>Mobile Number *</label>
          <input type="text" class="form-control" name="MOBILE" placeholder="Contact Number" required>
       </div>
       
       <div class="form-group">
          <label>Password *</label>
          <input type="password" class="form-control" name="PASSWORD" placeholder="Create Password" required>
       </div>

      
       <input type="submit" class="btn btn-info" value="Add" name="ADD">
     </form>
  </div>
</body>
</html>