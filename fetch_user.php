<?php
// fetch_user.php

// Include your database connection configuration
include("dbconfig.php");

// Check if the searchTerm parameter exists in the request
if (isset($_GET['searchTerm'])) {
    // Sanitize the input to prevent SQL injection
    $searchTerm = htmlspecialchars($_GET['searchTerm']);

    // Prepare and execute the SQL query to fetch users based on the search term
    $sql = "SELECT * FROM user WHERE username LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$searchTerm%"]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the fetched user data as JSON response
    echo json_encode($users);
} else {
    // If searchTerm parameter is not provided, return an error response
    echo json_encode(["error" => "Search term not provided"]);
}
?>
