<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	require_once("../include/dbconnection.php");
	$dbobj = new dbconnection();
	$_product = "../../layout/products.php";
	session_start();
	$uid = $_SESSION['uid'];

	$pid = $_GET['pid'];

	$avb = $dbobj->SelectColumn('available','product','pid',$pid);
	$avb = $avb[0];
	$avb = ! $avb;
	$dbobj->Update("update product set `available`='$avb' where `pid`='$pid'");
	header("location:".$_product."?uid=".$uid);

?>