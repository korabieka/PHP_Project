<?php
require_once("../include/Validation.php"); // deconnection already included in Validation
session_start();
$notes = $_POST['notes'];
$room = $_POST['rooms'];
$total = $_POST['total'];
$user = $_POST['user'];
//echo $_POST['mokka'];

$dbobj = new dbconnection();
if(!isset($_SESSION['uid'])){
		echo "You are not authoriezed to enter this page. You have to login first";
		exit;
	}
$arr = $dbobj->Select("select pname from product where available=1");
//print_r($arr);
$product = array();
for($i=0 ; $i<count($arr) ; $i++){
	 $x = $arr[$i]['pname'];
	if(isset($_POST[$x]))
	{
		$product[$x]= $_POST[$x];
				
	}
}
//print_r($product);
$res = $dbobj->Select("select uid from user where uname='".$user."'");
$dbobj->Insert("insert into orders (uid,odate,notes,processing,totalamount,otime) values('".$res[0]['uid']."',CURDATE(),'".$notes."',1,'".$total."',CURTIME())");
foreach ($product as $key => $value) {
$arr = $dbobj->Select("select pid,price from product where pname = '".$key."'");
$arr2 = $dbobj->Select("select oid from orders order by oid desc limit 1");
 //print_r($arr[0]);
 echo $arr[0]['pid'];
 $dbobj->Insert("insert into order_detail (oid,pid,qty,pamount) values('".$arr2[0]['oid']."','".$arr[0]['pid']."','".$value."','".$arr[0]['price']."')");   
}
header('location: ../layout/ManualOrders.php');

?>
