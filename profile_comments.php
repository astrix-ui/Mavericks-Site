<?php
echo'</section>

<div id="imagePanel" class="image-panel">
  <img src="./assets/close.png" id="close-btn" alt="">

  <div class="panel-content">
      <div class="image-section">
          <img id="enlargedImg" src="" alt="">
      </div>
      <div class="right">
        <h3>Comments</h3>
        <div class="comments-section">
          <ul>';
if(isset($post_id)) {
    $sql10 = "SELECT * FROM comments WHERE post_id = '$post_id'";
    $comment_result = mysqli_query($conn, $sql10);
    while($comments_row = mysqli_fetch_assoc($comment_result)) {
        echo '<li>';
        echo '<a href=""><span id="username">' . $comments_row['comment_user'] . '</span></a>';
        echo '<p class="comment-content">' . $comments_row['comment'] . '</p>';
        echo '</li>';
    }
}
?>
