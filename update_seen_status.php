<?php
// update_seen_status.php
session_start();
   include("dbconfig.php");
        // Sanitize and validate input
        $messageId = $_GET['message_id'];

        $sql4="UPDATE messages SET seen = 1 WHERE message_id = '$messageId'";
        mysqli_query($conn,$sql4);
        $sql5="SELECT* FROM messages WHERE message_id='$messageId'";
        $result5=mysqli_query($conn,$sql5);
        $row5=mysqli_fetch_assoc($result5);
        
      // $_SESSION['do']="do";
      unset($_SESSION['seen']);
 
      header("location:messages.php?otherperson=". $row5['sender'] ."");

?>
