<?php
session_start();
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

    <!-- Include jQuery library -->
    
</head>
<body>

    <!-- NAVBAR -->
  <nav>
    <a href="index.php" id="logo-link"><h3 id="logo">Momento</h3></a>
    <ul id="navbar">
      <a href="index.php" class="nav-link">
        <li>Home</li>
      </a>
      <a href="messages.php" class="nav-link">
        <li>Messages</li>
      </a>
      <a href="explore.php" class="nav-link">
        <li>Explore</li>
      </a>
      <a href="" class="nav-link">
        <li>Wizard API</li>
      </a>
      <a href="" class="nav-link active">
        <li>Profile</li>
      </a>
      <!-- <a href="" class="nav-link">
        <li>Settings</li>
      </a> -->
    </ul>
    <?php
         if(!isset($_SESSION['user'])){
            echo'<li><a href="landing.php" class="login-btn">Login</a></li>';
            }
            ?>
            <?php 
            if(isset($_SESSION['user'])){
            echo'<li ><a href="logout.php"  class="login-btn">Logout</a></li>';}?>
    

        <img src="./assets/Hamburger_icon.svg.png" alt="" id="hamburger">
        <img src="./assets/close.png" id="close" alt="">
  </nav>
  
<!-- <div  class="toast-container">
        <p>Do you want to delete this post?</p>
        <div class="button-container">
  <button id="yesButton">Yes</button>
  <button id="noButton">No</button>
    </div> -->
  <div class="toast-container">
     <h3>Change Profile Photo?</h3>
     <div class="button-container">
     <button id="yesButton">Yes</button>
     <button id="noButton">No</button>
     </div>
  </div>

  <?php
  include("dbconfig.php");
  $user=$_SESSION['user'];
  $sql8="SELECT* FROM user WHERE username='$user'";
  $profile_result=mysqli_query($conn,$sql8);

  ?>
  <Section class="container profile-container">
    <?php
    while($profile_row=mysqli_fetch_assoc($profile_result)){
    echo'<div class="profile-wrapper">';
    if($profile_row['user_photo']==!null){
      echo '<img src="data:image/jpg;base64,' . base64_encode($profile_row['user_photo']). '"  alt="">';
  }
  else {
      // Display default profile image or handle error
      echo '<img src="./assets/user.png" id="profile-img" alt="Profile Image">';
      // Uncomment the line below to display error message
      // echo 'Profile image not found for user: ' . $post_user;
  }
    echo'
        <div class="user-info">
            <div class="name-tags">
              <h1 class="p-heading">'. $profile_row['user'].'</h1>

                <h4>@'. $profile_row['username'] .'</h4>
            </div>';
          }
    ?>
            <!-- <button class="login-btn follow-btn">Follow</button> -->
            <button class="login-btn more-btn">More</button>
            <ul class="more-options">
              <a href="" id="change-pwd-btn"><li>Change Password</li></a>
              <a href=""><li>
                <form id ="uploadForm" action="profile_photo_upload.php" method="POST" enctype="multipart/form-data">

                  <label for="input-file">Upload Photo</label>
                  <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file" name="profileimage">
                
                </form>

              </li></a>
              <a href="profile_photo_remove.php"><li>Remove Photo</li></a>
              <a href="logout.php"><li id="logout-btn">Logout</li></a>

            </ul>

          </div>

            <div class="user-stats">
            <?php
                $postsql="SELECT* FROM posts WHERE username='$user'";
                mysqli_query($conn,$postsql);
                $postsum=mysqli_num_rows( mysqli_query($conn,$postsql));
                echo'<p><span>',$postsum,'</span> Posts</p>';
                // echo'<p class="count">',$postsum,'</p>';
                ?>
                <?php
                $follwerssql="SELECT* FROM follow WHERE otherperson='$user' AND follow=1";
                mysqli_query($conn,$postsql);
                $follwerssum=mysqli_num_rows( mysqli_query($conn,$follwerssql));
                echo'<p><span>',$follwerssum,'</span> Followers</p>';
                // echo'<p class="count">',$postsum,'</p>';
                ?>
                <?php
                $followingsql="SELECT* FROM follow WHERE user='$user' AND follow=1";
                mysqli_query($conn,$postsql);
                $followingsum=mysqli_num_rows( mysqli_query($conn,$followingsql));
                echo'<p><span>',$followingsum,'</span> Following</p>';
                // echo'<p class="count">',$postsum,'</p>';
                ?>
            </div>
    </div>
    <div class="container change-password-section">
      <form action="">
        <input type="text" placeholder="old password">
        <input type="text" placeholder="new password">
        <input type="text" placeholder="confirm password">
      </form>
      <button class="login-btn">Confirm</button>
   </div>
  </Section>
  
  <section class="grid">
  <?php
  $sql9="SELECT *FROM posts WHERE username='$user' ORDER BY post_id DESC";
  $posts_results=mysqli_query($conn,$sql9);
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

// JS FOR MOBILE NAVBAR 
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

//  MORE OPTIONS 
const optionList = document.querySelector('.more-options');
const more = document.querySelector('.more-btn');
more.addEventListener("click", () =>{
  if (optionList.style.display === 'none' || optionList.style.display === ''){
    optionList.style.display = 'block';
}
else{
    optionList.style.display = 'none';
}

})

// CHANGE PASSWORD 
const changePwdContainer = document.querySelector('.change-password-section');
const changePwdToggle = document.getElementById('change-pwd-btn');

changePwdToggle.addEventListener("click", (event) => {
  // Prevent the default form submission behavior
  event.preventDefault();

  if (changePwdContainer.style.display === 'none' || changePwdContainer.style.display === ''){
    changePwdContainer.style.display = 'block';
  } else {
    changePwdContainer.style.display = 'none';
  }
});

// MORE OPTIONS 

const moreOptions = document.querySelectorAll('.more-options li');

moreOptions.forEach(option => {
  option.addEventListener('click', () => {
    // Hide the More options panel
    optionList.style.display = 'none';
  });
});

// Close More options panel when clicking outside
document.body.addEventListener('click', (event) => {
  const target = event.target;
  if (!target.closest('.more-btn') && !target.closest('.more-options')) {
    // Click occurred outside the More options panel and button, so hide the panel
    optionList.style.display = 'none';
  }
});

// JavaScript code for displaying toast message when user selects a photo

// Function to show toast message
function showToast() {
    const toastContainer = document.querySelector('.toast-container');
    toastContainer.classList.add('show');

    // Hide the toast message after 3 seconds
    setTimeout(() => {
        toastContainer.classList.remove('show');
    }, 6000);
}

// Event listener for file input change event
document.getElementById('input-file').addEventListener('change', () => {
    // Check if a file is selected
    if (event.target.files.length > 0) {
        showToast(); // Call the showToast function to display the toast message
    }
});
const uploadForm = document.getElementById('uploadForm');
const yesButton = document.getElementById('yesButton');
const noButton = document.getElementById('noButton');
const toastContainer = document.querySelector('.toast-container');

// Event listener for "Yes" button click
yesButton.addEventListener('click', function () {
    // Submit the form only if uploadForm exists
    if (uploadForm) {
        // Submit the form
        uploadForm.submit();
    }
    // Hide the toast message
    toastContainer.classList.remove('show');
});

// Event listener for "No" button click
noButton.addEventListener('click', function () {
    // Hide the toast message
    toastContainer.classList.remove('show');
    // Perform the "No" action here if needed
});


</script>
</body>
</html>
