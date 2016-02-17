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
  	if(!$vobj->ifSuperUserId($uid)){
    	echo "You are not authoriezed to enter this page. Only for admins.";
    	exit;
    }
	$edtuid = $_GET['uid'];


	$edt_rec = $dbobj->Select("select `uname`,`email`,`rid`,`ext`,`fname`,`lname` from user where `uid`='$edtuid'");
	$edt_rec = $edt_rec[0];

	$uname = $edt_rec['uname'];
	$email = $edt_rec['email'];
	$rid = $edt_rec['rid'];
	$ext = $edt_rec['ext'];	
	$fname = $edt_rec['fname'];
	$lname = $edt_rec['lname'];
	$rname = $dbobj->SelectColumn('rname','room','rid',$rid);
    $rname = $rname[0];
	
	$_edit_user = "../controller/edit_user.php";
	
?>
<html>
<head>
	<title></title>
	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 well">
				<h1 class="col-md-4">Edit User</h1>
					<div class="col-md-6"></div>
			</div>
		</div>
	</div>


	<div class="container">		
	    <form role="form" method="post" id="frm" action="<?php echo $_edit_user ?>" >
	        <div class="form-group">
	            <label class="col-md-2">First Name :</label>
	            <input class="col-md-10" type="text" id="fname" name="fname" value="<?php echo  $fname?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2">Last Name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname ?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Email :</label>
	            <input name="email" class="col-md-10" type="email" class="form-control" id="email" value="<?php echo $email ?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Username :</label>
	            <input name="username" class="col-md-10" type="text" class="form-control" id="username" value="<?php echo $uname ?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Room number :</label>
	            <input type="hidden" name="rid" value="<?php echo $rid ?>"/>
	            <input name="rnum" class="col-md-10" type="text" class="form-control" id="rnum" value="<?php echo $rname ?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Ext. :</label>
	            <input name="ext" class="col-md-10" type="text" class="form-control" id="ext" value="<?php echo $ext ?>">
	        </div>
	        
	        <div class="col-md-offset-2 row">
	        	<input type="hidden" name="edtuid" value="<?php echo $edtuid ?>"/>
	        	<input type="submit" class="col-md-2 btn btn-primary" value="Submit">
	        	<input type="reset" class="col-md-2 btn btn-primary" value="reset">
	        </div>


	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>