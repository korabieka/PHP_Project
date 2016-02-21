<?php
	require("../include/dbconnection.php");
	error_reporting(E_ALL);
	$fdate = isset($_GET['fdate'])?$_GET['fdate']:-1;
	$tdate = isset($_GET['tdate'])?$_GET['tdate']:-1;
	$uid   = isset($_GET['uid'])?$_GET['uid']:-1;
	//print_r($tdate);
	$dbobj = new dbconnection();
	//-----------------------p1_where for query----------------
	$p1_where =" where orders.uid = user.uid and alive= 1 ";
	if($fdate != null)
		$p1_where .=" and `odate` >= '$fdate' ";
	if($fdate != null)
		$p1_where .=" and `odate` <= '$tdate' ";
	if($uid != null)
		$p1_where .=" and `uname` = '$uid' ";       
	$p1_where .= " group by user.uid; ";
	//-----------------
	$query = "select user.uid uid,uname,sum(totalamount)total from orders,user".$p1_where;
	$orders = $dbobj->Select($query);
	//-----------------------p2_where for query----------------
	$p2_where =  " where orders.uid = user.uid ";
	if($fdate != null)
		$p2_where .=" and `odate` >= '$fdate' ";
	if($fdate != null)
		$p2_where .=" and `odate` <= '$tdate' ";
	if($uid != null)
		$p2_where .=" and `uname` = '$uid' "; 
	$p2_where .="; ";
	$details_query = " select user.uid,oid,odate,time_format(otime,'%h:%i %p') otime,totalamount from orders,user ".$p2_where;
	$order_details = $dbobj->Select($details_query);
	//-----------------------------------
	$products_query = " select oid,pname,price,imgname,qty from product,order_detail where product.pid = order_detail.pid;";
	$products_details = $dbobj->Select($products_query);
	//-----------------------------------
	$response = array();
	$response['orders'] = $orders;
	$response['orders_details'] = $order_details;
	$response['products_details'] = $products_details;
	//$response.orders= $orders;
	//-----------------------------------
	echo json_encode($response);
?>
