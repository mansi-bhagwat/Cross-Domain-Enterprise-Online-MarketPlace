<?php
// Start the session to access session variables
session_start();

// Function to get the current logged-in user's username from the session or database
function getUsername($conn) {
    // Check if the username is already stored in the session
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    }

    // If the session doesn't have the username, fetch it from the database (latest session)
    $sql = "SELECT username FROM user_sessions ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username);
        $stmt->fetch();
        $_SESSION['username'] = $username; // Store the username in session for future use
        return $username;
    } else {
        echo "User session not found! Please log in again from marketplace.";
        exit; // Exit if no session is found
    }
}
?>
