<?php
include("dbconfig.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sql9="SELECT *FROM posts WHERE username='$user' ORDER BY post_id DESC";
  $posts_results=mysqli_query($conn,$sql9);
  while($posts_row = mysqli_fetch_assoc($posts_results)){ 
    $post_id=$posts_row['post_id'];
    echo '<div class="post-grid" onclick="showImage(\'data:image/jpg;base64,' . base64_encode($posts_row['image']) . '\', ' . $posts_row['post_id'] . ')">
        <img src="data:image/jpg;base64,' . base64_encode($posts_row['image']). '"  alt="">
    </div>';}
  



  
echo'
  </section>

  <div id="imagePanel" class="image-panel">
    <img src="./assets/close.png" id="close-btn" alt="">

    <div class="panel-content">
        <div class="image-section">
            <img id="enlargedImg" src="" alt="">
        </div>
        <div class="right">
          <h3>Comments</h3>
          <div class="comments-section">
            ';
            
             include("profile_posts_comment.php");
                   
          echo'</div>
          <div class="buttons-section">
            <div class="like-btn-container">

            </div>
            <img src="./assets/love.png" id="like-btn-icon" alt="">
            <div class="comments-input-container">

              <input type="text" class="comment-input" placeholder="Write a comment...">
              <button class="send-comment-btn login-btn">Comment</button>
            </div>
          </div>
        </div>
    </div>
</div>';
?>