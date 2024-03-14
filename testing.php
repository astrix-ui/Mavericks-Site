<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['user'];

// Check if post_id is present in the URL

    // Get image data from the database for the specific post_id
    $result3 = $conn->query("SELECT * FROM posts WHERE  username='$user'");

    // Check if there are any results
    if ($result3 && $result3->num_rows > 0) {
        // Fetch the post details
        $row = $result3->fetch_assoc();
        $post_user = $row['username'];
        ?>

        <!-- Start of post container -->
        <div class="post-container">
            <div class="post-grid" onclick="showImage('data:image/jpg;base64,<?= base64_encode($row['image']) ?>', <?= $post_id ?>)">
                <img src="data:image/jpg;base64,<?= base64_encode($row['image']) ?>" alt="">
            </div>

            <!-- Start of image panel -->
            <div class="image-panel">
                <img src="./assets/close.png" class="close-btn" alt="">
                <div class="panel-content">
                    <div class="image-section">
                        <img class="enlargedImg" src="" alt="">
                    </div>
                    <div class="right">
                        <h3>Comments</h3>
                        <div class="comments-section">
                            <?php
                            // Fetch comments for this post_id
                            if(isset($_GET['post_id'])) {
                                // Get the post_id from the URL
                                $post_id = $_GET['post_id'];
                            $sql10 = "SELECT * FROM comments WHERE post_id = '$post_id'";
                            $comment_result = mysqli_query($conn, $sql10);
                            while($comments_row = mysqli_fetch_assoc($comment_result)) {
                                echo '<ul>';
                                echo '<li>';
                                echo '<a href=""><span class="username">' . $comments_row['comment_user'] . '</span></a>';
                                echo '<p class="comment-content">' . $comments_row['comment'] . '</p>';
                                echo '</li>';
                                echo '</ul>';
                            }
                            ?>
                        </div>
                        <div class="buttons-section">
                            <div class="like-btn-container">
                                <!-- Like button -->
                            </div>
                            <img src="./assets/love.png" class="like-btn-icon" alt="">
                            <div class="comments-input-container">
                                <!-- Comment input and button -->
                                <input type="text" class="comment-input" placeholder="Write a comment...">
                                <button class="send-comment-btn login-btn">Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of image panel -->
        </div>
        <!-- End of post container -->

    <?php
    } else {
        // Display a message if post_id is not valid or does not belong to the current user
        echo "<p class='status error'>Invalid post ID or post not found.</p>";
    }
} else {
    // Display a message if post_id is not provided in the URL
    echo "<p class='status error'>Post ID not provided in the URL.</p>";
}
?>
