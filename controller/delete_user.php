<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	require_once("../include/Validation.php"); // deconnection already included in Validation
	$dbobj = new dbconnection();
	$vobj = new Validation();
	$_user = "../../layout/users.php";
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

	$duid = $_GET['uid'];

	if($uid == $duid){
		echo "You are not allowed to delete yourself";
		exit;
	}

	echo "before";
	// $dbobj->Delete("delete from `user` where `uid`='$duid'");
	$dbobj->Update("update user set `active`=false where `uid`='$duid'");

	echo "after";
	header("location:".$_user."?uid=".$uid);

?>