<?php
	require("../include/dbconnection.php");
	error_reporting(E_ALL);
	$fdate = isset($_GET['fdate'])?$_GET['fdate']:0;
	$tdate = isset($_GET['tdate'])?$_GET['tdate']:0;
	//print_r($tdate);
	$dbobj = new dbconnection();
//--------------- Check from Date to date -----------        
	if($fdate == 0 && $tdate==0)
		$query = "select oid,uid,odate,notes,processing,totalamount,time_format(otime,'%h:%i %p') otime ,alive from `orders` where alive=1";
	elseif($fdate == 0)
		$query = "select oid,uid,odate,notes,processing,totalamount,time_format(otime,'%h:%i %p') otime ,alive from `orders` where `odate` <= '$tdate' " ;
	elseif($tdate == 0)
		$query = "select oid,uid,odate,notes,processing,totalamount,time_format(otime,'%h:%i %p') otime ,alive from `orders` where `odate` >= '$fdate' " ;		
	else
		$query = "select `oid`,`uid`,`odate`,`notes`,`processing`,`totalamount`,time_format(otime,'%h:%i %p') otime,`alive` from `orders` where `odate` >= '$fdate' and `odate` <= '$tdate' and alive=1" ;
	$orders = $dbobj->Select($query);
	//-----------------------------------
	$details_query = " select oid,pname,price,imgname,qty from product,order_detail where product.pid = order_detail.pid;";
	$order_details = $dbobj->Select($details_query);
	$response = array();
	$response['orders'] = $orders;
	$response['orders_details'] = $order_details;
	//$response.orders= $orders;
	//-----------------------------------
	echo json_encode($response);
?>
