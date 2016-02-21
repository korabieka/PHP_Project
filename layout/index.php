<?php
    // $_DOCUMENT_ROOT = $_SERVER['document_root'];
    // echo $_DOCUMENT_ROOT;
    $_login_controller = "../controller/login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

</head>
<body>

<hr>

<div class="container">
    <div class="row">
        <div class="col-md-12 well">
            <h1 class="col-md-4">Login</h1>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>

<div class="container">
    <form role="form" method="post" id="frm" action="<?php echo $_login_controller ?>">
    <!-- <form role="form" method="post" id="frm" action="login_.php"> -->
        <div class="form-group">
            <label class="col-md-2">Username or email:</label>
            <input class="col-md-10" type="text" class="form-control" id="username" name="username" placeholder="Type your username or email">
        </div>
        <div class="form-group">
            <label class="col-md-2">Password :</label>
            <input class="col-md-10" type="password" class="form-control" id="pwd" name="pwd" placeholder="Type your password"></input>
        </div>
        <input type="hidden" name="direction" value="login"/>
        <input type="submit" class="col-md-offset-2 btn btn-default" value="Submit"/>
        <a href="forgetPassword.php">Forget Password?</a>
        

    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!-- Latest compiled JavaScript -->
<!--<script src="js/jquery-1.11.2.js"></script>-->
<script src="js/script.js"></script>


<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
