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
    $_products_img = "../images/product/";
    $_users_img = "../images/user/";

    $productsArr = $dbobj->getActiveProductsRecords();

    $_controller = "../controller/";
    $_layout = "../layout/";
    $_add_product = "../layout/add_product.php";
    $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
	$uname = $uname[0];
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
				<h1 class="col-md-4">All Products</h1>
					<div class="col-md-6"></div>
					<div class="col-md-2 well">
						<a href="<?php echo $_add_product ?>">
							<h4 align="center">Add Product</h4>
						</a>
				</div>
			</div>
		</div>
	</div>
	<table class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Product</th>
	        <th>Price</th>
	        <th>Image</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		foreach($productsArr as $row){
	    			$avb = $row['available']? "Available" : "Not available";
	    			echo "<tr>";
	    			echo "<td>".$row['pname']."</td>";
	    			echo "<td>".$row['price']."</td>";
	    			$imgpath = $_products_img.$row['imgname'];
	    			$pid = $row['pid'];
	    			echo "<td><img src='$imgpath' width='40' heigth='40'></img></td>";
	    			echo "<td><a href='$_controller/toggle_avb.php?pid=$pid'>".$avb."</a>&nbsp;|&nbsp;<a href='$_layout/edit_product.php?pid=$pid'>Edit</a>&nbsp;|&nbsp;<a href='$_controller/delete_product.php?pid=$pid'>Delete</a></td>";
	    		}
	    	?>

	      <!-- <tr>
	        <td>Tea</td>
	        <td>5 LE</td>
	        <td>()</td>
	        <td><a href="#">available</a>&nbsp;|&nbsp;<a href="#">Edit</a>&nbsp;|&nbsp;<a href="#">Delete</a></td>
	      </tr> -->
	  </tbody>
	</table>
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>