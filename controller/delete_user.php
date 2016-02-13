<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	require_once("../include/dbconnection.php");
	$dbobj = new dbconnection();
	$_user = "../../layout/users.php";
	session_start();
	$uid = $_SESSION['uid'];

	$duid = $_GET['uid'];

	if($uid == $duid){
		echo "You are not allowed to delete yourself";
		exit;
	}

	echo "before";
	$dbobj->Delete("delete from `user` where `uid`='$duid'");
	echo "after";
	header("location:".$_user."?uid=".$uid);

?>