<?php
	$_admin_order = "../layout/ManualOrders.php";
	$_user_order = "../layout/UserOrders.php";
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	require_once("../include/dbconnection.php");
	$dbobj = new dbconnection();
	
	$crruname = trim($_POST['username']);
	$crrpwd = md5(trim($_POST['pwd']));

	$users = $dbobj->SelectColumn('uname','user',null,null);
	print_r($users);

	$uflag = false;
	foreach($users as $uname)
		if($crruname == $uname){
			$uflag = true;
			break;
		}

	if(!$uflag){
		echo "User not found";
		exit;
	}

	$urecord = $dbobj->Select("select `uid`,`password`,`admin` from `user` where `uname`='$crruname'");
	$urecord = $urecord[0];

	if($crrpwd != $urecord['password']){
		echo "Passwords did not match";
		exit;
	}

	if($urecord['admin'])
		header("location:".$_admin_order."?uid=".$urecord['uid']);
	else
		header("location:".$_user_order."?uid=".$urecord['uid']);
	// print_r($urecord);
// ?>