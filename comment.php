<?php
include("dbconfig.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  
$sql5 = "SELECT * FROM comments WHERE post_id='$post_id'";
$comment_result = mysqli_query($conn, $sql5);
while ($comment_rows = mysqli_fetch_assoc($comment_result)) {
    $comment_user=$comment_rows['comment_user'];
    echo "<li>";
    if ($comment_user == $_SESSION['user']) {
        // If $post_user is equal to $_SESSION['user'], display a different link
        echo '<a href="profile.php">' . $comment_user . ' </a>';
    } else {
        // If $post_user is not equal to $_SESSION['user'], display the original link
        echo '<a href="otherprofile.php?user=' . $comment_user . '">' . $comment_user . '</a>';
    }
    echo"<span>" . $comment_rows['comment'] . "</span>
     </li>";
}
?>
