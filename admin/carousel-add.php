<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
if(isset($_POST['ADD'])) {
    $error = array();
	
	$file_name = $_FILES['image']['name'];
	$file_size = $_FILES['image']['size'];
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_type = $_FILES['image']['type'];
	$file_ext = end(explode('.',$file_name));
	$extension = array("jpeg","jpg","png");
	
	if(in_array($file_ext,$extension) === false)  {
		$error[] = "This file extension is not valid, please upload jpg or png file";
	}
	if($file_size>2097152)  {
	    $error[] = "File size must be 2mb or Lower";
	}
	if(empty($error)=== true)  {
	    move_uploaded_file($file_tmp,"images/carousel/".$file_name);	
	}  else {
		echo"<pre>";
		echo"print_r($error)";
		echo"</pre>";
		die();
	}
       
       $sql = "INSERT INTO carousel(IMAGE) values('{$file_name}')";
       mysqli_query($conn, $sql) or die("Insert Query not running");
       header('location: carousel.php');

 }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Carousel</title>
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
    <h1>Add Carousel Image</h1>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
       <div class="form-group">
          <label>Add-Image*</label>
          <input type="file" class="form-control-file" name="image" required>
       </div>
        
       <input type="submit" class="btn btn-info" value="Add" name="ADD">
     </form>
  </div>
</body>
</html>