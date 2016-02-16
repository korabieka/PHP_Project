<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../include/Validation.php"); // deconnection already included in Validation
    // require_once("../include/dbconnection.php");
    
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
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = trim($_POST['email']);
    $uname = $_POST['username'];
	$pwd = trim($_POST['pwd']);
	$cpwd = trim($_POST['cpwd']);
	$rnum = $_POST['rnum'];
	$ext = $_POST['ext'];
	$suser = $_POST['suser'];
	if($vobj->ifUserExists($uname)){
		echo "User already exists";
		exit;
	}

	if($vobj->ifEmailExists($email)){
		echo "email already exists";
		exit;
	}

	if($pwd != $cpwd){
		echo "Passwords did not match";
		exit;
	}

	if(!$vobj->ifRoomExists($rnum)){
		echo "Room number : ".$rnum." does not exists in the system";
		exit;
	}
	else{
		$rid = $dbobj->getRoomId($rnum);
	}

	// if($vobj->ifExtExists($ext)){
	// 	echo "User already exists";
	// 	exit;
	// }


	// upload image
	$target_dir = "../images/user/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$imgname = $uname . "." . $imageFileType;
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


	$hpwd = md5($pwd);

	if($suser == 'true')
		$dbobj->Insert("insert into user values(null,'$uname','$email','$hpwd','$imgname',$rid,'$ext',1,'$fname','$lname',0)");
	else
		$dbobj->Insert("insert into user values(null,'$uname','$email','$hpwd','$imgname',$rid,'$ext',0,'$fname','$lname',1)");
		// echo "regular";
	header("location:".$_user."?uid=".$uid);	    
?>1