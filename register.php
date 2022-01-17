<?php
include('admin/config.php');
if(isset($_POST['register']))  {

     $name = $_POST['NAME'];
     $email = $_POST['EMAIL'];
     $mobile = $_POST['MOBILE'];
     $password = $_POST['PASSWORD'];
     $repassword = $_POST['REPASSWORD'];
    //  address
    $address = $_POST['ADDRESS'];
    $city = $_POST['CITY'];
    $pincode = $_POST['PINCODE'];
    $state = $_POST['STATE'];
    $country = $_POST['COUNTRY'];
     
     if($password === $repassword)    {
            $sql = "SELECT * FROM normaluser WHERE EMAIL = '{$email}'";
            $result = mysqli_query($conn,$sql) or die("Select query not running");
            if(mysqli_num_rows($result)>0) {
              echo "<script type='text/javascript'>alert('Already have an account with this Email-Id');
                    window.location='register.php'</script>";
          } else {
                $sql1 = "INSERT INTO normaluser(NAME,EMAIL,PHONE,PASSWORD,ADDRESS,CITY,PINCODE,STATE,COUNTRY) VALUES('{$name}','{$email}','{$mobile}','{$password}','{$address}','{$city}','{$pincode}','{$state}','{$country}')";
                $result1 = mysqli_query($conn,$sql1) or die("Insert query not running");

                //creating tables for wishlist and cart
                $sql1 = "SELECT ID FROM normaluser WHERE EMAIL = '{$email}'";
                $result1 = mysqli_query($conn, $sql1) or die("Select ID query not running");
                $row2 = mysqli_fetch_assoc($result1);
                $id = $row2['ID'];
                //die($id);

                $tablename1 = "normaluser_wishlist_".$id; 
                $tablename2 = "normaluser_cart_".$id; 

                $sql1 = "CREATE TABLE $tablename1(ID int primary key auto_increment, PRODUCTCATEGORY varchar(400) not null, PRODUCTID int not null)";
                mysqli_query($conn, $sql1) or die("wishlist table creation failed");

                $sql1 = "CREATE TABLE $tablename2(ID int primary key auto_increment, PRODUCTCATEGORY varchar(400) not null, PRODUCTID int not null)";
                mysqli_query($conn, $sql1) or die("cart table creation failed");

                echo'<script type="text/javascript">alert("Account Created");
                     window.location="index.php"</script>';
             }
          
      } else {
          echo "<script>alert('Password does not mached');
                window.location='register.php'</script>";
       }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="register-client.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
  </head>
<body>
<?php include('navbar.php');?>

  <div class="container bg-light" id="con">
     <h2 class="text">Register Your Self</h2>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
       <div class="form-group">
         <label>Name *</label>
         <input type="text" class="form-control" placeholder="Name" name="NAME" required>
       </div>
       <div class="form-group">
         <label>Email Address *</label>
         <input type="email" class="form-control" placeholder="Eg:abc@gmail.com" name="EMAIL" required>
       </div>
       <div class="form-group">
         <label>Mobile Number *</label>
         <input type="text" class="form-control" placeholder="Contact Number" name="MOBILE" required>
       </div>
       <div class="form-group">
         <label>Password *</label>
         <input type="password" class="form-control" placeholder="Min-6 Character" name="PASSWORD" required>
       </div>
       <div class="form-group">
         <label>Re-Password *</label>
         <input type="password" class="form-control" placeholder="Confirm Password" name="REPASSWORD" required>
       </div>
       <!-- address -->
       <div class="form-group">
         <label>Address *</label>
         <input type="text" class="form-control" placeholder="Full Address" name="ADDRESS" required>
       </div>
       <div class="form-group">
         <label>City *</label>
         <input type="text" class="form-control" placeholder="eg: New Delhi" name="CITY" required>
       </div>
       <div class="form-group">
         <label>Pincode *</label>
         <input type="text" class="form-control" placeholder="eg: 110003" name="PINCODE" required>
       </div>
       <div class="form-group">
         <label>State *</label>
         <input type="text" class="form-control" placeholder="eg: Delhi" name="STATE" required>
       </div>
       <div class="form-group">
         <label>Country *</label>
         <input type="text" class="form-control" placeholder="eg: India" name="COUNTRY" required>
       </div>
       <input type="submit" class="btn btn-info" value="Register" name="register">
	   <br>
     </form>
  </div>
  <br>
  
</body>
</html>
    