<?php
include('admin/config.php');
session_start();
$categoryname=strtolower($_GET['CATEGORYNAME']);
$id=$_GET['ID'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo strtoupper(str_replace("_"," ", $categoryname)); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css"> 
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">  
    <link rel="stylesheet" href="customCSS/card-details.css">
  </head>
  <body>
	  <?php include('navbar.php');?>

		<!-- card starts here -->
			<div class="container">
				<div id="error-message"></div>
				<div id="success-message"></div>
				<div class="row">
      			<?php 
						$sql = "SELECT * FROM $categoryname WHERE ID={$id}";
						$result = mysqli_query($conn,$sql) or die("categoryname select query not running");
						if(mysqli_num_rows($result)>0) {
						$row = mysqli_fetch_assoc($result); 		
     				?>
     			<div id="card-name" class="col-lg-12 col-md-12 col-sm-12 col-12">
					<p class="productname"><?php echo $row['TITLE'];?></p>
				</div>
				
				<div id="stock-mgs-box" class="col-lg-12 col-md-12 col-sm-12 col-12">
					<marquee behavior="alternate" direction="right" scrollamount="5" style="color: red;"></marquee>
				</div>
	 
				<div id="after-card" class="col-lg-6 col-md-6 col-sm-6 col-12">
					<table class="table table-light table-hover">
					<thead>
						<tr id="desc">
							<h3>Description</h3>
						</tr>
					</thead>
					<tbody>
					<?php 
						$sql1 = "SELECT * FROM $categoryname WHERE ID={$id}";
						$result1 = mysqli_query($conn,$sql1) or die("categoryname second select query not running");
						if(mysqli_num_rows($result1)>0) {
						while($row1 = mysqli_fetch_assoc($result1)) { 				
						?>
						<tr>
							<td>Color</td>
							<td style="color:#1641a0">-></td>
							<td><?php echo $row1['COLOR'];?></td>
						</tr>
						<tr>
							<td>Net. Quantity</td>
							<td style="color:#1641a0">-></td>
							<td><?php echo $row1['QUANTITY'];?></td>
						</tr>
						<tr>
							<td>Brand</td>
							<td style="color:#1641a0">-></td>
							<td><?php echo $row1['BRAND'];?></td>
						</tr>
						<tr>
							<td>Delivery Charge</td>
							<td style="color:#1641a0">-></td>
							<td>&#8377;<?php echo $row1['DELIVERY'];?></td>
						</tr>
						<tr>
							<td>Returnable</td>
							<td style="color:#1641a0">-></td>
							<td><?php echo $row1['RETURNABLE'];?></td>
						</tr>
					</tbody>
					</table>
		  <?php } } ?>
		<br>
		<div align="center">
		<p class="payment price">&#8377;<?php echo $row['PRICE'];?>/-</p>
		<p class="payment discount"><?php echo $row['DISCOUNT'];?></p>
		</div>
	 </div>
	 <div id="card-image" class="col-lg-6 col-md-6 col-sm-6 col-12">
	    <img class="img-fluid card-image product-image" src="admin/images/product/<?php echo $row['IMAGE'];?>">
	 </div>
	 
	  <?php } ?>
	 </div> <!-- row div -->
	<div align="center" style="padding-top: 35px;">
	<a href="#" class="btn btn-info" id="addtowishlistbtn">Add To Wishlist</a>
	<a id="buy-now-btn" href="payment.php?CATEGORY=<?php echo $categoryname;?>&ID=<?php echo $id;?>" class="btn btn-info">Buy Now</a>
	<a href="#" class="btn btn-info" id="addtocardbtn">Add To Cart</a>
    </div>
 </div> <!-- container div -->
<br>
  
 <?php include('footer.php');?>  


<script src="js/jquery.js" type="text/javascript"></script>
<script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script> 
<script type="text/javascript">
	$(document).ready(function(){
		let url = window.location.href;
		let categoryName = url.substring(url.indexOf('=')+1, url.indexOf('&'));
		let productId = url.substring(url.indexOf('&')+4, url.charAt(url.length-1) == '#' ? url.length-1 : url.length);
		let addtocardbtn = $("#addtocardbtn");
		let addtowishlistbtn = $("#addtowishlistbtn");

		addtocardbtn.on("click", function(){
			let url = window.location.href;
			let categoryName = url.substring(url.indexOf('=')+1, url.indexOf('&'));
			let productId = url.substring(url.indexOf('&')+4, url.charAt(url.length-1) == '#' ? url.length-1 : url.length);
			// console.log(categoryName);
			// console.log(productId);

			$.ajax({
				url: "ajax/addtocart.php",
				type: "POST",
				data: {categoryName: categoryName, productId: productId},
				success: function(data){
					$("#success-message").html(data).slideDown();
					setTimeout(() => {
						$("#success-message").slideUp();
					}, 3000);
				} 
			});
		});

		addtowishlistbtn.on("click", function(){
			// console.log(categoryName);
			// console.log(productId);

			$.ajax({
				url: "ajax/addtowishlist.php",
				type: "POST",
				data: {categoryName: categoryName, productId: productId},
				success: function(data){
					$("#success-message").html("Added Successfully.").slideDown();
					setTimeout(() => {
						$("#success-message").slideUp();
					}, 3000);
				} 
			});
		});

		let stockMgsBox = $("#stock-mgs-box");
		let buyNowBtn = $("#buy-now-btn");
		setInterval(() => {
			$.ajax({
				url: "ajax/stockMgs.php",
				type: "POST",
				data: {categoryName: categoryName, productId: productId},
				success: function(data){
					// console.log(data);
					if(data > 0 && data < 10){
						// console.log(data);
						stockMgsBox.css("display", "block");
						$("#stock-mgs-box marquee").html("Hurry Up Only "+data+" Left");
						buyNowBtn.css("display", "inline-block");
					}else if(data == 0){
						// console.log(data);
						stockMgsBox.css("display", "block");
						buyNowBtn.css("display", "none");
						$("#stock-mgs-box marquee").html("Sorry Currently Out of Stock Check After Some Time");
					}else{
						buyNowBtn.css("display", "inline-block");
						stockMgsBox.css("display", "none");
					}
				}
			});
		}, 500);

		// console.log("Hy");
	});
</script>

  </body>
</html>
