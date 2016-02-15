<?php
	$_index = "../layout/index.php";
	session_start();
	unset($_SESSION['uid']);
	header("location:$_index");	    
?>