<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../include/Validation.php"); // deconnection already included in Validation
	    
    session_start();
    print_r($_POST);
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
    if(isset($_POST['cname'])){
    echo "Please enter the category name";
    }
	$_product = "../layout/add_product.php";
$category = $_POST['cname'];
$dbobj->Insert("insert into category (cname) values('".$category."')");
header("location:".$_product."?uid=".$uid);




?>
