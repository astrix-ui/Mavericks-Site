<?php
include("dbconfig.php");
session_start();
$post_id = $_POST['post_id'];
$comment_content = $_POST['comment_content'];
$user = $_SESSION['user'];
$sql6 = "INSERT INTO comments (`comment_id`, `post_id`, `comment_user`, `comment`) VALUES (NULL, '$post_id', '$user', '$comment_content')";
mysqli_query($conn, $sql6);

// Redirect to the previous page
header("location:index.php");
// header("Location: " . $_SERVER['HTTP_REFERER']);
?>
