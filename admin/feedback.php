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
    <title>Feedback</title>
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
     <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h1>User's Feedback</h1>
     </div>
     
   </div> <!-- row div -->
<table>
   <thead>
    <tr>
     <th>Id</th>
     <th>Name</th>
     <th>Email-Id</th>
     <th>Mobile No.</th>
	 <th>Message</th>
	 <th>View</th>
	 <th>Delete</th>
    </tr>
   </thead>
   <tbody>
     <?php  
         $sql1 = "SELECT * FROM feedback";
         $result1 = mysqli_query($conn, $sql1) or die("feedback Query Not Running");
         if(mysqli_num_rows($result1)>0) {
             while($row1 = mysqli_fetch_assoc($result1)) {
     ?>
     <tr>
        <td><?php echo $row1['ID']; ?></td>
        <td><?php echo $row1['NAME']; ?></td>
		<td><?php echo $row1['EMAIL']; ?></td>
		<td><?php echo $row1['PHONE']; ?></td>
		<td class="text-turncate"><?php echo $row1['MESSAGE']; ?></td>
        <td><a href="feedback-view.php?ID=<?php echo $row1['ID'];?>">
        <i class="fa fa-pencil-alt"></i></a></td>
        <td><a href="feedback-delete.php?ID=<?php echo $row1['ID'];?>">
        <i class="fa fa-trash-alt"></i></a></td>
     </tr>
      <?php } }?>
   </tbody>
</table>
</div>   <!-- container-fluid div -->
</body>
</html>