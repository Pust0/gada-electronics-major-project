<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="customCss/navbarcss.css">
    <link rel="stylesheet" type="text/css" href="customCss/index.css">
	  <!-- <link rel="stylesheet" type="text/css" href="customCss/style.css"> -->
  </head>
  <body>
    <!-- starting of navbar -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>Gada Electronics</h2></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mr-auto">
            
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
                >Products</a
              >
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php 
              $sql2 = "SELECT * FROM allcategory";
              $result2 = mysqli_query($conn,$sql2) or die("Allcategory select query not running");
              if(mysqli_num_rows($result2)>0) {
              while($row2 = mysqli_fetch_assoc($result2)) {
                $productcategory=$row2['CATEGORYNAME'];
              ?>
              
            <a class="dropdown-item product-dropdown" href="product-card.php?CATEGORYNAME=<?php echo $productcategory;?>&ID=<?php echo $row2['ID'];?>"><?php echo strtoupper(str_replace("_"," ",$row2['CATEGORYNAME']));?></a>
              <?php } }?>
              </div>
            </li>

            <!-- <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li> -->

            <li class="nav-item">
              <a class="nav-link" href="feedback.php">Feedback</a>
            </li>
          <?php 
            if(!isset($_SESSION['EMAIL']))  {
          ?>	
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Account
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="register.php">Register</a>
                <a class="dropdown-item" href="login.php">Login</a>
              </div>
            </li>	
          <?php } else {?>
            <li class="nav-item">
              <a class="nav-link" href="cart.php?ID=<?php echo $_SESSION['ID'];?>" data-toggle="tooltip" data-placement="bottom" title="View Cart"><i class="fas fa-shopping-cart"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="wishlist.php?ID=<?php echo $_SESSION['ID'];?>" data-toggle="tooltip" data-placement="bottom" title="View Wishlist"><i class="fas fa-heart"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="setting.php?ID=<?php echo $_SESSION['ID'];?>" data-toggle="tooltip" data-placement="bottom" title="MY ACCOUNT"><?php echo $_SESSION['NAME'];?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php } ?>
            </ul>
        </div>
        </div>
      </nav>
    </header>
    <!--ending of navbar -->
  </body>
</html>