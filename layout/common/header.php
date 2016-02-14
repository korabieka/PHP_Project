<?php
  $_home = "UserOrders.php";
  $_products = "products.php";
  $_users = "users.php";
  $_manual_orders = "ManualOrders.php?";
  $_checks = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bootstrap</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-1.11.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<!--Header-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Cafeteria</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?php echo $_home ?>">Home</a></li>
      <li><a href="<?php echo $_products ?>">Products</a></li> 
      <li><a href="<?php echo $_users ?>">Users</a></li>
      <li><a href="<?php echo $_manual_orders ?>">Manual Orders</a></li>
      <li><a href="#">Checks</a></li> 
    </ul>
    <div style="float:right">
    <ul class="nav navbar-nav">
    <li><img src="<?php echo $img ?>" width="60px" height="50px"/></li>
    <li><a href="#"><?php echo $uname ?></a></li>
	</ul>
	</div>  
  </div>
</nav>
<!--Body-->
<div class="container">


</div>
<!--Footer-->
<!-- <div class="navbar navbar-fixed-bottom" role="navigation">
<div class="navbar-text center-block">
<div><h4>Copy rights reserved for Eagles Team</h4></div>
</div>
</div> -->
</body>
</html>