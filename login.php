<?php
include('admin/config.php');
if(isset($_POST['login']))  {
    
     $email = $_POST['EMAIL'];
     $password = $_POST['PASSWORD'];
     
            $sql = "SELECT * FROM normaluser WHERE EMAIL = '{$email}'&& PASSWORD = '{$password}'";
            $result = mysqli_query($conn,$sql) or die("Select query not running");
            if(mysqli_num_rows($result)==1) {
              while($row = mysqli_fetch_assoc($result)) {
                  session_start();
                  $_SESSION['ID'] = $row['ID'];
                  $_SESSION['NAME'] = $row['NAME'];
                  $_SESSION['EMAIL'] = $row['EMAIL'];
                  $_SESSION['PHONE'] = $row['PHONE'];           
              }
              header('location: index.php');
          
       } else {
          echo "<script>alert('Email Id or Password is incorrect');
                window.location='login.php'</script>";
       }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="customCss/login-client.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
  
 <style type="text/css">

 </style>
</head>
<body>
<?php include('navbar.php');?>
  <div class="container bg-light" id="con">
     <h2 class="text">Login</h2>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
       
       <div class="form-group">
         <label>Email Address *</label>
         <input type="email" class="form-control" placeholder="Eg:abc@gmail.com" name="EMAIL" required>
       </div>
       
       <div class="form-group">
         <label>Password *</label>
         <input type="password" class="form-control" placeholder="Min-6 Character" name="PASSWORD" required>
       </div>
    
      
       <input type="submit" class="btn btn-info" value="Login" name="login">
     </form>
  </div>
</body>
</html>
    