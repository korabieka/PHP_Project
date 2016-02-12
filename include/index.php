<?php
	error_reporting(E_ALL);
    	ini_set('display_errors', 1);
	require_once("dbconnection.php");
	$dbobj = new dbconnection();
	$UID = 6;
	//$res = $dbobj->Select("select * from user");
	$res = $dbobj->SelectColumn("content","comment","UID",1);
	foreach($res as $row)
		echo $row."<br>";

?>
