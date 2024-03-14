<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle the error appropriately
    header("location: login.php");
    exit;
}

// Ensure otheruser is set
if (!isset($_POST['otheruser'])) {
    // Redirect to a proper error page or handle the error
    echo "Error: otheruser is not set!";
    exit;
}

// Get user and otheruser from session and form submission
$user = $_SESSION['user'];
$otheruser = $_POST['otheruser'];

// Include database configuration
include("dbconfig.php");

// Insert into the follow table
$sql11 = "INSERT INTO follow (`user`, `otherperson`, `follow`) VALUES ('$user', '$otheruser', '1')";
$result11 = mysqli_query($conn, $sql11);

if ($result11) {
    // Set the session variable to indicate that the user has been followed
    $_SESSION['followed'] = "FOLLOWED";

    // Redirect to the profile of the other user
    header("location: otherprofile.php?user=$otheruser");
    exit;
} else {
    // Handle database insertion failure
    echo "Error: Failed to follow user.";
    // Optionally, redirect to an error page or handle the error differently
}
?>
