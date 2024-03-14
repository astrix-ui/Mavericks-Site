<?php
session_start();
include("dbconfig.php");
$user=$_SESSION['user'];
$sql16="UPDATE user SET user_photo='' WHERE username='$user'";
mysqli_query($conn,$sql16);
header("location:profile.php");

?>