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
    <title>Carousel</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
  </head>
<body>
<?php include('navbar.php');?>
<div class="container-fluid" style="margin-top:90px">
   <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-8">
        <h1 style="color: #031b4e">Home Carousel Image</h1>
     </div>
     <div class="col-lg-4 col-md-4 col-sm-4 col-4">
        <input type="button" onclick="window.location.href='carousel-add.php'" class="btn btn-info" value="Add Carousel">
     </div>
   </div> <!-- row div -->
<table>
   <thead>
    <tr>
     <th>Id</th>
     <th>Image Name</th>
     <th>Edit</th>
     <th>Delete</th>
    </tr>
   </thead>
   <tbody>
     <?php  
         $sql = "SELECT * FROM carousel";
         $result = mysqli_query($conn, $sql) or die("Select Query Not Running");
         if(mysqli_num_rows($result)>0) {
             while($row = mysqli_fetch_assoc($result)) {
     ?>
     <tr>
        <td><?php echo $row['ID']; ?></td>
        <td><?php echo $row['IMAGE']; ?></td>
        <td><a href="carousel-edit.php?ID=<?php echo $row['ID'];?>">
        <i class="fa fa-pencil-alt"></i></a></td>
        <td><a href="carousel-delete.php?ID=<?php echo $row['ID'];?>">
        <i class="fa fa-trash-alt"></i></a></td>
     </tr>
      <?php } }?>
   </tbody>
</table>
</div><!--container-fluid div -->
   
</body>
</html>