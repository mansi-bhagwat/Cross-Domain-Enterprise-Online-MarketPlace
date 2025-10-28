<?php
session_start();
include('db_connection.php'); // Include database connection

$conn = getDbConnection('db_config.php');

// Get the session ID from the user's cookies
$session_id = $_COOKIE['session_id'] ?? null;

// Authenticate the session and get the user ID
$user_id = getUserIdFromSession($session_id);

if (!$user_id) {
    // Redirect to login if the session is invalid
    header("Location: https://apps.ninjacoder.tech/user_registration_and_sign_in/login.php");
    exit();
}

// Get the product ID (e.g., from the URL or request)
$product_id = $_GET['product_id'] ?? null;

if ($product_id) {
    trackProductVisit($user_id, $product_id, $conn);
}

// Fetch product details for display
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

$stmt->close();
$conn->close();
?>