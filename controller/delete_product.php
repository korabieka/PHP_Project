<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	require_once("../include/Validation.php"); // deconnection already included in Validation
	$dbobj = new dbconnection();
	$vobj = new Validation();
	$_product = "../../layout/products.php";
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

	$pid = $_GET['pid'];

	$dbobj->Update("update product set `active`=false where `pid`='$pid'");
	header("location:".$_product."?uid=".$uid);

?>