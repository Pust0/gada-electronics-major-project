<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="../customCss/navbarcss.css">
    <link rel="stylesheet" type="text/css" href="../customCss/index.css">
	  <!-- <link rel="stylesheet" type="text/css" href="customCss/style.css"> -->
  </head>
  <body>
    <!-- starting of navbar -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="home.php"><h2>Gada Electronics</h2></a>
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
                <a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="carousel.php">Carousel</a>
              </li>
            <li class="nav-item">
              <div class="input-group">
              <div class="input-group-append">
                <a class="nav-link product-inline" href="category.php">Category</a>
                <a class="dropdown-toggle dropdown-toggle-split product-inline" data-toggle="dropdown"></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php 
                $sql = "SELECT * FROM allcategory";
              $result = mysqli_query($conn,$sql) or die('Allcategory query not running');
              if(mysqli_num_rows($result)>0) {
                while($row = mysqli_fetch_assoc($result)) {
                
              ?>
              <a class="dropdown-item" href="#"><?php echo $row['CATEGORYNAME']; ?></a>
              <?php } } else {?>
                  <a class="dropdown-item" href="category-add.php">Add Category</a> 
              <?php } ?>
                    
              </div>
            </div>
            </li>

              <li class="nav-item">
                <a class="nav-link" href="users.php">Users</a>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="feedback.php">Feedback</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
              </ul>
          </div>
        </div>
      </nav>
    </header>
    <!--ending of navbar -->
  </body>
</html>