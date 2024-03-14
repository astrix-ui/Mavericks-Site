<?php
session_start();
include("dbconfig.php");
$sender=$_SESSION['user'];
$receiver=$_POST['otherperson'];
$message=$_POST['message'];

$sql3="INSERT INTO messages (`message_id`, `sender`, `message`, `receiver`, `seen`) VALUES (NULL, '$sender', '$message', '$receiver', 0)";
mysqli_query($conn,$sql3);
$_SESSION['show']="show";
header("location:messages.php?otherperson=$receiver");
?>