<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if the 'otherperson' parameter is set in the URL
if(isset($_GET['otherperson'])) {
    // Retrieve the value of 'otherperson'
    $otherPerson = $_GET['otherperson'];

    // Now you can use $otherPerson variable in your code
    // For example, you can use it to fetch chat messages from the database
    echo "Chat messages for user: $otherPerson";
} else {
    // If 'otherperson' parameter is not set, handle the situation accordingly
    echo "Other person not specified";
}
// die;



include("dbconfig.php");
$user = $_SESSION['user'];
$otherperson =$_GET['otherperson'];
// $otherperson = $_POST['otherPerson'];

$sql2 = "SELECT * FROM messages WHERE (sender='$user' AND receiver='$otherperson') OR (sender='$otherperson' AND receiver='$user')";
$result2 = mysqli_query($conn, $sql2);

echo '<div class="user-detail">
        <h3>', $otherperson, '</h3>
        <a href=""><img src="/social/assets/info.png"></a>
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
<form action="message_backend.php" method="POST">
<input type="hidden" value="',$otherperson,'" name="otherperson">
<textarea id="text-input" placeholder="Message..." name="message" required></textarea>
<button>Send</button>
</form>
</div>';

$_SESSION['show']="show";
header("location:messages.php");

?>

