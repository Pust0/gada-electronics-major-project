<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
if(isset($_post['send']))  {
	$email = $_POST['EMAIL'];
	$message = $_POST['MESSAGE'];
	$to = $email;
	$Subject = "Aggrawal's Store";
	$from = "anmolshrivastav.08@gmail.com";
	$headers = "From: $from";
	
	mail($to,$subject,$message,$headers) or die("Mail function not running");
	echo'<script type="text/javascript">alert("Reply Mail send");
	     window.location="feedback.php"</script>';
}
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback-Reply</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
  </head>
<body class="bg-light">
<?php include('navbar.php');?>
<div class="container-fluid" id="carouselCon">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
	     <h1>Feedback Reply</h1>
	  </div>
   </div> <!-- row div -->
  <?php
	   $id = $_POST['ID'];
	   $sql = "SELECT * FROM feedback WHERE ID = {$id}";
	   $result = mysqli_query($conn,$sql) or die("select query not running");
	   while($row = mysqli_fetch_assoc($result))  {
		   
	 ?>
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
	  
      <div class="form-group">
	     <label>Name</label>
		 <input type="text" name="NAME" class="form-control" value="<?php echo $row['NAME'];?>" readonly>
	  </div>
	  
	  <div class="form-group">
	     <label>Email-Id</label>
		 <input type="text" name="EMAIL" class="form-control" value="<?php echo $row['EMAIL'];?>" readonly>
	  </div>
	  
	  <p>Message</p>
	  <textarea rows="5" class="form-control" placeholder="Type your Reply Here...."></textarea>	
       
	   <br>
	   
      <input type="submit" class="btn btn-info" name="send" value="Send">	  
   </form>
	   <?php } ?>
</div>  <!-- container-fluid div -->
</body>
</html>