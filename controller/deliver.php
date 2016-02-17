<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	$_orders = "../layout/orders.php";
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

  	$oid = $_GET['oid'];

  	$flag = 0;
  	$dbobj->Update("update `orders` set `processing`=0 where `oid`='$oid'");

  	header("location:".$_orders."?uid=".$uid);
?>