<?php
include('admin/config.php');
session_start();
$categoryname = $_GET['CATEGORYNAME'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo strtoupper(str_replace("_"," ",$categoryname));?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="customCss/product-card.css">
  </head>
  <body>
  <?php include('navbar.php');?>

  <div class="container shadow"> 
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div align="center" id="searchBox">
            <input type="text" id="search-box" placeholder="Search Product Here..."/>
          </div>
        </div>
    </div>
  
  <div class="heading">
	  <h1 class="text"><?php echo strtoupper(str_replace("_"," ",$categoryname));?></h1>
	</div>
	
	<div class="row" id="product-row">
	  
	    <div class="col-lg-3 col-md-3 col-6">
	      <div class="card mx-auto">
		    <a href="card-details.php?CATEGORYNAME=<?php echo $categoryname;?>&ID=<?php echo $row1['ID'];?>"><img class="card-img-top" src="admin/images/product/<?php echo $row1['IMAGE'];?>"></a> 
          <div class="card-body bg-info">
            <p class="card-text"><?php echo $row1['TITLE'];?></p>
            <p class="card-title discount" style="text-decoration:line-through;"><?php echo $row1['DISCOUNT']."Rs.";?></p>
            <p class="card-title price text-info"><i><?php echo $row1['PRICE']."Rs.";?></i></p>
          </div>
	      </div>
		</div>

	  </div>  <!-- row div -->
	   
  </div>  <!-- container div -->
  <br>
  <?php include('footer.php');?>

  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>

  <script type="text/javascript">
      $(document).ready(function(){

        //searching
        let searchBox = $("#searchBox #search-box");

        function loadData(){
            let searchedProduct = searchBox.val();
            // console.log(searchedProduct);

            let url = window.location.href;
            let categoryName = url.substring(url.indexOf('=')+1, url.indexOf('&'));
            //console.log(categoryName);

            $.ajax({
              url: "ajax/productCategory/searchProduct.php",
              type: "POST",
              data: {tableName: categoryName, searchedText: searchedProduct},
              success: function(data){
                  $("#product-row").html(data);
              }
            });
        }

        searchBox.on("keyup", loadData);

        loadData();
      });
  </script>


  </body>

</html>