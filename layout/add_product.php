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
	    <form role="form" method="post" id="frm" action='#' enctype="multipart/form-data" enctype="multipart/form-data">
	        <div class="form-group">
	            <label class="col-md-2">Product name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="fname" name="fname" placeholder="Enter product name">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2">Product price :</label>
	            <input class="col-md-10" type="number" min="0"class="form-control" id="lname" name="lname" placeholder="Enter product price">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Product category :</label>
	            <select class="col-md-10">
	            	<option>option 1</option>
	            	<option>option 2</option>
	            	<option>option 3</option>
	            </select>
	        </div>
	        <div class="form-group">
		        <label class="col-md-2" for="pwd">Product image :</label>
		        <input class="col-md-10" type="file" name="fileToUpload" id="fileToUpload">	        
		    </div>
		    <div class="col-md-offset-2 row">
	        	<input type="hidden" name="direction" value="register"/>
	        	<input type="submit" class="col-md-2 btn btn-primary" value="Submit">
	        	<input type="reset" class="col-md-2 btn btn-primary" value="reset">
	        </div>
	    </form>
	</div>


	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>