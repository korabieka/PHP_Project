<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	require_once("../include/dbconnection.php");
	$dbobj = new dbconnection();
	$_product = "../../layout/products.php";
	session_start();
	$uid = $_SESSION['uid'];

	$pid = $_GET['pid'];

	$dbobj->Delete("delete from `product` where `pid`='$pid'");
	header("location:".$_product."?uid=".$uid);

?>