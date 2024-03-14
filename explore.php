<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="explore44.css">
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
  

  <!-- SEARCH CONTAINER  -->

  <section class="search-container">
    <div class="searchbox">
        <input type="text" placeholder="Search username">
        <img src="./assets/search.png" alt="">
    </div>

  </section>
  
  <section class="search-result">
    <a href="" class="profile-container">
    <div class="profile-container">
      <?php
    //   include("dbconfig.php");
    // // Assuming $loggedin_user_id holds the ID of the currently logged-in user
    //     $user = $_SESSION['user'];

    //     // Fetch accounts the user doesn't follow
    //     $sql = "SELECT * FROM user LEFT JOIN follow ON user.username = follow.user;
    //             WHERE follow.user IS NULL AND user.username != :username";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':loggedin_user_id', $user, PDO::PARAM_INT);
    //     $stmt->bindParam(':username', $_SESSION['user'], PDO::PARAM_STR);
    //     $stmt->execute();
    //     $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     // Display recommended accounts
    //     foreach ($accounts as $account) {
    //       echo'
    //   <div class="profile-wrapper">
    //     <img src="./assets/user.png" alt="">
    //     <div class="user-info">
    //       <h3>@'. $account['username'] . '</h3>
    //       <h4>'. $account['user'] . '</h4>
    //     </div>
    //     <button class="login-btn follow-btn">Follow</button>
    //     <!-- <button class="login-btn">Unfollow</button> -->
    //   </div>';}
      ?>
      <?php
      ?>

      <div class="profile-wrapper">
        <img src="./assets/user.png" alt="">
        <div class="user-info">
          <h3>@randosocialofficial</h3>
          <h4>RandoSocial Team</h4>
        </div>
        <button class="login-btn follow-btn">Follow</button>
        <!-- <button class="login-btn">Unfollow</button> -->
      </div>

      <div class="profile-wrapper">
        <img src="./assets/user.png" alt="">
        <div class="user-info">
          <h3>@astrixui</h3>
          <h4>ASTrix UI</h4>
        </div>
        <button class="login-btn follow-btn">Follow</button>
        <!-- <button class="login-btn">Unfollow</button> -->
      </div>
    </div>

    </a>
    
  </section>

  <section class="grid">
  <?php
include("dbconfig.php");
$user = $_SESSION['user'];
$sql9 = "SELECT * FROM posts WHERE username != '$user' ORDER BY post_id DESC";
$posts_results = mysqli_query($conn, $sql9);
while ($posts_row = mysqli_fetch_assoc($posts_results)) {
    $post_id = $posts_row['post_id'];
?>
    <div class="post-grid" data-post-id="<?php echo $post_id; ?>" onclick="showImage('data:image/jpg;base64,<?php echo base64_encode($posts_row['image']); ?>', '<?php echo $post_id; ?>')">
        <img src="data:image/jpg;base64,<?php echo base64_encode($posts_row['image']); ?>" alt="">
    </div>
<?php
}
?>

    <!-- <div class="post-grid" onclick="showImage('./assets/demopost.png')"> -->
      <!-- <img src="./assets/demopost.png" alt=""> -->
      <!--  -->
    <!-- </div> -->
<!--  -->
    <!-- <div class="post-grid" onclick="showImage('./assets/lightleak3.jpg')"> -->
      <!-- <img src="./assets/lightleak3.jpg" alt=""> -->
      <!--  -->
    <!-- </div> -->
   <!--  -->
    <!-- <div class="post-grid" onclick="showImage('./assets/sea.jpg')"> -->
      <!-- <img src="./assets/Sea.jpg" alt=""> -->
    <!-- </div> -->
<!--  -->
    <!-- <div class="post-grid"> -->
      <!-- <img src="./assets/light-leak2.jpg" alt=""> -->
    <!-- </div> -->

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
              <!-- <li>
               <a href=""><span id="username">
                  Username
                </span></a> 
                <p class="comment-content">
                  This is my comment
                </p>
              </li>

              <li>
                <a href=""><span id="username">
                   Username
                 </span></a> 
                 <p class="comment-content">
                   This is my comment
                 </p>
               </li>

               <li>
                <a href=""><span id="username">
                   Username
                 </span></a> 
                 <p class="comment-content">
                   This is my comment
                 </p>
               </li>

               <li>
                <a href=""><span id="username">
                   Username
                 </span></a> 
                 <p class="comment-content">
                   This is my comment
                 </p>
               </li>

               <li>
                <a href=""><span id="username">
                   Username
                 </span></a> 
                 <p class="comment-content">
                   This is my comment
                 </p>
               </li> -->
           
          </div>
        </div>
    </div>
</div>

<!-- ACCOUNTS SECTION  -->
    
<section class="post-container">
  <h2>Accounts you should follow</h2>
  <div class="box-container">
      <a href="">
          <div class="box">
          <img src="./assets/user.png" alt="">
          <h4>astrixui</h4>
          <a href="" class="login-btn">Follow</a>
          </div>
      </a>

      <a href="">
          <div class="box">
          <img src="./assets/user.png" alt="">
          <h4>clumsymind7878</h4>
          <a href="" class="login-btn">Follow</a>
          </div>
      </a>

      <a href="">
          <div class="box">
          <img src="./assets/user.png" alt="">
          <h4>randosocialofficial</h4>
          <a href="" class="login-btn">Follow</a>
          </div>
      </a>

      <a href="">
          <div class="box">
          <img src="./assets/user.png" alt="">
          <h4>iamsrk</h4>
          <a href="" class="login-btn">Follow</a>
          </div>
      </a>

      <a href="">
          <div class="box">
          <img src="./assets/user.png" alt="">
          <h4>astrixui.fanclub</h4>
          <a href="" class="login-btn">Follow</a>
          </div>
      </a>
  </div>
</section>




<script>
  // JS FOR MOBILE NAVBAR 
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
