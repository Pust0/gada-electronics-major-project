<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	include("../admin/config.php");
	session_start();
	if(!isset($_SESSION['EMAIL'])){
		header("location: ../index.php");
	}
	 
	$category = $_GET['CATEGORY'];
	$id = $_GET['PRODUCTID'];

	$sql = "SELECT * FROM {$category} WHERE ID = {$id}";
	$result = mysqli_query($conn, $sql) or die("Select query not running");
	$row = mysqli_fetch_assoc($result);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Merchant Check Out Page</title>
<meta name="GENERATOR" content="Evrsoft First Page">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="../Bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../customCss/index.css">
<link rel="stylesheet" type="text/css" href="../customCss/navbarcss.css">

<style type="text/css">
   body { 
       margin: 0;
       padding: 0;
       /* background: linear-gradient(115deg, #9900cc 10%, #0c3 90%);
       background-position: Fixed;
       background-size: cover;
       z-index: 1; */
       padding: 55px 20px 40px 20px;
    }
   .container {
		padding: 20px 20px;
		width: auto;
		max-width: 600px;
		height: auto;
		box-shadow: 0px 0px 13px rgba(0,0,0,0.9);
	}
    .container .text {
        background: -webkit-linear-gradient(right, #0c3, #9900cc, #56c5e4, #9f01ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .btn {
		left: -100%;
		padding: 10px 30px;
		transition: all 0.4s;
	}
 </style>

</head>

<body>
	<div class="container bg-light" style="margin-top: 89px">
		<h2 class="text">Merchant Check Out Page</h2>

		<form action="pgRedirect.php?CATEGORY=<?php echo $category;?>&ID=<?php echo $id;?>" method="post">
		
		<div class="form-group">
			<label>ORDER_ID::*</label>
			<input id="ORDER_ID" class="form-control" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>" readonly>
		</div>

		<div class="form-group">
			<label>CUSTOMER_ID ::*</label>
			<input type="email" class="form-control" id="CUST_ID" name="CUST_ID" value="<?php echo $_SESSION['EMAIL'];?>" readonly>
		</div>

		<div class="form-group">
			<label>INDUSTRY_TYPE_ID ::*</label>
			<input id="INDUSTRY_TYPE_ID" class="form-control" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" readonly>
		</div>

		<div class="form-group">
			<label>Channel ::*</label>
			<input id="CHANNEL_ID" class="form-control" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" readonly>
		</div>
		
		<div class="form-group">
			<label>txnAmount*</label>
			<input title="TXN_AMOUNT" class="form-control" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $row['PRICE'];?>" readonly>
		</div>

		<div class="form-group">
			<input title="PRODUCT_CATEGORY" class="form-control" tabindex="10" type="hidden" name="CATEGORY" value="<?php echo $category;?>" readonly>
		</div>

		<div class="form-group">
			<input title="PRODUCT_ID" class="form-control" tabindex="10" type="hidden" name="PRODUCTID" value="<?php echo $id;?>" readonly>
		</div>
		
		
		<input type="submit" class="btn btn-success" value="Pay Now!!!" name="submit">
		</form>
	</div>

</body>
</html>