<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
$categoryname = $_GET['CATEGORYNAME'];
if(isset($_POST['update'])) {
	if(empty($_FILES['image']['name'])) {
		$file_name = $_POST['oldimage'];
	}else {
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

       $id = $_POST['ID'];
       $name = $_POST['NAME'];
	   $price = $_POST['PRICE'];
	   $discount = $_POST['DISCOUNT'];
	   $color = $_POST['COLOR'];
	   $quantity = $_POST['QUANTITY'];
	   $brand = $_POST['BRAND'];
	   $delivery = $_POST['DELIVERY'];
	   $returnable = $_POST['RETURNABLE'];
	   $numberofproduct = $_POST['NUMBEROFPRODUCT'];
      
       $sql = "UPDATE $categoryname SET IMAGE='{$file_name}',TITLE = '{$name}',PRICE= '{$price}',DISCOUNT= '{$discount}',COLOR= '{$color}',QUANTITY= '{$quantity}',BRAND= '{$brand}',DELIVERY= '{$delivery}',RETURNABLE= '{$returnable}', NUMBEROFPRODUCT='{$numberofproduct}' WHERE ID = {$id}";
       mysqli_query($conn, $sql) or die("update Query not running");
	   $ID = $_GET['ID'];
       header('location: category-view.php?ID='.$ID.'&CATEGORYNAME='.$categoryname);
 }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit-<?php echo $categoryname; ?>-Card</title>
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
   <?php 
   $id = $_GET['ID'];
   $sql1 = "SELECT * FROM $categoryname WHERE ID = {$id}";
   $result1 = mysqli_query($conn, $sql1) or die('select query not running');
   if(mysqli_num_rows($result1)==1) {
      while($row1 = mysqli_fetch_assoc($result1)) {   
  ?>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
       <div class="row">
	     <div class="col-lg-6 col-md-6 col-sm-6 col-12">
		  <h1>Edit <?php echo $categoryname; ?> Card</h1>
           <div class="form-group">
             <input type="hidden" class="form-control" name="ID" value="<?php echo $row1['ID']; ?>">
           </div>
	       <div class="form-group">
             <label>Image *</label>
             <img src="images/product/<?php echo $row1['IMAGE'];?>" style="height:25vh">
             <input type="file" class="form-control-file" name="image">
		     <input type="hidden" class="form-control-file" name="oldimage" value="<?php echo $row1['IMAGE'];?>">
           </div>
	       <div class="form-group">
             <label>Name *</label>
             <input type="text" class="form-control" name="NAME" value="<?php echo $row1['TITLE'];?>" placeholder="Name of product" required>
           </div>
          <div class="form-group">
             <label>Price *</label>
             <input type="text" class="form-control" name="PRICE" value="<?php echo $row1['PRICE'];?>" placeholder="Price of product" required>
           </div>
          <div class="form-group">
             <label>Discount </label>
             <input type="text" class="form-control" name="DISCOUNT" value="<?php echo $row1['DISCOUNT'];?>" placeholder="Discount on product">
          </div>
         </div>  <!-- col-6 div -->
		  
		 <div class="col-lg-6 col-md-6 col-sm-6 col-12">
		   <h1>Product Description</h1>
		    <div class="form-group">
		     <label>Color *</label>
			 <input type="text" class="form-control" name="COLOR" value="<?php echo $row1['COLOR'];?>" placeholder="Color of the product" required>
		   </div>
		   <div class="form-group">
		     <label>Net. Quantity *</label>
			 <input type="text" class="form-control" name="QUANTITY" value="<?php echo $row1['QUANTITY'];?>" placeholder="Quantity of the product" required>
		   </div>
		   <div class="form-group">
		     <label>Brand *</label>
			 <input type="text" class="form-control" name="BRAND" value="<?php echo $row1['BRAND'];?>" placeholder="Brand name of the product" required>
		   </div>
		   <div class="form-group">
		     <label>Delivery Charge *</label>
			 <input type="number" class="form-control" name="DELIVERY" value="<?php echo $row1['DELIVERY'];?>" placeholder="Delivery Charge" required>
		   </div>
		   <div class="form-group">
		     <label>Number of Product Available *</label>
			 <input type="number" class="form-control" name="NUMBEROFPRODUCT" value="<?php echo $row1['NUMBEROFPRODUCT'];?>" placeholder="Number Of Product Available" required>
		   </div>
		   <div class="form-group">
		     <label>Returnable/Non-Returnable *</label>
		     <select style="width: 100%; height:5vh;" name="RETURNABLE" required>
			   <?php 
			    if($row1['RETURNABLE']=== "Yes") {
			   ?>
		        <option selected value="Yes">Yes</option>
				<option value="No">No</option>
			   <?php } else { ?>
			    <option value="Yes">Yes</option>
				<option selected value="No">No</option>
			   <?php } ?>
		     </select>
	      </div>
		 </div> <!-- col-6 div -->
	   </div>  <!-- row div -->
	    <div align="center">
       <input type="submit" class="btn btn-info" value="Update" name="update">
	  </div>
     </form>
  <?php } }?>
  </div>
</body>
</html>