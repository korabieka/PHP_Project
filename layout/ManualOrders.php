<?php
  require_once("../include/Validation.php"); // deconnection already included in Validation
  $dbobj = new dbconnection();
  $vobj = new Validation();
  session_start();
  //$uid = $_GET['uid'];
  if(!isset($_SESSION['uid'])){
    echo "You are not authoriezed to enter this page. You have to login first";
    exit;
  }
  $uid = $_SESSION['uid'];
  // $_SESSION['uid'] = $uid;
  $users = $dbobj->SelectColumn('uname','user',null,null);
  $rooms = $dbobj->SelectColumn('rname','room',null,null);
  $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
  $uname = $uname[0];
  $imgname = $dbobj->SelectColumn('imgname','user','uid',$uid);
  $imgname = $imgname[0];
  $img = "../images/user/".$imgname;
  include("common/header.php");
?>

<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Manual Orders</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<!--Header-->
<!-- <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Cafeteria</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Home</a></li>
      <li><a href="#">Products</a></li> 
      <li><a href="#">Users</a></li>
      <li class="active"><a href="#">Manual Orders</a></li>
      <li><a href="#">Checks</a></li> 
    </ul>
    <div style="float:right">
    <ul class="nav navbar-nav img-responsive">
    <li><img class="img-circle" src="img/test.jpg" width="60px" height="50px"/></li>
    <li><a href="#">Admin</a></li>
	</ul>
	</div>  
  </div>
</nav> -->
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
    <div class="col-lg-5" id="orders"> <!--Div For Orders-->
        <form role="form" method="post" action="../controller/ManualOrders.php" id="orderForm" class="form-horizontal">
          <!--HERE-->
          <hr>
      <div class="form-group">
        <label id="notes" class="control-label" for="notes">Notes</label>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="notes"></textarea>
        </div>
        <div class="form-group">
        <label class="control-label">Add To User</label>
      <select name="user" class="form-control col-sm-10"">
        <?php foreach($users as $user) echo "<option value='$user'>$user </option>"?>
    </select>
    </div>
	<br>
        <div class="form-group">
        <label class="control-label" for="room">Room</label>
        <select class="form-control col-sm-10">
          <?php foreach($rooms as $room) echo "<option value='$room'>$room </option>"?>
        </select>
        </div>
        <hr>
        <div class="form-group">
        <label id="totalPrice" class="control-label col-sm-offset-10 col-sm-2" for="price">0 EGP</label>
        <input type="hidden" name="total" id="hiddenTotal" value=""/>
        </div>
        <br>
        
        <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
          <input type="submit" class="btn btn-sm btn-default" value="Confirm">
        </div>
      </div>
      </form>
    </div>
    <div class="col-lg-7">
          <hr>
    <div class="col-lg-12 table-responsive">
      <table id="drinksTbl" class="table table-striped">
	<?php
	$imgCounter=0;
	$result = $dbobj->Select("select * from product where available=1");
	for($i=0;$i<count($result);$i++){
	if($imgCounter==0){echo "<tr>";}
		if($imgCounter!=2){
//<<<<<<< HEAD
	echo "<td><figure><img class='pimage' src='../images/product/".$result[$i]['imgname']."' width='200px' height='200px'/><figcaption align='center'>".$result[$i]['pname']."<input type='hidden' id='pLbl".$i."' value='".$result[$i]['pname']."'/>"."-".$result[$i]['price']."<input type='hidden' id='priceLbl".$i."' value='".$result[$i]['price']."'/>"."</figcaption></figure></td>";
		$imgCounter++;		
		}elseif($imgCounter==2){
			echo "<td><figure><img class='pimage' src='../images/product/".$result[$i]['imgname']."' width='200px' height='200px'/><figcaption align='center'>".$result[$i]['pname']."<input type='hidden' id='pLbl".$i."' value='".$result[$i]['pname']."'/>"."-".$result[$i]['price']."<input type='hidden' id='priceLbl".$i."' value='".$result[$i]['price']."'/>"."</figcaption></figure></td></tr>";
//=======
			$imgCounter=0;
		}	
	}	
	?>
      </table>
    </div>
    </div>
  </div>
</div>
<!--Footer
<div class="navbar navbar-fixed-bottom" role="navigation">
<div class="navbar-text center-block">
<div><h4>Copy rights reserved for Eagles Team</h4></div>
</div>
</div>-->
	<script src="js/jquery-1.11.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/ManualOrders.js"></script>
</body>
</html>
