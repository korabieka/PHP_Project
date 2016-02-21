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
            <h4 class="col-md-4">Reset your password</h4>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>
<form method="post" action="../controller/resetPassword.php">
<label>New Password</label>
<input type="password" name="password" value="" required/>
<label>Confirm your password</label>
<input type="password" name="confirmPassword" value="" required/>
</br>
<input type="submit" value="Confirm"/>
</form>
</body>
</html>
