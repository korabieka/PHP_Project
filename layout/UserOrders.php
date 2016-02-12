<?php
require_once("../include/dbconnection.php");
$dbobj = new dbconnection();
$rooms = $dbobj->SelectColumn('rname','room',null,null);
session_start();
$_SESSION['uid'] = $_GET['uid'];
?>
<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bootstrap</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-1.11.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/ManualOrders.js"></script>
</head>
<body>
<!--Header-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Cafeteria</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Home</a></li>
      <li><a href="#">My Orders</a></li> 
    </ul>
    <div style="float:right">
    <ul class="nav navbar-nav img-responsive">
    <li><img class="img-circle" src="img/test.jpg" width="60px" height="50px"/></li>
    <li><a href="#">User</a></li>
	</ul>
	</div>  
  </div>
</nav>
<!--Body-->
<div class="container">
  <div class="row">
    <div class="col-sm-offset-10 col-sm-2">
      <div class="input-group">
    <input type="text" class="form-control"/>
    <span class="input-group-addon glyphicon glyphicon-search">
        <i class="fa fa-search"></i>
    </span>
</div>
      
    </div>
  </div>

  <div class="row">
    <div class="col-lg-5" style="" id="orders"> <!--Div For Orders-->
        <form role="form" method="" class="form-horizontal">
	<!--quantity w kda-->          

	<hr>
      <div class="form-group">
        <label class="control-label col-sm-2" for="notes">Notes</label>
        </div>
        <div class="form-group">
          <textarea class="form-control"></textarea>
        </div>
        <div class="form-group">
        <label class="control-label col-sm-2" for="room">Room</label>
        <select class="form-control col-sm-10">
          <?php foreach($rooms as $room) echo "<option value='$room'>$room </option>"?>
        </select>
        </div>
        <hr>
        <div class="form-group">
        <label class="control-label col-sm-offset-10 col-sm-2" for="price">Price</label>
        </div>
        <br>
        <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
          <input type="submit" class="btn btn-sm btn-default" value="Confirm">
        </div>
      </div>
        <!--hakammel hena-->
      </form>
    </div>
    <div class="col-lg-7">
      <label>Latest Order</label>
      <br>
      <div class="col-lg-12">
        <table class="table table-striped">
        <?php
	$imgCounter=0;
	$result = $dbobj->Select("select pname,imgname from product,orders,order_detail where product.pid=order_detail.pid and orders.oid=order_detail.oid and orders.uid='".$_SESSION['uid']."' order by odate desc limit 1");
	for($i=0;$i<count($result);$i++){
	if($imgCounter==0){echo "<tr>";}
		if($imgCounter!=2){
	echo "<td><figure><img src='img/products/".$result[$i]['imgname']."' width='200px' height='200px'/><figcaption align='center'>".$result[$i]['pname']."</figcaption></figure></td>";
		$imgCounter++;		
		}elseif($imgCounter==2){
			echo "<td><figure><img src='img/products/".$result[$i]['imgname']."' width='200px' height='200px'/><figcaption align='center'>".$result[$i]['pname']."</figcaption></figure></td></tr>";
			$imgCounter=0;
		}	
	}	
	?>
      </table>
      </div>
    <hr>
    <div class="col-lg-12 table-responsive">
      <table class="table table-striped">
      <?php
	$imgCounter=0;
	$result = $dbobj->Select("select * from product where available=1");
	for($i=0;$i<count($result);$i++){
	if($imgCounter==0){echo "<tr>";}
		if($imgCounter!=2){
	echo "<td><figure><img src='img/products/".$result[$i]['imgname']."' width='200px' height='200px'/><figcaption align='center'>".$result[$i]['pname']."-".$result[$i]['price']."</figcaption></figure></td>";
		$imgCounter++;		
		}elseif($imgCounter==2){
			echo "<td><figure><img src='img/products/".$result[$i]['imgname']."' width='200px' height='200px'/><figcaption align='center'>".$result[$i]['pname']."-".$result[$i]['price']."</figcaption></figure></td></tr>";
			$imgCounter=0;
		}	
	}	
	?>
      </table>
    </div>
    </div>
  </div>















</div>
<!--Footer-->
<div class="navbar navbar-fixed-bottom" role="navigation">
<div class="navbar-text center-block">
<div><h4>Copy rights reserved for Eagles Team</h4></div>
</div>
</div>
</body>
</html>
