<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
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
    $_products_img = "../images/product/";
    $activeusersArr = $dbobj->Select('select * from user,room where user.rid=room.rid');

    $usersArr = array();
    foreach ($activeusersArr as $row) {
    	if(!$row['admin'])
    		array_push($usersArr, $row);
    }



    $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
	$uname = $uname[0];

	$imgname = $dbobj->SelectColumn('imgname','user','uid',$uid);
	$imgname = $imgname[0];

    $_controller = "../controller";
    $_layout = "../layout";
    $_add_user = "../layout/add_user.php";	
	$img = $_users_img.$imgname;
	$processingOrders = $dbobj->Select('select uname,rname,odate,ext,otime,user.uid,orders.oid,user.imgname from user,room,orders where user.uid=orders.uid AND user.rid=room.rid AND orders.processing=true;');
	



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
				<h1 class="col-md-4">Orders</h1>
			</div>
		</div>
	</div>
	    	<?php
	    		foreach($processingOrders as $row){
	    			$oid = $row['oid'];
	    			$uid = $row['uid'];
	    			echo "<div class='container' id='$oid'>";	
	    			echo "<table class='table table-bordered table-striped col-md-offset-8 center-table'>";
				    echo "<thead>";
				    echo "<tr>";
				    // echo "<th>Order Date</th>";
				    echo "<th>Name</th>";
				    echo "<th>Room</th>";				    
				    echo "<th>Image</th>";
				    echo "<th>Ext.</th>";
				    echo "<th>Action</th>";
				    echo "</tr>";
				    echo "</thead>";
	    			echo "<tr>";
	    			// echo "<td>".$row['odate']."</td>";
	    			echo "<td>".$row['uname']."</td>";
	    			echo "<td>".$row['rname']."</td>";
	    			$imgpath = $_users_img.$row['imgname'];
	    			echo "<td><img src='$imgpath' width='80' heigth='80'></img></td>";
	    			echo "<td>".$row['ext']."</td>";
	    			echo "<td id='$oid'><a id='$oid' uid='$uid' name='ancor' href='$_controller/deliver.php?oid=$oid'>Deliver</a></td>";
	    			echo "</tbody>";
					echo "</table>";
					$imgpath = $_products_img.$row['imgname'];
					
					// $pids = $dbobj->SelectColumn
					// $processingOrders = $dbobj->Select("select `imgname`,`pname` from `product` where `uid`='$uid'");
					$processingProducts = $dbobj->Select('select product.pid,pname,imgname,price,qty from product,order_detail where oid='.$oid.' AND order_detail.pid=product.pid');
					// echo "<div class='container in-line'>";
					echo "<br>";
					echo "<table id='dlstbl' class='table table-bordered table-striped col-md-offset-8 center-table'>";
					echo "<tr>";
					foreach ($processingProducts as $row) {
						$impath = $_products_img.$row['imgname'];
						$pname = $row['pname'];
						$qty = $row['qty'];
						$price = $row['price'];
						echo "<td class='inline'><h1>$ $price</h1><div class ='vertpan pic'><figure><img class='aligncenter' width='80' heigth='80' src='$impath'/><figcaption>$pname</figcaption></figure></div><h1>x $qty</h1></td>";		
					}
					echo "</tr>";
					echo "</table>";
					echo "</div>";
					echo "<br>";
	    		}
	    		
	    	?>

	      
	  </tbody>
	</table>
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ourstyle.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="../layout/js/cancel_server.js"></script>
</body>
</html>