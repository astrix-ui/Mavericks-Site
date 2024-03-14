<?php
session_start();
include("dbconfig.php");
$username=$_POST['username'];
$password=$_POST['password'];


$confirm="SELECT * FROM user WHERE username='$username'";
$result=mysqli_query($conn,$confirm);
$num3=mysqli_num_rows($result);
if($num3==1){
$row=mysqli_fetch_assoc($result);
if(password_verify($password, $row['password'])){
    $_SESSION['user']=$username;
   $_SESSION['success']="YOU HAVE LOGGED IN";
    header("location:index.php");
}
else{
    $_SESSION['login_password_fail']="Invalid password";
    header("location:landing.php");
}
}
else{
    $_SESSION['login_username_fail']="Invalid username";
    header("location:landing.php");
}
?>
?>