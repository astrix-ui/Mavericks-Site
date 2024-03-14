<?php
session_start();
include("dbconfig.php");
$loggedin_user=$_SESSION['user'];
$user=$_POST['otheruser'];



$sql="DELETE FROM follow WHERE user='$loggedin_user' AND otherperson='$user'";
mysqli_query($conn,$sql);

unset($_SESSION['followed']);
header("location: otherprofile.php?user=$user");

?>