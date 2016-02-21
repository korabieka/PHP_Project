<?php
	$_category_controller = "../controller/add_category.php";
	// require_once("../include/dbconnection.php");
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
	$categories = $dbobj->SelectColumn('cname','category',null,null);
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
				<h1 class="col-md-4">Add Category</h1>
					<div class="col-md-6"></div>
			</div>
		</div>
	</div>


	<div class="container">
	    <form role="form" method="post" id="frm" action="<?php echo $_category_controller ?>" enctype="multipart/form-data">
	        <div class="form-group">
	            <label class="col-md-2">Category name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="cname" name="cname" placeholder="Enter category name">
	        </div>
	        		    <div class="col-md-offset-2 row">
	        	<input type="submit" class="col-md-offet-2 btn btn-success" value="Submit">
	        	<input type="reset" class="col-md-offset-2 btn btn-danger" value="reset">
	        </div>
	    </form>
	</div>


	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
