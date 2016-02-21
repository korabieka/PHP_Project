<?php
$userCode = $_POST['userCode'];
$code = $_POST['code'];
if($userCode == $code){
header('location: ../layout/resetPassword.php');
}else{
echo "Code is not correct";
}
?>
