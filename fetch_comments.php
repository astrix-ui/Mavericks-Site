<?php
include("dbconfig.php");

// Retrieve post ID from the request
$post_id = $_GET['post_id'];

// Fetch comments for the specified post ID
$sql = "SELECT * FROM comments WHERE post_id = '$post_id'";
$comment_result = mysqli_query($conn, $sql);

// Output comments
while ($comments_row = mysqli_fetch_assoc($comment_result)) {
    echo '<li>';
    echo '<a href=""><span id="username">' . $comments_row['comment_user'] . '</span></a>';
    echo '<p class="comment-content">' . $comments_row['comment'] . '</p>';
    echo '</li>';
}
echo'</ul>
</div>
<div class="buttons-section">
  <div class="like-btn-container">

  </div>
  <img src="./assets/love.png" id="like-btn-icon" alt="">
  <div class="comments-input-container">
  <form action="comment_backend.php" method="POST">
                  <input type="hidden" value="<?= $post_id ?>" name="post_id">
                  <input type="text" class="comment-input" placeholder="Write a comment..." name="comment_content">
                  <button class="send-comment-btn login-btn">Comment</button>
              </form>
  </div>';
?>
