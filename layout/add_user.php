<?php

	$_user_controller = "../controller/add_user.php";
	require_once("../include/Validation.php"); // deconnection already included in Validation
	$dbobj = new dbconnection();
	$vobj = new Validation();
	session_start();
	//$uid = $_GET['uid'];
  	$uid = $_SESSION['uid'];
  	if(!$vobj->ifSuperUserId($uid)){
    	echo "You are not authoriezed to enter this page. Only for admins.";
    	exit;
    }
	//$uid = $_GET['uid'];
	// $categories = $dbobj->SelectColumn('cname','category',null,null);
	$rooms = $dbobj->SelectColumn('rname','room',null,null);
	$uname = $dbobj->SelectColumn('uname','user','uid',$uid);
	$uname = $uname[0];
	$img = "img/users/".$uname.".jpeg";
	include("common/header.php");
?>
<html>
<head>
	<title></title>
	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 well">
				<h1 class="col-md-4">Add User</h1>
					<div class="col-md-6"></div>
			</div>
		</div>
	</div>


	<div class="container">		
	    <form role="form" method="post" id="frm" action="<?php echo $_user_controller ?>" enctype="multipart/form-data">
	        <div class="form-group">
	            <label class="col-md-2">First Name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2">Last Name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Email :</label>
	            <input name="email" class="col-md-10" type="email" class="form-control" id="email" placeholder="Enter your email-address">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Username :</label>
	            <input name="username" class="col-md-10" type="text" class="form-control" id="username" placeholder="Enter your username">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Password:</label>
	            <input name="pwd" class="col-md-10" type="password" class="form-control" id="pwd" placeholder="Enter password">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Confirm Password:</label>
	            <input name="cpwd" class="col-md-10" type="password" class="form-control" id="cpwd" placeholder="Confirm Password">
	        </div>
	        <div class="form-group row">
	            <label class="col-md-2" for="pwd">Room number :</label>	            
		        <select name="rnum" class="col-md-6">
		          <?php foreach($rooms as $room) echo "<option value='$room'>$room </option>"?>
		        </select>
		        <div class="col-md-2"><a href="addRoom.php">Add Room </a></div>
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Ext. :</label>
	            <input name="ext" class="col-md-10" type="text" class="form-control" id="ext" placeholder="Enter your extension number">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pimg">Profile image :</label>
	            <input class="col-md-10" type="file" name="fileToUpload" id="fileToUpload">
	        </div>
	        <div class="row">&nbsp;</div>
	        <div class="form-group">
	        	<label class="col-md-2" for="type">Acoount Type :</label>
	        	<label class="radio-inline"><input type="radio" name="suser" value="true">Admin</label>
				<label class="radio-inline"><input type="radio" name="suser" value="false">Regular</label>
	        </div>
	        <div class="col-md-offset-2 row">
	        	<input type="hidden" name="direction" value="register"/>
	        	<input type="submit" class="col-md-2 btn btn-primary" value="Submit">
	        	<input type="reset" class="col-md-2 btn btn-primary" value="reset">
	        </div>
	        
	    </form>
	</div>


	<!-- <table class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Name</th>
	        <th>Room</th>
	        <th>Image</th>
	        <th>Ext.</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>Omar Osama</td>
	        <td>223</td>
	        <td>()</td>
	        <td>5658</td>
	        <td><a href="#">Edit</a>&nbsp;|&nbsp;<a href="#">Delete</a></td>
	      </tr>
	  </tbody>
	</table> -->
	
	
  	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-1.11.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>