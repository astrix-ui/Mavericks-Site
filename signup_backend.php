<?php
session_start();
include("dbconfig.php");

$username=$_POST['username'];
$accountname=$_POST['name'];
$email=$_POST['gmail'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];

$sql="SELECT* FROM user WHERE username='$username'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
$sql2="SELECT* FROM user WHERE gmail='$email'";
$result2=mysqli_query($conn,$sql2);
$num2=mysqli_num_rows($result2);
if($num>0){
    
    $_SESSION['username_fail']="Username already exists";
    header("location:landing.php");

}
elseif($num2>0){
    $_SESSION['email_fail']="Email already exists";
    header("location:landing.php");
}
elseif($password==$cpassword){
    $hash=password_hash($password,PASSWORD_DEFAULT);
    // $default_photo_path = "./assets/user.png";
    $insert="INSERT INTO user(`user_id`, `username`, `user`, `gmail`, `password`) VALUES (NULL, '$username', '$accountname', '$email', '$hash')";    
    mysqli_query($conn,$insert);
    $_SESSION['user']=$username;
    $_SESSION['success2']="YOUR ACCOUNT HAS BEEN CREATED";

     
    header("location:index.php");
}
else{
    $_SESSION['password_fail']="Passwords do not match";
    header("location:landing.php");
}
?>

