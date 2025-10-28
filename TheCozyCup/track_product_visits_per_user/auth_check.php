<?php
session_start(); // Start the session

// Validate the session
if (!isset($_SESSION['username'])) {
    header("Location: /user_registration_and_sign_in/login.php"); // Redirect to login
    exit();
}
?>
