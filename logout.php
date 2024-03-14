<?php
session_start();

unset($_SESSION['user']);
$_SESSION['logout']="YOU HAVE BEEN LOGGED OUT";


header("location:landing.php");
?>