<?php
  require_once("../include/dbconnection.php");
  $dbobj = new dbconnection();
  session_start();
  $uid = $_GET['uid'];
  $_SESSION['uid'] = $uid;
  $users = $dbobj->SelectColumn('uname','user',null,null);
  $rooms = $dbobj->SelectColumn('rname','room',null,null);
  $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
  $uname = $uname[0];
  $img = "img/users/".$uname.".jpeg";
  include("common/header.php");
?>

<!DOCTYPE h<!-- <!-- <!-- tml> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Manual Orders</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-1.11.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/ManualOrders.js"></script>
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
    <div class="col-lg-5" style="border:1px solid black" id="orders"> <!--Div For Orders-->
        <form role="form" method="" class="form-horizontal">
          <!--HERE-->
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
      </form>
    </div>
    <div class="col-lg-7">
      <label>Add To User</label>
      <br>
      <select class="form-control">
        <?php foreach($users as $user) echo "<option value='$user'>$user </option>"?>
    </select>
    <hr>
    <div class="col-lg-12 table-responsive" style="border:1px solid black">
      <table class="table table-striped">

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