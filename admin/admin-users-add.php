<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
if(isset($_POST['ADD'])) {
       
       $name = $_POST['NAME'];
       $email = $_POST['EMAIL'];
       $password = $_POST['PASSWORD'];
       $repassword = $_POST['REPASSWORD'];

       if($password != $repassword){
            echo'<script type="text/javascript"> alert("Password does not matched.");
            window.location="admin-users-add.php" </script>';
       }
       
       $sql1 = "SELECT * FROM adminuser WHERE EMAIL = '{$email}'";
       $result = mysqli_query($conn,$sql1) or die("Select query not running");
       if(mysqli_num_rows($result)>0) {
          echo'<script type="text/javascript"> alert("An Account already exist with this Email-Id");
               window.location="admin-users-add.php" </script>';
        } else {
       $sql = "INSERT INTO adminuser(USERNAME,EMAIL,PASSWORD) values('{$name}','{$email}','{$password}')";
       mysqli_query($conn, $sql) or die("Insert Query not running");
       
       echo'<script type="text/javascript"> alert("Added Successfully");
               window.location="admin-users-add.php" </script>';

       }
 }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Users</title>]
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
    
    <style type="text/css">
	 body {
		 padding:0;
		 margin:0;
             }
        .container {
                 margin-top:88px;
                 max-width: 600px;
                 width: auto;
                 height:auto;
                 padding: 15px 20px;
       
             }             
    </style>
</head>
 <body class="bg-light">
 <?php include('navbar.php');?>

  <div class="container">
    <h1 style="color:#0c3">Add Admins</h1>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
       <div class="form-group">
          <label>Name *</label>
          <input type="text" class="form-control" name="NAME" placeholder="Name" required>
       </div>
       
       <div class="form-group">
          <label>Email Address *</label>
          <input type="email" class="form-control" name="EMAIL" placeholder="Email" required>
       </div>
       
       <div class="form-group">
          <label>Password *</label>
          <input type="password" class="form-control" name="PASSWORD" placeholder="Create Password" required>
       </div>

       <div class="form-group">
          <label>Confirm Password *</label>
          <input type="password" class="form-control" name="REPASSWORD" placeholder="Confirm Password" required>
       </div>
      
       <input type="submit" class="btn btn-info" value="Add" name="ADD">
     </form>
  </div>
</body>
</html>