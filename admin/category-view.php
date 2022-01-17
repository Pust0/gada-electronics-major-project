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
    <title>View Category Card</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
  </head>
<body>
<?php include('navbar.php');?>
<div class="container-fluid" style="margin-top:60px;">
<?php
  $id = $_GET['ID'];
  $categoryname = $_GET['CATEGORYNAME'];
?>
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
        <h1><?php echo $categoryname?> category</h1>
     </div>
     <div class="col-lg-4 col-md-4 col-sm-4 col-4">
        <input type="button" onclick="window.location.href='category-card-add.php?CATEGORYNAME=<?php echo $categoryname; ?>'" class="btn btn-info" value="Add Product Card">
     </div>
  </div>
   <table>
      <thead>
	    <tr>
		  <th>ID</th>
		  <th>Image Name</th>
		  <th>Product Name</th>
		  <th>Number of Product Available</th>
		  <th>Price</th>
		  <th>Discount</th>
		  <th>Color</th>
		  <th>Quantity</th>
		  <th>Brand</th>
		  <th>Delivery Charge</th>
		  <th>Returnable</th>
		  <th>Edit</th>
		  <th>Delete</th>
		</tr>
	  </thead>
	  <tbody>
	    <?php
		  $sql = "SELECT * FROM $categoryname";
		  $result = mysqli_query($conn,$sql) or die('select query not running');
		  if(mysqli_num_rows($result)>0) {
			  while($row = mysqli_fetch_assoc($result)) {
		?>
		  <tr>
		    <td><?php echo $row['ID'];?></td>
			<td><?php echo $row['IMAGE'];?></td>
			<td><?php echo $row['TITLE'];?></td>
			<td><?php echo $row['NUMBEROFPRODUCT'];?></td>
			<td><?php echo $row['PRICE'];?></td>
			<td><?php echo $row['DISCOUNT'];?></td>
			<td><?php echo $row['COLOR'];?></td>
			<td><?php echo $row['QUANTITY'];?></td>
			<td><?php echo $row['BRAND'];?></td>
			<td><?php echo $row['DELIVERY'];?></td>
			<td><?php echo $row['RETURNABLE'];?></td>
			<td><a href="category-card-edit.php?ID=<?php echo $row['ID'];?>&CATEGORYNAME=<?php echo $categoryname;?>&categoryid=<?php echo $id;?>">
			<i class="fa fa-pencil-alt"></i></a></td>
			<td><a href="category-card-delete.php?ID=<?php echo $row['ID'];?>&CATEGORYNAME=<?php echo $categoryname;?>">
			<i class="fa fa-trash-alt"></i></a></td>
		  </tr>
		  <?php } } else {?>
		    <h1>No Product Card Found</h1>
		  <?php } ?>
	  </tbody>
   </table>
</div>  <!-- container-fluid div-->
</body>
</html>