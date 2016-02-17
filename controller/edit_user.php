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
	$_user = "../layout/users.php";
	$edtuid = $_POST['edtuid'];
	$rid = $_POST['rid'];

	$uname = $_POST['username'];
	$email = $_POST['email'];
	$rname = $_POST['rnum'];
	$ext = $_POST['ext'];	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
    
	if($vobj->ifUserExists($uname)){
		echo "Ussser already exists";
		exit;
	}

	if($vobj->ifEmailExists($email)){
		echo "email already exists";
		exit;
	}

	// if($pwd != $cpwd){
	// 	echo "Passwords did not match";
	// 	exit;
	// }

	if(!$vobj->ifRoomExists($rname)){
		echo "Room number : ".$uname." does not exists in the system";
		exit;
	}

	$rid = $dbobj->getRoomId($rname);
	echo "before";
	$dbobj->Update("update user set `uname`='$uname',`email`='$email',`rid`='$rid',`ext`='$ext' where `uid`='$edtuid'");
	echo "after";
	header("location:".$_user);
?>