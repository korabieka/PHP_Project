<?php
	$_product_controller = "../controller/add_product.php";
	require_once("../include/dbconnection.php");
	$dbobj = new dbconnection();
	session_start();
	$pid = $_GET['pid'];
	$categories = $dbobj->SelectColumn('cname','category',null,null);
	$pro_rec = $dbobj->Select("select `pname`,`price`,`cid`,`imgname` from product where `pid`='$pid'");
	$pro_rec = $pro_rec[0];

	$pname = $pro_rec['pname'];
	$price = $pro_rec['price'];
	$cid = $pro_rec['cid'];
	$imgname = $pro_rec['imgname'];

	$cname = $dbobj->SelectColumn("cname","category","cid",$cid);
	$cname = $cname[0];

	$_edit_product = "../../controller/edit_product.php";
?>
<html>
<head>
	<title></title>
	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 well">
				<h1 class="col-md-4">Add Product</h1>
					<div class="col-md-6"></div>
			</div>
		</div>
	</div>


	<div class="container">
	    <form role="form" method="post" id="frm" action="<?php echo $_edit_product ?>" enctype="multipart/form-data">
	        <div class="form-group">
	            <label class="col-md-2">Product name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="pname" name="pname" value="<?php echo $pname ?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2">Product price :</label>
	            <input class="col-md-10" type="number" min="0"class="form-control" id="price" name="price" value="<?php echo $price ?>">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Product category :</label>
	            <select name="category" class="col-md-10" selected="<?php echo $pname ?>">
	            	<?php foreach($categories as $category) if($cname == $category) echo "<option value='$category' selected='$cname'>$category </option>"; else echo "<option value='$category'>$category </option>";?>
	            </select>
	        </div>
	        <!-- <div class="form-group">
		        <label class="col-md-2" for="">Product image :</label>
		        <input class="col-md-10" type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $imgname ?>">
		    </div> -->
		    <br>
		    <div class="col-md-offset-2 row">
	        	<input type="submit" class="col-md-offet-2 btn btn-success" value="Edit">
	        	<input type="reset" class="col-md-offset-2 btn btn-danger" value="reset">
	        </div>
	    </form>
	</div>


	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>