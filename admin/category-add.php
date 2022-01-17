<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
if(isset($_POST['add']))  {
	$name = strtolower($_POST['CATEGORYNAME']);
	$sql = "INSERT INTO allcategory(CATEGORYNAME) VALUES('{$name}')";
	mysqli_query($conn,$sql) or die('Insert query not running');
	
	$sql1 = "CREATE TABLE $name(ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, IMAGE VARCHAR(50) NOT NULL, TITLE VARCHAR(200) NOT NULL, PRICE VARCHAR(20) NOT NULL, DISCOUNT VARCHAR(20), COLOR VARCHAR(15) NOT NULL, QUANTITY VARCHAR(15) NOT NULL, BRAND VARCHAR(50) NOT NULL, DELIVERY VARCHAR(10) NOT NULL, RETURNABLE VARCHAR(5) NOT NULL, NUMBEROFPRODUCT INT NOT NULL)";
	mysqli_query($conn,$sql1) or die('create table query not running');
	header('location: category.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
  </head>
<body class="bg-light">
<?php include('navbar.php');?>
  <div class="container bg-light" id="carouselCon">
    <h1>Add New Category Name</h1>
      <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
	     <div class="form-group">
		   <label>Category Name *</label>
		   <input type="text" class="form-control" placeholder="Name" name="CATEGORYNAME" required>
		 </div>
		 <input type="submit" class="btn btn-info" value="Add" name="add">
	  </form>
  </div>
</body>
</html>