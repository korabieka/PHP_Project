<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../include/Validation.php"); // deconnection already included in Validation
    
    session_start();
	$dbobj = new dbconnection();
	$vobj = new Validation();

    if(!isset($_SESSION['uid'])){
		echo "You are not authoriezed to enter this page. You have to login first";
		exit;
	}
	$uid = $_SESSION['uid'];
    if(!$vobj->ifSuperUserId($uid)){
    	echo "You are not authoriezed to enter this page. Only for admins.";
    	exit;
    }
	$_product = "../layout/products.php";
	$pid = $_POST['pid'];
	echo $pid;
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $category = trim($_POST['category']);

    $cid = $dbobj->SelectColumn('cid','category','cname',$category);
    print_r($cid);
    $cid = $cid[0];

	$products = $dbobj->SelectColumn('pname','product',null,null);
	foreach($products as $product)
		if($pname == $product){
			echo "product already exists";
			exit;
		}

	$dbobj->Update("update product set `pname`='$pname',`price`='$price',`cid`='$cid' where `pid`='$pid'");

	header("location:".$_product."?uid=".$uid);
?>