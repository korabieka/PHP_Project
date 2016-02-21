<?php
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // require_once("../include/dbconnection.php");
    require_once("../include/Validation.php"); // deconnection already included in Validation
	$dbobj = new dbconnection();
	$vobj = new Validation();

    session_start();
    if(!isset($_SESSION['uid'])){
		echo "You are not authoriezed to enter this page. You have to login first";
		exit;
	}
    $uid = $_SESSION['uid'];

    $_users_img = "../images/user/";

    
    $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
	$uname = $uname[0];

	$imgname = $dbobj->SelectColumn('imgname','user','uid',$uid);
	$imgname = $imgname[0];

    $_controller = "../controller";
    $_layout = "../layout";
    $_add_user = "../layout/add_user.php";	
	$img = $_users_img.$imgname;

    include("common/regheader.php");
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Orders</title>
	<script src="js/jquery-1.11.2.js">
	</script>
		
	
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 well">
				<h1 class="col-md-4">My Orders</h1>
			</div>
		</div>
	
	<div class="row">
	 <form>
	  <!--start-->
				<div class="row">
					<div class="col-md-4"><h4>From Date:</h4></div>
					<div class="col-md-4"><h4>To Date:</h4></div>
				</div>	
				<!--end-->
				<!--start-->
				<div class="row">
				<div class="col-md-4"><input type="text" class="datepicker" id='fdate' placeholder="From Date" data-date-format="yyyy/mm/dd"></div>
							<div class="col-md-4"><input type="text" class="datepicker" id='tdate' placeholder="To Date" data-date-format="yyyy/mm/dd"></div>
						</div>
		
	  <br><input type="button" value="Show Orders" onclick="getOrders();" />
	 </form> 
	</div><br>
       
			<?php	
			echo "<div class='col-md-12'>";
			echo "<table id=ordersId class='table table-bordered table-striped col-md-offset-8 center-table'>";

			echo "<thead>";
			echo "<th>Order Date</th>";
			echo "<th>Status</th>";				    
			echo "<th>Amount</th>";
			echo "<th>Action</th>";
			echo "</thead>";
			echo "</table>";
			echo "</div>";
		?>
		<br> <br>
		<div class='row'>
			<table id='order_details' class="table table-bordered table-striped col-md-offset-8 center-table">
			</table>
		</div>
		<br> <br>
		<table id='order_details' class="table table-striped center-table">
			<td class='col-md-8'>
				<h3 id='totLabel'>Total</h3>
			</td>
			<td class='col-md-4' align="right">
				<h3 id='totalVal'></h3>
			</td>
		</table>
	</div>
<!---->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/ourstyle.css">
<script src="js/jquery-1.11.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- <script src="../layout/js/deliver_server.js"></script> -->
	<script src="js/bootstrap-datepicker.js"></script>
	
	<script>
		$('.datepicker').datepicker();
	 </script>
	<script>
	

//-------------------------
var orders_details;
var myOrders;
var total;
//------------------- show order details -------------
function show_details(oid){
	var counter=0;
	var mytr="";
	var imgsrc;
	var myOid= oid;
	//------------------- Adjust functionality -------------
	if ($("#ordersId").find("tr#"+oid).find("a#1").text() == " - "){
		$("#order_details").find("tr").remove();
		$("#ordersId").find("tr#"+oid).find("a#1").text(" + ");
	}
	else{
		$("#ordersId").find("tr#"+oid).find("a#1").text(" - ");

	//-------------------
	$("#order_details").find("tr").remove();	
	
	//mytr='<tr>';
	for(var i=0; i<orders_details.length; i++ ){
		if(counter%4 == 0)
			mytr+='<tr>';
		if(orders_details[i].oid == oid){
			mytr += '<td>'+orders_details[i].price+' EGP'+'<br>';
			imgsrc = "../images/product/"+orders_details[i].imgname;
			mytr += '<img src="'+imgsrc+'" style="width:75px;height:75px;"> <br>';						
			mytr += orders_details[i].pname+'<br>';
			mytr += orders_details[i].qty+'<br>';


			mytr +='</td>';
		}
		counter++;
		
	}
	mytr+='</tr>';
	$('#order_details').append( mytr );
	}
}
//--------------------------Show Orders -----------------------
function getDeliverdOrder(){
		var url = "../controller/deliver_server.php";
		$.ajax({
			url:url,
			method:'post',
			data:{
			},
			success:function(response){
				console.log(response);
				$('td[id='+response.oid+']').text("Out For Delivery");
				getDeliverdOrder();
			},
			error:function(err,status,error){
				console.log(error);
			},
			complete:function(complete){
				console.log("complete");
			},
			dataType:'json'
		});

	}
