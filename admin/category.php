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
    <title>Category</title>
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
        <h1>All Products Category's</h1>
     </div>
     <div class="col-lg-4 col-md-4 col-sm-4 col-4">
        <input type="button" onclick="window.location.href='category-add.php'" class="btn btn-info" value="Add Category">
     </div>
   </div> <!-- row div -->
<table>
   <thead>
    <tr>
     <th>Id</th>
     <th>Category Name</th>
     <th>Number Of Cards</th>
     <th>View</th>
	    <th>Delete</th>
    </tr>
   </thead>
   <tbody>
     <?php  
         $sql = "SELECT * FROM allcategory";
         $result = mysqli_query($conn, $sql) or die("Select Query Not Running");
         if(mysqli_num_rows($result)>0) {
             while($row = mysqli_fetch_assoc($result)) {
     ?>
     <tr>
        <td><?php echo $row['ID']; ?></td>
        <td class="categoryname"><?php echo $row['CATEGORYNAME']; $name= strtolower($row['CATEGORYNAME']); ?></td>
		<?php 
		 $sql1 = "SELECT * FROM $name";
         $result1 = mysqli_query($conn, $sql1) or die("Select category name Query Not Running");
         $num = mysqli_num_rows($result1) 
		?>
        <td><?php echo $num; ?></td>
        <td><a href="category-view.php?ID=<?php echo $row['ID'];?>&CATEGORYNAME=<?php echo $row['CATEGORYNAME'];?>">
        <i class="fa fa-eye"></i></a></td>
		<td><a href="category-delete.php?ID=<?php echo $row['ID'];?>&CATEGORYNAME=<?php echo $row['CATEGORYNAME'];?>">
        <i class="fa fa-trash-alt"></i></a></td>
     </tr>
      <?php } }?>
   </tbody>
</table>
</div><!--container-fluid div -->
   
</body>
</html>