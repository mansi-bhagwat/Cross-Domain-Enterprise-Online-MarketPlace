<?php
session_start();
include('../db_connection.php'); // Include the reusable connection function

if (isset($_SESSION['username'])) {
    
    // Establish database connection
    $conn = getDbConnection('../db_config.php');
    
    // Delete the session from the database
    $delete_stmt = $conn->prepare("DELETE FROM user_sessions WHERE username = ?");
    $delete_stmt->bind_param("i", $_SESSION['username']);
    $delete_stmt->execute();
    
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    
    header("Location: ../marketplace_pages/home.php");
    
    exit();
} else {
    // If no session, redirect to home page directly
    header("Location: ../marketplace_pages/home.php");
    exit();
}
?>
