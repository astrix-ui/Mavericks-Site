<?php 
session_start();
//    if(isset($_SESSION['do'])){
//  unset($_SESSION['seen']);}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momento</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="index495.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <nav>
        <h3 id="logo">Momento</h3>
        <ul id="navbar">
            <a href="index.php" class="nav-link active"><li>Home</li></a>

            <?php
            //   session_start();
              include("dbconfig.php");
              if(isset($_SESSION['user'])){
              $sender=$_SESSION['user'];
              $sql="SELECT * FROM messages WHERE receiver='$sender'";
              $result=mysqli_query($conn,$sql);
              while($content=mysqli_fetch_assoc($result)){
                    if($content['seen']==0){
                     $_SESSION['seen']="seen";
                    }
                    }}
                    ?>
                    <?php
                    if(isset($_SESSION['user'])){
                    if(isset($_SESSION['seen'])){
                        echo'<a href="messages.php" class="nav-link"><li id="msg-link">Messages
                        <img src="/social/assets/dot.png" id="dot-img" alt="">
                        </li></a>';
                     }
                     if(!isset($_SESSION['seen'])){
                        echo'<a href="messages.php" class="nav-link"><li id="msg-link">Messages
                                                </li></a>';
                     }}

                     if(!isset($_SESSION['user'])){
                        echo'<a href="messages.php" class="nav-link"><li id="msg-link">Messages
                                                </li></a>';
                     }
            ?>
           
            <a href="explore.php" class="nav-link"><li>Explore</li></a>
            <a href="" class="nav-link"><li>Wizard API</li></a>
            <a href="profile.php" class="nav-link"><li>Profile</li></a>
            <!-- <a href="" class="nav-link"><li>Settings</li></a> -->
            
        </ul>
        <?php
         if(!isset($_SESSION['user'])){
            echo'<li><a href="landing.php" class="login-btn">Login</a></li>';
            }
            ?>
            <?php 
            if(isset($_SESSION['user'])){
            echo'<li ><a href="logout.php"  class="login-btn">Logout</a></li>';}?>
        <!-- <a href="landing.html" class="login-btn">Login</a> -->
        <img src="/social/assets/Hamburger_icon.svg.png" alt="" id="hamburger">
        <img src="/social/assets/close.png" id="close" alt="">

    </nav>

<section id="hero-main">
    <h4 class="p-heading">Let's Post Something!</h4>
    <form action="post_backend.php" id="upload-form" method="POST" enctype="multipart/form-data">
    <label for="input-file">Upload Photo</label>
    <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file" name="postimage">
    <div class="additional-option">
        <img src="/social/assets/close.png" alt="" id="close-icon">
        <textarea name="Caption" id="caption-input" placeholder="What's on your mind?" rows="3" required></textarea>
        <button id="post-btn" class="login-btn" name="submit">Post Now</button>
            </form>
    </div>
</section>

 <section class="post-container">
    <h2>Browse Posts</h2>
   <?php 
   include("view.php")?>
</section> 
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
        <?php
    if(isset($_SESSION['success']))
    echo'<div class="toast-container">
         <h3>Login Successful</h3>
         </div>';
         unset($_SESSION['success']); 
    ?>
        <?php
    if(isset($_SESSION['success2']))
    echo'<div class="toast-container">
         <h3>Account Created</h3>
         </div>';
         unset($_SESSION['success2']); 
    ?>
    </section>
    <!-- <div class="toast-container">
     <h3>Account Created</h3>
     <div class="button-container">
         <button>Yes</button>
         <button>No</button>
     </div>
  </div> -->

<!-- FOOTER  -->
    <footer id="sec-main">
        <div class="col">
            <ul>
                <li>djfjj</li>
                <li>ivfsov</li>
                <li>ivfsov</li>
                <li>ivfsov</li>
            </ul>
            <ul>
                <li>djfjj</li>
                <li>ivfsov</li>
                <li>ivfsov</li>
                <li>ivfsov</li>
            </ul>

        </div>
        <!-- <h3>Copyright 2023 ~ aCube</h3> -->
    </footer>
   
    






<script>
            // JavaScript for mobile navigation bar
const bar = document.getElementById('hamburger');
const nav = document.getElementById('navbar');
const cross = document.getElementById('close');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
        cross.style.display = 'block';
        bar.style.display = 'none';
    });
}

if (cross) {
    cross.addEventListener('click', () => {
        nav.classList.remove('active');
        cross.style.display = 'none';
        bar.style.display = 'flex';
    });
}

// JavaScript for toggling like functionality
const likeBtns = document.querySelectorAll('.like-btn-icon');

likeBtns.forEach((likeBtn) => {
    likeBtn.addEventListener('click', () => {
        if (likeBtn.classList.contains('liked')) {
            likeBtn.src = "./assets/love.png";
            likeBtn.classList.remove('liked');
        } else {
            likeBtn.src = "./assets/love-clicked.png";
            likeBtn.classList.add('liked');
        }
    });
});


// JavaScript for uploading photo box
const uploadBtn = document.getElementById('input-file');
const addOptions = document.querySelector('.additional-option');
const closeBtn = document.getElementById('close-icon');

const uploadEvent = () => {
    addOptions.style.display = 'block';
};

if (uploadBtn) {
    uploadBtn.addEventListener('change', uploadEvent);
}

if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        addOptions.style.display = 'none';
    });
}

// JavaScript for toggling comments section
const commentBtns = document.querySelectorAll('.comment-btn-icon');
const postTiles = document.querySelectorAll('.post-tile');

commentBtns.forEach((commentBtn, index) => {
    commentBtn.addEventListener('click', () => {
        const commentsSection = postTiles[index].querySelector('.comments-section');
        if (commentsSection.style.display === 'none' || commentsSection.style.display === '') {
            commentsSection.style.display = 'block';
            if (window.innerWidth > 999) {
                postTiles[index].style.width = '32vw'; 
            }
            commentsSection.style.transform = 'translateX(0)';
        } else {
            commentsSection.style.display = 'none';
            if (window.innerWidth > 999) {
                postTiles[index].style.width = '31vw'; 
            }
            commentsSection.style.transform = 'translateY(100%)';
        }
    });
});
// TOAST 
const toastContainer = document.querySelector('.toast-container');

toastContainer.classList.add('show');

setTimeout(() => {
    toastContainer.classList.remove('show');
}, 3000); 

// JavaScript for sending comments
// const sendCommentBtns = document.querySelectorAll('.send-comment-btn');
// const commentInputs = document.querySelectorAll('.comment-input');
// const commentsLists = document.querySelectorAll('.comments-list');
// const userDetailPs = document.querySelectorAll('.user-detail p');

// sendCommentBtns.forEach((sendCommentBtn, index) => {
//     sendCommentBtn.addEventListener('click', () => {
//         const commentText = commentInputs[index].value.trim();
//         const username = userDetailPs[index].textContent;
//         if (commentText !== '') {
//             const li = document.createElement('li');
//             const usernameAnchor = document.createElement('a'); // Create an anchor tag
//             const commentSpan = document.createElement('span');
            
//             usernameAnchor.textContent = username;
//             usernameAnchor.classList.add('username'); // Add a class for styling
//             usernameAnchor.href = '#'; // Set href attribute
            
//             commentSpan.textContent = commentText;
            
//             li.appendChild(usernameAnchor);
//             li.appendChild(document.createTextNode('   ')); // Add a colon separator
//             li.appendChild(commentSpan);
            
//             commentsLists[index].appendChild(li);
//             commentInputs[index].value = ''; // Clear the input field after sending comment
//         }
//     });
// });

    
</script>
</body>

</html>