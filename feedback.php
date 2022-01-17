<?php
include('admin/config.php');
session_start();
if(isset($_POST['send']))  {

     $name = $_POST['NAME'];
     $email = $_POST['EMAIL'];
     $mobile = $_POST['MOBILE'];
     $message = $_POST['MESSAGE'];
     
     $sql = "INSERT INTO feedback(NAME,EMAIL,PHONE,MESSAGE) values('{$name}','{$email}','{$mobile}','{$message}')";
	 $result = mysqli_query($conn,$sql) or die("INSERT query not running");
	 echo'<script type="text/javascript">alert("Your Feedback is Submitted");
	      window.location="feedback.php"</script>';
     
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
  
 <style type="text/css">
   #con { 
      padding: 20px 20px;
      width: auto;
      max-width: 600px;
      height: auto;
      box-shadow: 0px 0px 13px rgba(0,0,0,0.9);
      margin-top: 30px;
    }
    #con .text {
      background: -webkit-linear-gradient(right, #0c3, #9900cc, #56c5e4, #9f01ea);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    form .btn {
      left: -100%;
      padding: 10px 30px;
      transition: all 0.4s;
    }
 </style>
</head>
<body>
  <?php include('navbar.php');?>

  <div class="container bg-light" id="con">
     <h2 class="text">Contact Us</h2>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
       <div class="form-group">
         <label>Name*</label>
         <input type="text" class="form-control" placeholder="Name" name="NAME" required>
       </div>
       <div class="form-group">
         <label>Email Address*</label>
         <input type="email" class="form-control" placeholder="Eg:abc@gmail.com" name="EMAIL" required>
       </div>
       <div class="form-group">
         <label>Mobile Number*</label>
         <input type="text" class="form-control" placeholder="Contact Number" name="MOBILE" required>
       </div>
       
      <p>Message*</p>
      <div class="form-group">
       <textarea rows="5" class="form-control" name="MESSAGE" placeholder="Enter Your Message Here ...."></textarea>
      </div>
      
       <input type="submit" class="btn btn-info" value="Send" name="send">
     </form>
  </div>
</body>
</html>
    