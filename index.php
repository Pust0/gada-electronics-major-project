<?php
include('admin/config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="customCss/index.css">
    <!-- <link rel="stylesheet" type="text/css" href="customCss/style.css"> -->
  </head>
  <body>
    <?php include('navbar.php');?>
  <!-- carousel starting -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php
    $sql = "SELECT * FROM carousel"; 
    $result = mysqli_query($conn,$sql);
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {
    
      if($i ==0) {
        $actives = 'active';
      }else {
        $actives = '';
      }
      
    ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" 
      class="<?php echo $actives; ?>"></li>
    <?php	   
  $i++; 
    } ?>
    </ol>
    <div class="carousel-inner">
    <?php 
    $i = 0;
    foreach($result as $row) {
      if($i ==0) {
        $actives = 'active';
      } else  {
        $actives = '';
      }
    ?>
      <div class="carousel-item <?php echo $actives; ?>">
        <img class="d-block w-100" src="admin/images/carousel/<?php echo $row['IMAGE'];?>">
      </div>
    <?php
      
    $i++;
    } 
    ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" 
    data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" 
    data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- carousel ending -->

  <br>

  <!-- Product card starts here -->
  <div id="latest-products" class="container"></div>
  <!-- card ends here -->

  <br>

 <?php include('footer.php');?> 

  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="Bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        function loadAllProduct(){
          let productBox = $("#latest-products");
          //console.log("Hello");
          $.ajax({
            url: "ajax/index/loadProductCard.php",
            type: "POST",
            success: function(data){
              //console.log(data);
              productBox.html(data);
            }
          });
        }
        loadAllProduct();

        $(document).on("click", ".pagination-btn", function(e){
            let productCategoryId = $(this).data('id');
            let paginationPageNo = e.currentTarget.innerText;

            if(paginationPageNo === "See All"){
              //do nothing because it will redirect to another page no need to do pagination
            }else{
              console.log(productCategoryId);
              console.log(paginationPageNo);
              $.ajax({
                url: "ajax/index/loadPaginationCard.php",
                type: "GET",
                data: {product_Category_Id: productCategoryId, pagination_Number: paginationPageNo},
                success: function(data){
                    $("#"+productCategoryId+"-OneProductRow").html(data);
                }
              });
            }
        });
    });
  </script>

  </body>
</html>
