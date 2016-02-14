<?php
	$_admin_order = "../layout/ManualOrders.php";
	$_user_order = "../layout/UserOrders.php";
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
	require_once("../include/Validation.php"); // deconnection already included in Validation
	$dbobj = new dbconnection();
	$vobj = new Validation();

	$crruname = trim($_POST['username']);
	$crrpwd = md5(trim($_POST['pwd']));

	if(!$vobj->ifUserExists($crruname)){
		echo "User not found";
		exit;
	}

	$urecord = $dbobj->Select("select `uid`,`password`,`admin` from `user` where `uname`='$crruname'");
	$urecord = $urecord[0];

	if($crrpwd != $urecord['password']){
		echo "Passwords did not match";
		exit;
	}
	
	$_SESSION['uid'] = $urecord['uid'];
	if($urecord['admin'])
		header("location:".$_admin_order."?uid=".$urecord['uid']);
	else
		header("location:".$_user_order."?uid=".$urecord['uid']);
	// print_r($urecord);
// ?>