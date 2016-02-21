<?php
require_once("../include/Validation.php");
session_start();
$dbobj = new dbconnection();
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
if($password == $confirmPassword){
$dbobj->Update("update user set password = '".md5($password)."' where uname='".$_SESSION['username']."'");
header('location: ../layout/index.php');
}else{
echo "password and confirm don't match";
}



?>
