
<?php
	error_reporting(E_ALL);
    	ini_set('display_errors', 1);
	// require_once("dbconnection.php");
	// $dbobj = new dbconnection();
	// $UID = 6;
	// //$res = $dbobj->Select("select * from user");
	// $res = $dbobj->SelectColumn("content","comment","UID",1);
	// foreach($res as $row)
	// 	echo $row."<br>";



	require_once("Validation.php"); // deconnection already included in Validation
	$vobj = new Validation();
	$dbobj = new dbconnection();	
	echo "sdasd";
	// $susersid = $this->dbobj->SelectColumn('uid','user','admin','true');
	$arr = array();
	$arr['0'] = 1;
	$arr['1'] = 2;
	$arr['2'] = 3;
	echo $arr[0];
	print_r($arr);
	$uid = 14;
	$susersid = $dbobj->SelectColumn('uid','user','admin',1);
	print_r($susersid);

	if($flag = $vobj->ifSuperUserId(14))
		echo "true";
	if($flag = $vobj->ifSuperUserId(20))
		echo "true<br>";
	echo "sdfsdf".$flag."<br>";
	$flag = $vobj->ifSuperUser("doubleo");
	echo "sdfsdf".$flag."<br>";

	echo "<br>";
	$susersid = $dbobj->SelectColumn('uid','user','admin',true);
	print_r($susersid);
	echo "<br>";


?>
