<?php
	  require_once("../include/Validation.php"); // deconnection already included in Validation
	  $dbobj = new dbconnection();
	  $vobj = new Validation();
	  session_start();
	  //$uid = $_GET['uid'];
	  if(!isset($_SESSION['uid'])){
	    echo "You are not authoriezed to enter this page. You have to login first";
	    exit;
	  }
	  $uid = $_SESSION['uid'];
	  // $_SESSION['uid'] = $uid;
	  $activeusersArr = $dbobj->Select('select * from user,room where user.rid=room.rid');

	  $users = array();
	  foreach ($activeusersArr as $row) {
	    if(!$row['admin'])
	      array_push($users, $row['uname']);
	  }
	  // $users = $dbobj->SelectColumn('uname','user',null,null);
	  $rooms = $dbobj->SelectColumn('rname','room',null,null);
	  $uname = $dbobj->SelectColumn('uname','user','uid',$uid);
	  $uname = $uname[0];
	  $imgname = $dbobj->SelectColumn('imgname','user','uid',$uid);
	  $imgname = $imgname[0];
	  $img = "../images/user/".$imgname;
	  include("common/header.php");
?>
<html>
	
	<head>
		<meta charset="UTF-8">
		<title>Checks</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-1.11.2.js"></script>
		<script src="js/bootstrap.min.js"></script>
	  <script src="js/ManualOrders.js"></script>
	</head>
	
	<body>
		<div class="container">

			<div class="row">
				<div class="col-md-12 well">
					<h1 class="col-md-4">Checks</h1>
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
				<!--end-->
				<!--<h4>From Date:</h4>
				<input placeholder="From date" type="text" name='fdate' id='fdate'><br>
				<h4>To Date:</h4>
				<input placeholder="To date" type="text" name='tdate' id='tdate'><br><br>-->
				<div class = "row">
				<div class="col-md-6">
					<h4>Users: </h4>
					<select id="user" class="form-control">
						<?php foreach($users as $user) echo "<option value='$user'>$user </option>"?>
		    			</select><br>
				</div>
				</div>
				<input class= "btn-primary"type="button" value="Show Orders" onclick="getUsersOrders();" />
				</form> 
			</div><br>
		<!------------Users Table------------>
<div class='row'>
			<div class="col-md-12 well">
			<table id='userstab' class="table table-bordered table-striped col-md-offset-12 center-table">

			</table>
		<br> <br>
		
			</div>
		</div>
<!-----------------Details Table--------------------->
		<div class='row'>
			<div class="col-md-12 well">
			<table id='details' class="table table-bordered table-striped col-md-offset-12 center-table">

			</table>
		<br> <br>
		
			</div>
		</div>
<!---->
<div class='row'>
			<div class="col-md-12 well">
			<table id='oproducts' class="table table-bordered table-striped col-md-offset-12 center-table">

			</table>
		<br> <br>
		
			</div>
		</div>

		</div>
<!------------------My Script------------------------>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ourstyle.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="../layout/js/deliver_server.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	
	<script>
		$('.datepicker').datepicker();
	 </script>
<!--------------------------------------------------->
		<script>
	var orders_details;
	var uorders;
	var products;
	var mytr;
//------------------ Show Details ------------------------------
function show_details(v_uid){
	mytr="";
	if ($("#userstab").find("tr#"+v_uid).find("a#1").text() == " - "){
		$("#details").find("tr").remove();
		$("#userstab").find("tr#"+v_uid).find("a#1").text(" + ");
	}
	else{
	
		$("#userstab").find("tr#"+v_uid).find("a#1").text(" - ");
		$("#details").find("tr").remove();
		$("#details").append('<tr><th>Order Date</th> <th>Amount</th> </tr>');
		for(var i=0; i< orders_details.length; i++){

			mytr="";
			//------------ if condition to show specific user orders -----------
			if(orders_details[i].uid == v_uid){
				oid = orders_details[i].oid;
				mytr="";
				mytr += '<tr id='+oid+'>';
				mytr += '<td>'+ '<a id=1 onclick=show_products('+oid+');>'+' + '+'</a>'+ orders_details[i].odate + orders_details[i].otime + '</td>';
				mytr += '<td>'+ orders_details[i].totalamount +' EGP '+ '</td>';
				mytr +='</tr>';
				console.log(i);
			}
			$("#details").append(mytr);
		
		}
	}
		
}
//------------------ Show Orders -------------------------------
	function show_users(uorders){
		$("#userstab").find("tr").remove();
		$("#details").find("tr").remove();
		$("#oproducts").find("tr").remove();
		$("#userstab").append('<tr><th>Name</th> <th>Total amount</th> </tr>');
		for(var i=0; i< uorders.length; i++){
			uid = uorders[i].uid;
			mytr="";
			mytr += '<tr id='+uid+'>';
			mytr +='<td>'+uorders[i].uname;
			mytr +='<a id=1 onclick=show_details('+uid+');>'+' + '+'</a>'+'</td>';
			//mytr+= '<td>'+'<a></a>'+uorders[i].uname+'</td>';
			mytr+= '<td>'+uorders[i].total+' EGP '+'</td>';
			mytr+='</tr>';
		$("#userstab").append(mytr);
			
		}
		
	}
//------------------------getUsersOrders()-------------------------- 
	function getUsersOrders(){
		var v_fdate = $("#fdate").val();
		var v_tdate = $("#tdate").val();
		var v_name     = $("#user").val();
		$.ajax({
			url:"getUsersOrders.php",
			method:'get',
			data:{
				'fdate':v_fdate,
				'tdate':v_tdate,
				'uid':v_name
			},
			success:function(orders){
				//console.log(orders);
				show_users(orders['orders']);
				uorders = orders['orders'];
				orders_details = orders['orders_details'];
				products  = orders['products_details'];
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
	} //------------------ End function getUsersOrders -----------------
//-----------------------------show_products-------------------------
function show_products(oid){
	var counter=0;
	var mytr="";
	var imgsrc;
	var myOid= oid;
	//------------------- Adjust functionality -------------
	if ($("#details").find("tr#"+oid).find("a#1").text() == " - "){
		$("#oproducts").find("tr").remove();
		$("#details").find("tr#"+oid).find("a#1").text(" + ");
	}
	else{
		$("#details").find("tr#"+oid).find("a#1").text(" - ");

	//-------------------
	$("#oproducts").find("tr").remove();	
	//mytr='<tr>';
	for(var i=0; i<products.length; i++ ){
		if(counter%4 == 0)
			mytr+='<tr>';
		if(products[i].oid == oid){
			mytr += '<td>'+products[i].price+' EGP'+'<br>';
			imgsrc = "../images/product/"+products[i].imgname;
			mytr += '<img src="'+imgsrc+'" style="width:75px;height:75px;"> <br>';						
			mytr += products[i].pname+'<br>';
			mytr += products[i].qty+'<br>';
			mytr +='</td>';
		}
		counter++;
		
	}
	mytr+='</tr>';
	$('#oproducts').append( mytr );
	}
}
//---------------------------------------------------------
		</script>
	</body>
</html>
