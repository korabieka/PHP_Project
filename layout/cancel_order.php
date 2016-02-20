<?php
	require("../include/dbconnection.php");
	error_reporting(E_ALL);
	$dbobj = new dbconnection();
	$oid = isset($_GET['oid'])?$_GET['oid']:0;
	//if($oid != -1)
	$upd_stm = "update orders set alive=0 where oid='$oid';";
	$dbobj->Update($upd_stm);
	$response="done";
	echo json_encode($response);
?>
