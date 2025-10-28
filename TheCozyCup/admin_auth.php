<?php
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: /login.php'); // Redirect to login page if not logged in
    exit();
}
?>
