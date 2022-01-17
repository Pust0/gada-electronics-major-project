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
    <title>Users</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="../customCss/tables.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
  </head>
<body>
<?php include('navbar.php');?>
  <div class="container-fluid">
     <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-8">
        <h1>Users Information</h1>
     </div>
     <div class="col-lg-4 col-md-4 col-sm-4 col-4">
        <input type="button" onclick="window.location.href='users-add.php'" class="btn btn-info" value="Add Users">
     </div>
   </div> <!-- row div -->
<table>
   <thead>
    <tr>
     <th>Id</th>
     <th>Name</th>
     <th>Email</th>
     <th>Mobile</th>
     <th>Password</th>
     <th>Delete</th>
    </tr>
   </thead>
   <tbody>
     <?php 
         $sql = "SELECT * FROM normaluser";
         $result = mysqli_query($conn,$sql) or die("Select query not running"); 
          if(mysqli_num_rows($result)>0) {
             while($row = mysqli_fetch_assoc($result)) {
     ?>
     <tr>
        <td><?php echo $row['ID']; ?></td>
        <td><?php echo $row['NAME']; ?></td>
        <td><?php echo $row['EMAIL']; ?></td>
        <td><?php echo $row['PHONE']; ?></td>
        <td><?php echo $row['PASSWORD']; ?></td>
        <td><a href="users-delete.php?ID=<?php echo $row['ID'];?>">
        <i class="fa fa-trash-alt"></i></a></td>
     </tr>
      <?php } } ?>
   </tbody>
</table>
  </div>  <!--container fluid div -->
</body>
</html>