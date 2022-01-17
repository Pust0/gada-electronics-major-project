<?php
include('admin/config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="customCss/index.css">
    <link rel="stylesheet" type="text/css" href="customCss/navbarcss.css">
  </head>
  <style type="text/css">
        .remove-btn{
            background-color: #f8f9fa;
            border: 1px solid black;
            padding: 5px 7px;
            text-decoration: none;
            color: black;
        }
        .remove-btn:hover{
            text-decoration: none;
            background-color: black;
            color: #f8f9fa;
        }
        .product-image{
            object-fit: contain;
        }
  </style>
  <body>
  <?php include('navbar.php');?>

    <div class="container">
        <div class="row">
            <?php
                $id = $_GET['ID'];
                $tablename = "normaluser_cart_".$id;

                $sql = "SELECT * FROM {$tablename}";
                $result = mysqli_query($conn, $sql) or die("select query not running");
                if($n = mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $newtablename = $row["PRODUCTCATEGORY"];
                        $productid = $row["PRODUCTID"];
        
                        $sql1 = "SELECT * FROM {$newtablename} WHERE ID = {$productid}";
                        $result1 = mysqli_query($conn, $sql1) or die("second query not running");
                        $row1 = mysqli_fetch_assoc($result1);
                        $n = mysqli_num_rows($result1);
            ?>
            <div class="col-lg-3 col-md-3 col-6">
                <div class="card mx-auto">
                    <a href="card-details.php?CATEGORYNAME=<?php echo $row["PRODUCTCATEGORY"];?>&ID=<?php echo $row['PRODUCTID'];?>"><img class="card-img-top" src="admin/images/product/<?php echo $row1['IMAGE'];?>"/></a> 
                    <div class="card-body bg-light">
                        <p class="card-text"><?php echo $row1["TITLE"];?></p>
                        <?php 
                        if($row1["DISCOUNT"] != "") {
                        ?>
                            <p class="card-title discount" style="text-decoration:line-through;"><?php echo $row1["DISCOUNT"];?> Rs</p>
                        <?php }?>
                        <p class="card-title price text-info"><i><?php echo $row1["PRICE"];?> Rs</i></p>
                        <div>
                            <a href="delete-cart-product.php?USERID=<?php echo $id;?>&ID=<?php echo $row['ID'];?>" class="remove-btn">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } else {?>
                <p>Your Cart is empty.</p>
            <?php } ?>
        </div>
    </div>
    
    <br>
    <?php include('footer.php');?> 
 
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>

  </body>
</html>
