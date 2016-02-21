<?php
  require_once("../include/Validation.php"); // deconnection already included in Validation
  $dbobj = new dbconnection();
  $vobj = new Validation();
  session_start();
if(!isset($_POST['username'])){
echo "please back and enter the user name";
exit;
}
$_SESSION['username'] = $_POST['username'];
$arr = $dbobj->SelectColumn("email","user","uname",$_POST['username']);
if(count($arr) == 0){
echo "User Name is not exist";
exit;
}
$email = $arr[0];
echo $email;
$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 					.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 					.'0123456789');
							$rand = '';
							foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
$check = mail($email,"Confirmation Code is here",$rand,'admin@cafeteria.com');
echo $check;
echo $rand;
if(!$check){
echo "lol";
exit;
}else{
echo "message sent successfully";
}
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
            <h4 class="col-md-4">Confirmation Code has been sent to your email address please insert it below</h4>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>
<form method="post" action="../controller/passwordRecovery.php">
<label>Confirmation Code</label>
<input type="text" name="userCode" value="" required/>
<input type="hidden" name="code" value="<?php echo $rand; ?>"/>
</br>
<input type="submit" value="Confirm"/>
</form>
</body>
</html>
