<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../include/dbconnection.php");
    
    session_start();
	$dbobj = new dbconnection();
    $uid = $_SESSION['uid'];
	$_product = "../layout/products.php";
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $category = trim($_POST['category']);

    $cid = $dbobj->SelectColumn('cid','category','cname',$category);
    $cid = $cid[0];

	$products = $dbobj->SelectColumn('pname','product',null,null);
	foreach($products as $product)
		if($pname == $product){
			echo "product already exists";
			exit;
		}

	$dbobj->Update("update product set `pname`='$pname',`price`='$price',`cid`='$cid'");
	header("location:".$_product."?uid=".$uid);
?>