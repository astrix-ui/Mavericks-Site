<?php
session_start();
// unset($_SESSION['followed']);
// die;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profile12345.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="index.php" id="logo-link"><h3 id="logo">Momento</h3></a>
    <ul id="navbar">
        <a href="index.php" class="nav-link"><li>Home</li></a>
        <a href="messages.php" class="nav-link"><li>Messages</li></a>
        <a href="explore.php" class="nav-link"><li>Explore</li></a>
        <a href="" class="nav-link"><li>Wizard API</li></a>
        <a href="profile.php" class="nav-link active"><li>Profile</li></a>
        <!-- <a href="" class="nav-link"><li>Settings</li></a> -->
    </ul>
    <?php if(!isset($_SESSION['user'])): ?>
        <li><a href="landing.php" class="login-btn">Login</a></li>
    <?php else: ?>
        <li><a href="logout.php" class="login-btn">Logout</a></li>
    <?php endif; ?>

    <img src="./assets/Hamburger_icon.svg.png" alt="" id="hamburger">
    <img src="./assets/close.png" id="close" alt="">
</nav>

<?php
include("dbconfig.php");

// Check if the 'user' parameter is set in the URL
if (isset($_GET['user'])) {
    // Sanitize the input to prevent any potential security issues
    $otheruser = htmlspecialchars($_GET['user']);}

// Fetching the user's profile
$sql8 = "SELECT * FROM user WHERE username='$otheruser'";
$profile_result = mysqli_query($conn, $sql8);

// Fetching posts and setting $post_id
$sql9 = "SELECT * FROM posts WHERE username='$otheruser' ORDER BY post_id DESC";
$posts_results = mysqli_query($conn, $sql9);
$posts_row = mysqli_fetch_assoc($posts_results);

?>

<section class="container profile-container">
    <?php while($profile_row = mysqli_fetch_assoc($profile_result)): ?>
        <div class="profile-wrapper">
            <?php if($profile_row['user_photo'] != null): ?>
                <img src="data:image/jpg;base64,<?= base64_encode($profile_row['user_photo']) ?>"  alt="">
            <?php else: ?>
                <img src="./assets/user.png" id="profile-img" alt="Profile Image">
            <?php endif; ?>
            <div class="user-info">
                <div class="name-tags">
                    <h1 class="p-heading"><?= $profile_row['user'] ?></h1>
                    <h4>@<?= $profile_row['username'] ?></h4>
                </div>

                <?php
                $user=$_SESSION['user'];
                $sql14="SELECT *FROM follow WHERE user='$user' AND otherperson='$otheruser'";
                $following=mysqli_query($conn,$sql14);
                if($following_result=mysqli_fetch_assoc($following)){
                echo '<form action="unfollowed_backend.php" method="POST" class="follow-form">';
echo '<input type="hidden" name="otheruser" value="'.$otheruser.'">'; 
echo '<button type="submit" class="login-btn following-btn">Following</button>';
echo '</form>';
                }
                else{
                    echo '<form action="follow_backend.php" method="POST" class="follow-form">';
                    echo '<input type="hidden" name="otheruser" value="'.$otheruser.'">'; 
                    echo '<button type="submit" class="login-btn follow-btn">Follow</button>';
                    echo '</form>';

                }

                ?>

                <?php
// // Check if the currently logged-in user is following $user
// $followed = isset($_SESSION['followed']) && $_SESSION['followed'] == "FOLLOWED";

// // Determine the button text based on whether the user is followed or not
// $buttonText = $followed ? "Following" : "Follow";

// // Determine the form action URL based on whether the user is followed or not
// $formAction = $followed ? "unfollowed_backend.php" : "follow_backend.php";

// // Determine the CSS class for the button based on whether the user is followed or not
// $buttonClass = $followed ? "following-btn" : "follow-btn";

// // Output the button with the appropriate form action and CSS class
// echo '<form action="' . $formAction . '" method="POST" class="follow-form">';
// echo '<input type="hidden" name="otheruser" value="'.$otheruser.'">'; 
// echo '<button type="submit" class="login-btn ' . $buttonClass . '">' . $buttonText . '</button>';
// echo '</form>';

// Output the message button
echo '<a href="messages.php?otherperson='.$otheruser.'"><button class="login-btn more-btn">Message</button></a>';
?>






            </div>
            <div class="user-stats">
            <?php
                $postsql="SELECT* FROM posts WHERE username='$otheruser'";
                mysqli_query($conn,$postsql);
                $postsum=mysqli_num_rows( mysqli_query($conn,$postsql));
                echo'<p><span>',$postsum,'</span> Posts</p>';
                // echo'<p class="count">',$postsum,'</p>';
                ?>
                <?php
                $follwerssql="SELECT* FROM follow WHERE otherperson='$otheruser' AND follow=1";
                mysqli_query($conn,$postsql);
                $follwerssum=mysqli_num_rows( mysqli_query($conn,$follwerssql));
                echo'<p><span>',$follwerssum,'</span> Followers</p>';
                // echo'<p class="count">',$postsum,'</p>';
                ?>
                <?php
                $followingsql="SELECT* FROM follow WHERE user='$otheruser' AND follow=1";
                mysqli_query($conn,$postsql);
                $followingsum=mysqli_num_rows( mysqli_query($conn,$followingsql));
                echo'<p><span>',$followingsum,'</span> Following</p>';
                // echo'<p class="count">',$postsum,'</p>';
                ?>
            </div>
        </div>
    <?php endwhile; ?>
    <div class="container change-password-section">
        <form action="">
            <input type="text" placeholder="old password">
            <input type="text" placeholder="new password">
            <input type="text" placeholder="confirm password">
        </form>
        <button class="login-btn">Confirm</button>
    </div>
