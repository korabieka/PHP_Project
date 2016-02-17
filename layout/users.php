<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // require_once("../include/dbconnection.php");
    require_once("../include/Validation.php"); // deconnection already included in Validation
	$dbobj = new dbconnection();
	$vobj = new Validation();

    session_start();
    if(!isset($_SESSION['uid'])){
		echo "You are not authoriezed to enter this page. You have to login first";
		exit;
	}
    $uid = $_SESSION['uid'];
    if(!$vobj->ifSuperUserId($uid)){
	    echo "You are not authoriezed to enter this page. Only for admins.";
	    exit;
  	}
    $_users_img = "../images/user/";
    $activeusersArr = $dbobj->Select('select * from user,room where user.rid=room.rid');

    $usersArr = array();
    foreach ($activeusersArr as $row) {
    	if(!$row['admin'])
    		array_push($usersArr, $row);
    }


    $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
	$uname = $uname[0];


    $_controller = "../controller";
    $_layout = "../layout";
    $_add_user = "../layout/add_user.php";	
	$img = $_users_img.$uname.".jpeg";

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
				<h1 class="col-md-4">All Users</h1>
					<div class="col-md-6"></div>
					<div class="col-md-2 well">
						<a href="<?php echo $_add_user ?>">
							<h4 align="center">Add User</h4>
						</a>
				</div>
			</div>
		</div>
	</div>
	<table class="table table-bordered table-striped">
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
	    	<?php
	    		foreach($usersArr as $row){
	    			echo "<tr>";
	    			echo "<td>".$row['uname']."</td>";
	    			echo "<td>".$row['rname']."</td>";
	    			$imgpath = $_users_img.$row['imgname'];
	    			echo "<td><img src='$imgpath' width='80' heigth='80'></img></td>";
	    			echo "<td>".$row['ext']."</td>";
	    			$uid = $row['uid'];
	    			echo "<td><a href='$_layout/edit_user.php?uid=$uid'>Edit</a>&nbsp;|&nbsp;<a href='$_controller/delete_user.php?uid=$uid'>Delete</a></td>";
	    		}
	    	?>

	      
	  </tbody>
	</table>
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>