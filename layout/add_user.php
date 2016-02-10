<html>
<head>
	<title></title>
	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 well">
				<h1 class="col-md-4">Add User</h1>
					<div class="col-md-6"></div>
			</div>
		</div>
	</div>


	<div class="container">
	    <form role="form" method="post" id="frm" action='#' enctype="multipart/form-data" enctype="multipart/form-data">
	        <div class="form-group">
	            <label class="col-md-2">First Name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2">Last Name :</label>
	            <input class="col-md-10" type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Email :</label>
	            <input name="email" class="col-md-10" type="email" class="form-control" id="email" placeholder="Enter your email-address">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="username">Username :</label>
	            <input name="username" class="col-md-10" type="text" class="form-control" id="username" placeholder="Enter your username">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Password:</label>
	            <input name="pwd" class="col-md-10" type="password" class="form-control" id="pwd" placeholder="Enter password">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Confirm Password:</label>
	            <input name="cpwd" class="col-md-10" type="password" class="form-control" id="cpwd" placeholder="Confirm Password">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Room number :</label>
	            <input name="rnum" class="col-md-10" type="text" class="form-control" id="rnum" placeholder="Enter your room number">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Ext. :</label>
	            <input name="ext" class="col-md-10" type="text" class="form-control" id="ext" placeholder="Enter your extension number">
	        </div>
	        <div class="form-group">
	            <label class="col-md-2" for="pwd">Profile image :</label>
	            <input class="col-md-10" type="file" name="fileToUpload" id="fileToUpload">
	        </div>
	        <div class="row">&nbsp;</div>
	        <div class="col-md-offset-2 row">
	        	<input type="hidden" name="direction" value="register"/>
	        	<input type="submit" class="col-md-2 btn btn-primary" value="Submit">
	        	<input type="reset" class="col-md-2 btn btn-primary" value="reset">
	        </div>
	        
	    </form>
	</div>


	<!-- <table class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Name</th>
	        <th>Room</th>
	        <th>Image</th>
	        <th>Ext.</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>Omar Osama</td>
	        <td>223</td>
	        <td>()</td>
	        <td>5658</td>
	        <td><a href="#">Edit</a>&nbsp;|&nbsp;<a href="#">Delete</a></td>
	      </tr>
	  </tbody>
	</table> -->
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>