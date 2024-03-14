<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get image data from the database
$result3 = $conn->query("SELECT * FROM posts ORDER BY post_id DESC");

// Check if there are any results
if ($result3) {
    // Display images with BLOB data from the database
    if ($result3->num_rows > 0) {
        ?>
        <div class="gallery">
            <?php while ($row = $result3->fetch_assoc()) {
                $post_id = $row['post_id'];
                $post_user = $row['username'];
                ?>
                <div class="post-tile" data-post-id="<?= $row['post_id'] ?>">
                    <div class="user-detail">
                        <?php
                        // Retrieve profile image
                        $result_profile_image = $conn->query("SELECT user_photo FROM user WHERE username='$post_user'");
                        if ($result_profile_image && $result_profile_image->num_rows > 0) {
                            $row_profile_image = $result_profile_image->fetch_assoc();
                            // Display profile image
                            if($row_profile_image['user_photo']==!null){
                            echo '<img src="data:image/jpg;base64,' . base64_encode($row_profile_image['user_photo']) . '" id="profile-img" alt="Profile Image">';
                        }
                        else {
                            // Display default profile image or handle error
                            echo '<img src="./assets/user.png" id="profile-img" alt="Profile Image">';
                            // Uncomment the line below to display error message
                            // echo 'Profile image not found for user: ' . $post_user;
                        }}
                        
                        ?>
                        <?php
                       if ($post_user == $_SESSION['user']) {
                              // If $post_user is equal to $_SESSION['user'], display a different link
                              echo '<p><a href="profile.php">' . $post_user . '</a></p>';
                          } else {
                              // If $post_user is not equal to $_SESSION['user'], display the original link
                              echo '<p><a href="otherprofile.php?user=' . $post_user . '">' . $post_user . '</a></p>';
                          }
                          ?>
                    </div>

                    <div class="user-posted-content">
                        <img src="data:image/jpg;base64,<?= base64_encode($row['image']) ?>" id="post-img" alt="Posted Image">
                    </div>

                    <div class="caption">
                        <h3><?= $row['caption'] ?></h3>
                    </div>

                    <div class="bottom-control">
                        <img src="/social/assets/love.png" class="like-btn-icon" alt="Like">
                        <img src="/social/assets/comment.png" class="comment-btn-icon" alt="Comment">
                    </div>

                    <div class="comments-section" style="display: none;">
                        <h3>Comments</h3>
                        <ul class="comments-list">
                            <?php include("comment.php"); ?>
                        </ul>
                        <form action="comment_backend.php" method="POST">
                            <input type="hidden" value="<?= $post_id ?>" name="post_id">
                            <input type="text" class="comment-input" placeholder="Write a comment..." name="comment_content">
                            <button class="send-comment-btn login-btn">Comment</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else {
        // Display a message if there are no posts
        echo "<p class='status'>No posts found.</p>";
    }
} else {
    // Display error message if query fails
    echo "<p class='status error'>Error executing query: " . $conn->error . "</p>";
}
?>
