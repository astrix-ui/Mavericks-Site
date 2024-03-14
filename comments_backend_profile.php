<?php
include("dbconfig.php");
session_start();
$post_id = $_POST['post_id'];
$comment_content = $_POST['comment_content'];
$user = $_SESSION['user'];
$sql6 = "INSERT INTO comments (`comment_id`, `post_id`, `comment_user`, `comment`) VALUES (NULL, '$post_id', '$user', '$comment_content')";
mysqli_query($conn, $sql6);
$otheruser = $_POST['otheruser']; // Fetching other user from the URL parameter
echo $otheruser;
die;
// Check if the 'otheruser' parameter is set and redirect accordingly
// if (isset($otheruser)) {
//     header("Location: otherprofile.php?user=$otheruser"); // Redirect to the other user's profile page
// } else {
//     header("Location: profile.php"); // Redirect to the user's profile page
// }
?>
