<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
include("dbconfig.php");
$currentUser = $_SESSION['user'];

$sql = "SELECT IF(sender='$currentUser', receiver, sender) AS other_person
        FROM messages 
        WHERE sender='$currentUser' OR receiver='$currentUser'
        GROUP BY other_person
        ORDER BY MAX(message_id) DESC"; // Order by the maximum message_id in descending order

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $otherPerson = $row['other_person'];

    // Retrieve the last message exchanged between the current user and the other person
    $lastMessageSql = "SELECT * 
                      FROM messages 
                      WHERE (sender='$currentUser' AND receiver='$otherPerson') 
                          OR (sender='$otherPerson' AND receiver='$currentUser') 
                      ORDER BY message_id DESC 
                      LIMIT 1";

    $lastMessageResult = mysqli_query($conn, $lastMessageSql);
    $lastMessage = mysqli_fetch_assoc($lastMessageResult);

    if ($lastMessage) {
        if ($lastMessage['seen'] == 0 && $lastMessage['receiver'] == $currentUser) {
            echo '<div class="user-container unread">
                    <a href="update_seen_status.php?message_id=' . $lastMessage['message_id'] . '">
                        <img src="/social/assets/dot.png" alt="">
                        <h4 class="user-id">' . $otherPerson . '</h4>
                        <p>'. $lastMessage['sender'].' : ' . $lastMessage['message'] . '</p>
                    </a>
                  </div>';
        } else {
            echo '<div class="user-container">
                    <a href="messages.php?otherperson=' . $otherPerson.'">
                        <h4 class="user-id">' . $otherPerson . '</h4>
                        <p>'. $lastMessage['sender'].' : '  . $lastMessage['message'] . '</p>
                    </a>
                  </div>';
        }
        
    }
}
?>
<!-- Include jQuery from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
function openChat(otherPerson, messageId) {
    // AJAX call to update the seen status
    console.log("openChat function called with otherPerson: ", otherPerson, " and messageId: ", messageId);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Message seen status updated successfully");
            } else {
                console.error("Error updating message seen status:", xhr.statusText);
            }
        }
    };
    xhr.open('POST', 'update_seen_status.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('message_id=' + messageId);

    // Redirect or perform other actions as needed
}


</script>
<script>
// function openChat(otherPerson) {
//     // Send otherPerson value to message_display.php using AJAX
//     $.ajax({
//         url: 'message_display.php',
//         type: 'POST',
//         data: { otherPerson: otherPerson },
//         success: function(response) {
//             // Handle the response if needed
//             // For example, you can update the UI to show the chat messages
//         }
//     });
// } 
 </script> 
<script>
function openChat(otherPerson) {
    // <form action="message_display.php"
    <?php 
$_SESSION['show']="show"; ?>
    window.location.href = 'messages.php?otherperson=' + otherPerson;
 }
</script>





<?php
// session_start();
// include("dbconfig.php");
// $sender=$_SESSION['user'];
// $sql="SELECT * FROM messages WHERE sender='$sender' ORDER BY message_id DESC";
// $result=mysqli_query($conn,$sql);
// while($content=mysqli_fetch_assoc($result)){
  
//        if($content['seen']==0){
//         echo'<div class="user-container unread">
//          <img src="/social/assets/dot.png" alt="">
//          <h4 class="user-id">',$content['reciever'],'</h4>
//         <p>',$content['message'],'</p>
//       </div>';}
        
//        else{
//         echo '<div class="user-container">
//         <h4 class="user-id">',$content['reciever'],'</h4>
//         <p>',$content['message'],'</p>
//       </div>';
//        }
//     }


?> 