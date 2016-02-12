<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../include/dbconnection.php");
    
    session_start();
    print_r($_POST);
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

    // upload image
	$target_dir = "../images/product/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	print_r($_FILES["fileToUpload"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$imgname = $pname . "." . $imageFileType;
	$target_file = $target_dir . $imgname;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	echo $imageFileType."<br>";
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	    exit;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	    exit;
	// if everything is ok, try to upload file
	} else {
	    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "Sorry, there was an error uploading your file.";
	        exit;
	    }
	}
	echo "before";
	$dbobj->Insert("insert into `product` values(null,'$pname','$price','$cid','$imgname',true)");
	echo "after";
	header("location:".$_product."?uid=".$uid);
?> 