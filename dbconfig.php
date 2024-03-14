<?php 
// session_start();
$servername="localhost";
$username="root";
$password="";
$database="social";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    echo"SERVER NOT CONNECTED";
}
?>