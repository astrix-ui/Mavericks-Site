<?php
$sql10 = "SELECT * FROM comments WHERE post_id = '$post_id'";
             $comment_result = mysqli_query($conn, $sql10);
             while($comments_row = mysqli_fetch_assoc($comment_result)) {
                       echo '<ul>';
                       echo '<li>';
                       echo '<a href=""><span id="username">' . $comments_row['comment_user'] . '</span></a>';
                       echo '<p class="comment-content">' . $comments_row['comment'] . '</p>';
                       echo '</li>';
                       echo'</ul>';
                   }

                   ?>