<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momento</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap"
    rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="landing10.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <a href="/index.html">

            <h3 id="logo">Momento</h3>
        </a>
        <ul id="navbar">
            <!-- <a href="index.html" class="nav-link"><li>Home</li></a>
            <a href="messages.html" class="nav-link"><li>Messages</li></a>
            <a href="" class="nav-link"><li>Explore</li></a>
            <a href="" class="nav-link"><li>Wizard API</li></a>
            <a href="" class="nav-link"><li>Profile</li></a>
            <a href="" class="nav-link"><li>Settings</li></a> -->
            
        </ul>
        <!-- <a href="login.html" class="login-btn">Login</a> -->
        <img src="/social/assets/Hamburger_icon.svg.png" alt="" id="hamburger">
        <img src="/social/assets/close.png" id="close" alt="">

    </nav>


    <section class="wrapper center">
        <div class="container">

            
            <h3 class="p-heading ">Welcome to Momento</h3>
            <!-- <h4 class="">Join Now!</h4> -->
            <p class="leading-txt">
                Your information is encrypted and only visible to you.
                <br>
                Copyright 2024 ~ aCube
            </p>
            <a href="#" id="login-btn" onclick="animateLogin()">Login</a>

            <div class="login-form" id="login-form">
                <div class="form-container">
                    <h1 id="form-heading">Login</h1>
                    <form action="login_backend.php" method="POST">
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <div id="create-account-link">
                        Don't have an account? <a href="#" onclick="showCreateAccount()">Create one</a>
                    </div>
                    <button>Login</button>
                </form>
                </div>
            </div>

            <div class="signup-form" id="signup-form">
                <h1>Sign Up</h1>
                <?php    
                // if(isset($_SESSION['username_fail'])){
                // echo '<p style="color:#ff4d4d;">',$_SESSION['username_fail'],'</p>';
       
                // unset($_SESSION['username_fail']);
                // }
                // ?>
                 <?php
                // if(isset($_SESSION['email_fail'])){
                // echo '<p style="color:#ff4d4d;">',$_SESSION['email_fail'],'</p>';
       
                // unset($_SESSION['email_fail']);
                // }
                // ?>
              <?php
                // if(isset($_SESSION['password_fail'])){
                // echo '<p style="color:#ff4d4d;">',$_SESSION['password_fail'],'</p>';
       
                // unset($_SESSION['password_fail']);
                // }
                ?>
                <form action="signup_backend.php" method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="text" placeholder="Name" name="name" required>
                <input type="email" placeholder="Gmail" name="gmail" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="cpassword" required>

                <button>Sign Up</button>
                </form>
            </div>
            
        </div>


        
    </section>
    <?php
    if(isset( $_SESSION['login_password_fail']))
    echo'<div class="toast-container">
         <h3>Invalid password</h3>
         </div>';
         unset( $_SESSION['login_password_fail']);
    ?>
    <?php
    if(isset( $_SESSION['login_username_fail']))
    echo'<div class="toast-container">
         <h3>Invalid username</h3>
         </div>';
         unset( $_SESSION['login_username_fail']);
    ?>
    <?php
    if(isset($_SESSION['username_fail']))
    echo'<div class="toast-container">
         <h3>Username already exists</h3>
         </div>';
         unset($_SESSION['username_fail']);
    ?>
    <?php
    if(isset($_SESSION['email_fail']))
    echo'<div class="toast-container">
         <h3>E-mail is already used</h3>
         </div>';
         unset($_SESSION['email_fail']);
    ?>
    <?php
    if(isset( $_SESSION['password_fail']))
    echo'<div class="toast-container">
         <h3>Passwords do not match</h3>
         </div>';
         unset($_SESSION['password_fail']);
    ?>
    <?php
    if(isset($_SESSION['logout']))
    echo'<div class="toast-container">
         <h3>Logged out</h3>
         </div>';
         unset($_SESSION['logout']);
    ?>
     <!-- <div class="toast-container">
     <h3>Account Created</h3>
     <div class="button-container">
         <button>Yes</button>
         <button>No</button>
     </div>
  </div> -->
<script>
    function animateLogin() {
    var welcomeText = document.querySelector('.wrapper h3');
    var loginBtn = document.getElementById('login-btn');
    var loginForm = document.getElementById('login-form');
    welcomeText.classList.add('slide-left');
    loginBtn.classList.add('slide-left');

    setTimeout(function() {
        welcomeText.textContent = "Momento";

        if (window.innerWidth < 1499) {
            welcomeText.style.fontSize = "3em"
            welcomeText.style.top = "10%";
            loginBtn.style.display = 'none';
        } else {
            welcomeText.style.left = "573px"; // Adjust left position as needed
        }
        // welcomeText.style.left = "573px"; // Adjust left position as needed
        loginBtn.classList.add('hide');

        // Make the login form visible
        loginForm.style.display = 'flex';
        
    }, 1000); // Adjust the timing based on your animations
}

function showCreateAccount() {
    var formHead = document.getElementById('form-heading');
    var formContainer = document.querySelector('.form-container');
    
    formContainer.style.display = 'none';
    formHead.textContent = "Sign Up";
    var signupForm = document.getElementById('signup-form');
    signupForm.style.display = 'flex';
}

// TOAST 
const toastContainer = document.querySelector('.toast-container');

toastContainer.classList.add('show');

setTimeout(() => {
    toastContainer.classList.remove('show');
}, 3000); 
</script>
</body>


</html>