<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
    
    <style type="text/css">
	 .welcome{
		 text-align:center;
		 margin-top:230px;
		 text-shadow:#6F6;
		 text-transform:capitalize;	 
	 }
	 .product-inline {
		 display: inline-block;
	 }
	 .dropdown-toggle-split {
		 font-weight: 500;
         font-size: 30px;
		 padding: 7px 10;
		 text-align: center; 
	 }
	 @media (max-width: 992px) {
		 
	    .dropdown-toggle-split {
		 margin-top: 27px;
		 font-weight: 500;
         font-size: 30px;
		}
	    .dropdown-toggle-split:hover {
		 background-color:  #9900cc;
		 
	 }
    }
        
	   
	</style>
  </head>
<body>
<?php include('navbar.php');?>
<div class="container-fluid">
  <h1 class="welcome text-info">
   Welcome Back <br>Mr. <?php echo $_SESSION['USERNAME'];?> 
  </h1>
</div><!--container-fluid div -->
   
</body>
</html>