</section>

<section class="grid">
    <?php
    // Display posts
    $posts_results = mysqli_query($conn, $sql9);
    while ($posts_row = mysqli_fetch_assoc($posts_results)) {
        $post_id = $posts_row['post_id'];?>
      <div class="post-grid" data-post-id="<?php echo $post_id; ?>" onclick="showImage('data:image/jpg;base64,<?php echo base64_encode($posts_row['image']); ?>', '<?php echo $post_id; ?>')">
        <img src="data:image/jpg;base64,<?php echo base64_encode($posts_row['image']); ?>" alt="">
    </div>
    
    <?php
    }
    ?>
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
                <ul>
                <?php
                
             include("fetch_comments.php");
                   ?>
            </div>
        </div>
    </div>
</div>

<script>
 

 const bar = document.getElementById('hamburger');
    const addOptions = document.querySelector('.additional-option');
            const nav = document.getElementById('navbar');
            const cross = document.getElementById('close');
            const login = document.querySelectorAll('.login-btn');
            const imgHero = document.getElementById('img-hero');
            const uploadBtn = document.getElementById('input-file');
            const closeBtn = document.getElementById('close-icon');

            if (bar) {
                hamburger.addEventListener('click', () =>{
                    // console.log("clicked");
                bar.style.display = 'none';
                nav.classList.add('active');
                cross.style.display = 'block';
                // login.style.display = 'none';
            })
            }
            if(cross) {
                cross.addEventListener('click', () =>{
                    nav.classList.remove('active');
                    bar.style.display = 'flex';
                    cross.style.display = 'none';

                })
            }
  // Function to handle click events on post grids
function handlePostClick(event) {
    const post = event.target.closest('.post-grid');
    if (post) {
        const imageSrc = post.querySelector('img').src;
        const postId = post.dataset.postId; // Assuming you have a dataset attribute to store post ID
        showImage(imageSrc, postId);
    }
}

// Add click event listener to all post grids
document.querySelectorAll('.post-grid').forEach(post => {
    post.addEventListener('click', handlePostClick);
});

// Function to show enlarged image and update URL with post_id
function showImage(imageSrc, postId) {
    // Display the enlarged image
    const enlargedImg = document.getElementById("enlargedImg");
    enlargedImg.src = imageSrc;

    // Show the image panel
    const imagePanel = document.getElementById("imagePanel");
    imagePanel.style.display = "flex";

    // Update the URL with the post_id
    history.pushState(null, null, "?post_id=" + postId);

    // Fetch comments for the specified post ID
    fetchComments(postId);
}

// Function to fetch comments for a specific post ID
function fetchComments(postId) {
    const commentsContainer = document.querySelector('.comments-section ul');
    commentsContainer.innerHTML = ''; // Clear existing comments

    // Fetch comments using AJAX
    fetch('fetch_comments.php?post_id=' + postId)
        .then(response => response.text())
        .then(data => {
            commentsContainer.innerHTML = data; // Update comments container with fetched comments
        })
        .catch(error => console.error('Error fetching comments:', error));
}

// Function to hide image panel and clear post_id from URL
function hideImagePanel() {
    // Hide the image panel
    const imagePanel = document.getElementById('imagePanel');
    imagePanel.style.display = 'none';

    // Remove post_id from URL
    history.pushState(null, null, window.location.pathname);
}

// Add click event listener to close button
document.getElementById('close-btn').addEventListener('click', hideImagePanel);

// CLOSE PANEL 
const closeButton = document.getElementById('close-btn');
closeButton.addEventListener('click', () => {
    // Hide the image panel
    const imagePanel = document.getElementById('imagePanel');
    imagePanel.style.display = 'none';

    // Update the URL to remove the post ID
    history.pushState(null, null, window.location.pathname);
});
const postGrids = document.querySelectorAll('.post-grid');
postGrids.forEach(post => {
    post.addEventListener('click', () => {
        const imageSrc = post.querySelector('img').src;
        const postId = post.dataset.postId; // Assuming you have a dataset attribute to store post ID
        showImage(imageSrc, postId);
    });
});

closeButton.addEventListener('click', () => {
    // Hide the image panel
    const imagePanel = document.getElementById('imagePanel');
    imagePanel.style.display = 'none';
});










// LIKE BTN 

const likeIcon = document.getElementById('like-btn-icon');
likeIcon.addEventListener("click", () => {
                console.log(likeIcon.src);
                if (likeIcon.classList.contains("liked")) {
                    likeIcon.src = "./assets/love.png";
                    likeIcon.classList.remove("liked");
                } else {
                    likeIcon.src = "./assets/love-clicked.png";
                    likeIcon.classList.add("liked");
                }
            });
</script>

</body>
</html>
