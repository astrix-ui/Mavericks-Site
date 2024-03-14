<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="messages5.css">
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
      <a href="profile.php" class="nav-link">
        <li>Profile</li>
      </a>
      <!-- <a href="" class="nav-link">
        <li>Settings</li> -->
      </a>


    </ul>
    <?php
         if(!isset($_SESSION['user'])){
            echo'<li><a href="landing.php" class="login-btn">Login</a></li>';
            }
            ?>
            <?php 
            if(isset($_SESSION['user'])){
            echo'<li ><a href="logout.php"  class="login-btn">Logout</a></li>';}?>
    

  </nav>

  <!-- <h2>Messages</h2> -->
  <section class="wrapper">
      <!-- <h3>Abs</h3>
    <div id="cards-container">
        <div class="card">
            <img src="/assets/plank.jpg" alt="">
            <h4>Plank</h4>
        </div>

        <div class="card">
            <img src="/assets/plank.jpg" alt="">
            <h4>Plank</h4>
        </div>

        <div class="card">
            <img src="/assets/plank.jpg" alt="">
            <h4>Plank</h4>
        </div>
        
        <div class="card">
            <img src="/assets/plank.jpg" alt="">
            <h4>Plank</h4>
        </div>

        <div class="card">
            <img src="/assets/plank.jpg" alt="">
            <h4>Plank</h4>
        </div>

        <div class="card">
            <img src="/assets/plank.jpg" alt="">
            <h4>Plank</h4>
        </div>
    </div> -->

    
    <div class="left-panel">
      <div class="user-container-wrapper">
        <?php
        include("message_panel.php");
        ?>
      <!-- <div class="user-container unread">
        <img src="/social/assets/dot.png" alt="">
        <h4 class="user-id">Cutie</h4>
        <p>Sent a reel by astrixui</p>
      </div>
      
      <div class="user-container">
        <h4 class="user-id">Username</h4>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est nam reprehenderit sunt?</p>
      </div>
      <div class="user-container">
        <h4 class="user-id">Username</h4>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est nam reprehenderit sunt?</p>
      </div>
      <div class="user-container">
        <h4 class="user-id">Username</h4>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est nam reprehenderit sunt?</p>
      </div>  -->
      </div>
    </div>


    <div class="right-panel">
    <?php
// Check if otherperson is set in the URL parameters
if(isset($_GET['otherperson'])){
    // Check if the session variable 'show' is set
    if(isset($_SESSION['show'])){
        // If both conditions are met, do not display the "Click on a message to start chatting" text
        // This is because the chat is currently being displayed
        // No action is needed here since we want to hide the text when a chat is open
    } else {
        // If the session variable 'show' is not set, display the "Click on a message to start chatting" text
        echo '<div class="start-text"><h2>Click on a message to start chatting</h2></div>';
    }
} else {
    // If 'otherperson' is not set in the URL parameters, display the "Click on a message to start chatting" text
    echo '<div class="start-text"><h2>Click on a message to start chatting</h2></div>';
}
?>
      <?php
      if(isset($_GET['otherperson'])){
      if(isset($_SESSION['show'])){
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      } 
      include("dbconfig.php");
      $user = $_SESSION['user'];
      $otherperson =$_GET['otherperson'];
      // $otherperson = $_POST['otherPerson'];
      
      $sql2 = "SELECT * FROM messages WHERE (sender='$user' AND receiver='$otherperson') OR (sender='$otherperson' AND receiver='$user')";
      $result2 = mysqli_query($conn, $sql2);
      
      echo '<div class="user-detail">
              <h3>', $otherperson, '</h3>
              <a href=" otherprofile.php?user='.$otherperson.'"><img src="/social/assets/info.png"></a>
            </div>';
      
      // Start the <ul> outside the loop
      echo '<ul class="chatbox">';
      
      while ($rows = mysqli_fetch_assoc($result2)) {
      
          // Each message is wrapped in a <li> element
          if ($rows['sender'] == $user) {
              echo '<li class="chat outgoing">
                      <p>', $rows['message'], '</p>
                    </li>';
          } elseif ($rows['sender'] == $otherperson) {
              echo '<li class="chat incoming">
                      <p>', $rows['message'], '</p>
                    </li>';
          }
      }
      
      // Close the <ul> outside the loop
      echo '</ul>';
      echo'<div class="chat-input">
      <form action="message_backend.php" class="chat-input" method="POST">
      <input type="hidden" value="',$otherperson,'" name="otherperson">
      <textarea id="text-input" placeholder="Message..." name="message" required></textarea>
      <button id="chat-send" class = "login-btn">Send</button>
      </form>
      </div>';
    }
  }
    // unset($_SESSION['show']);
      
      //     if(isset($_SESSION['show'])){
  //       $otherperson =$_GET['otherperson'];
  //    include("message_display.php");
  //   unset($_SESSION['show']);
  // }
    //  else{

    //  }
    ?>
    <script>// Add this JavaScript code after the chat content is loaded
// Add this JavaScript code after the chat window is displayed
document.querySelector('.chatbox').style.scrollBehavior = 'auto';
document.querySelector('.chatbox').scrollTop = document.querySelector('.chatbox').scrollHeight;
document.querySelector('.chatbox').style.scrollBehavior = 'smooth';

</script>
      <!-- <div class="user-detail">
        <h3>Cutie</h3>
        <a href=""><img src="/social/assets/info.png"></a>
      </div>
      <ul class="chatbox">

        <li class="chat outgoing">
          <p>Why aren't you replying???</p>
        </li>
        <li class="chat incoming">
          <p>I don't want to talk to you.</p>
        </li>
        
     
      </ul> -->

      
    </div>


  </section>


  




</body>
</html>