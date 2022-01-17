<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
$categoryname = strtolower($_GET['CATEGORYNAME']);
$categoryname = str_replace(" ", "_", $categoryname);
echo $categoryname;
if(isset($_POST['ADD'])) {
    $error = array();
	
	$file_name = $_FILES['image']['name'];
	$file_size = $_FILES['image']['size'];
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_type = $_FILES['image']['type'];
	$temp = explode('.',$file_name);
	$file_ext = end($temp);
	$extension = array("jpeg","jpg","png");
	
	if(in_array($file_ext,$extension) === false)  {
		$error[] = "This file extension is not valid, please upload jpg or png file";
	}
	if($file_size>9097152)  {
	    $error[] = "File size must be 9mb or Lower";
	}
	if(empty($error)=== true)  {
	    move_uploaded_file($file_tmp,"images/product/".$file_name);	
	}  else {
		echo"<pre>";
		echo print_r($error);
		echo"</pre>";
		die();
	}
       $name = $_POST['NAME'];
       $price = $_POST['PRICE'];
	   $discount = $_POST['DISCOUNT'];
	   $color = $_POST['COLOR'];
	   $quantity = $_POST['QUANTITY'];
	   $brand = $_POST['BRAND'];
	   $delivery = $_POST['DELIVERY'];
	   $returnable = $_POST['RETURNABLE'];
	   $numberofproduct = $_POST['NUMBEROFPRODUCT'];
	   
	   if(!empty ($discount) && $price>$discount) {
		   echo '<script>alert("Discount Price must be greater than the actual price");
		         window.location="category.php"</script>';
	   } else {
       
       $sql = "INSERT INTO {$categoryname}(IMAGE,TITLE,PRICE,DISCOUNT,COLOR,QUANTITY,BRAND,DELIVERY,RETURNABLE,NUMBEROFPRODUCT) values ('{$file_name}','{$name}','{$price}','{$discount}','{$color}','{$quantity}','{$brand}','{$delivery}','{$returnable}','{$numberofproduct}')";
       mysqli_query($conn, $sql) or die("Insert Query not running");
       header('location: category.php');
	   }

 }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Add-'.$categoryname.'-Card'?></title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
    
    <style type="text/css">
		.container-fluid {
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

  <div class="container-fluid">
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	  <div class="row">
	    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
		  <h1>Add <?php echo $categoryname; ?> Card</h1>
           <div class="form-group">
             <label>Image Of Product*</label>
             <input type="file" class="form-control-file" name="image" required>
           </div>
	   
	       <div class="form-group">
             <label>Name*</label>
             <input type="text" class="form-control" name="NAME" placeholder="Name of the product" required>
           </div> 
           <div class="form-group">
             <label>Price*</label>
             <input type="number" class="form-control" name="PRICE" placeholder="Product price" required>
           </div>
           <div class="form-group">
             <label>Discount price </label>
             <input type="number" class="form-control" name="DISCOUNT" placeholder="Discount Price">
           </div>   
      </div> <!-- col-lg-6 -->
	  
	  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
	      <h1>Product Description</h1>
	       <div class="form-group">
		     <label>Color*</label>
			 <input type="text" class="form-control" name="COLOR" placeholder="Color of the product" required>
		   </div>
		   <div class="form-group">
		     <label>Net. Quantity*</label>
			 <input type="text" class="form-control" name="QUANTITY" placeholder="Quantity of the product" required>
		   </div>
		   <div class="form-group">
		     <label>Brand*</label>
			 <input type="text" class="form-control" name="BRAND" placeholder="Brand name of the product" required>
		   </div>
		   <div class="form-group">
		     <label>Number Of Products*</label>
			 <input type="number" class="form-control" name="NUMBEROFPRODUCTS" placeholder="Number Of Products Available" required>
		   </div>
		   <div class="form-group">
		     <label>Delivery Charge*</label>
			 <input type="number" class="form-control" name="DELIVERY" placeholder="Delivery Charge" required>
		   </div>
	  </div>
	  
	 </div> <!-- row div -->
	 <div class="form-group">
		<label>Returnable/Non-Returnable *</label>
		<select style="width: 100%; height:5vh;" name="RETURNABLE" required>
		    <option disabled selected value="">Select</option>
		    <option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
	 </div>
       <input type="submit" class="btn btn-info" value="Add" name="ADD">
     </form>
  </div>
</body>
</html>