function show_order(ordersArr){
			total=0;
			var action="";
			var processing;
			var mytr ;
			// --- not to append on old query results
			$("#order_details").find("tr").remove();
			$("#ordersId").find("tr:gt(0)").remove();
			//-- for loop to create table -- 
			for ( var i = 0; i < ordersArr.length; i++ ) {
			mytr="";
			oid = ordersArr[i].oid;
			odate=ordersArr[i].odate;
			//------------ check processing ----------------//
			if (ordersArr[i].processing == 1){
				processing = "Processing";
				action = "<a onclick=cancelOrder("+oid+");>"+"CANCEL"+"</a>";
			}
			else if (ordersArr[i].processing == 0)
				processing = "Out for Delivery ";
			else if (ordersArr[i].processing == null)
				processing = "Done ";
			//----------------------------------------------
			mytr += '<tr id='+oid+'>';
			mytr +='<td width="40%">' +odate+" "+ordersArr[i].otime ;
			mytr +='<a id=1 onclick=show_details('+oid+');>'+' + '+'</a>'+'</td>'; // details click
			mytr+='<td id='+oid+'>' + processing + '</td>';
			mytr+='<td>' + ordersArr[i].totalamount +' EGP</td>'+'<td>' + action + '</td>';
			mytr+='</tr>';
			$('#ordersId').append( mytr );
			total+= parseInt(ordersArr[i].totalamount);
			}/////// end foor loop
			$('#totalVal').text('EGP '+total);
			getDeliverdOrder();
		}

//-------------------------Get Orders -------------------------
		
		function getOrders(){
    		var v_fdate = $("#fdate").val();
			var v_tdate  = $("#tdate").val();
			$.ajax({
				url:"get_orders.php",
				method:'get',
				data:{
					'fdate':v_fdate,
					'tdate':v_tdate
				},
				success:function(orders){
					console.log(orders);
					show_order(orders['orders']);
					myOrders = orders['orders'];
					orders_details = orders['orders_details'];
					console.log(orders_details);
					
				},
				error:function(Err,status,error){
					console.log(error);
				},
				complete:function(complete){
					console.log("Complete ");
				},
				dataType:'json',
				async:true

			});
		}
//------------------------ Cancel Order ---------------------
		function cancelOrder(v_oid){
			$.ajax({
				url:"cancel_order.php",
				method:'get',
				data:{
					'oid':v_oid
				},
				success:function(orders){
					console.log("cancelled");
					console.log($("#ordersId").find("tr#"+v_oid));
					$("#ordersId").find("tr#"+v_oid).remove();
					decrementTotal(v_oid);
				
				},
				error:function(Err,status,error){
					console.log(error);
				},
				complete:function(complete){
					console.log("Complete ");
				},
				dataType:'json',
				async:true

			});
		}// end cancel function 

//----------------------- Decrement Total -------------------------
		function decrementTotal(v_oid){
			for(var i=0; i< myOrders.length; i++ ){
				if(myOrders[i].oid == v_oid)
				total -= parseInt(myOrders[i].totalamount);
			}
			$('#totalVal').text('EGP '+total);
		}
</script>
</body>
</html>
