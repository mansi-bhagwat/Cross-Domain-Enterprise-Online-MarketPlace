<?php
// Include the DB connection file
include('../track_product_visits_per_user/db_connection.php');
$conn = getDbConnection('../track_product_visits_per_user/db_config.php');

// Start the session to access session variables
session_start();

// Fetch the user information from the user_sessions table (latest session)
$sql = "SELECT username FROM user_sessions ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($username);
    $stmt->fetch();
} else {
    echo "User session not found! Login back from marketplace";
    exit; // Stop if no session found
}

// Check if the form is submitted for 'Like/Unlike'
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['like'])) {
        // Insert a like entry into the database
        $sql = "INSERT INTO product_reviews (username, product_name, is_liked) VALUES (?, 'Cheese Paratha', 1)
                ON DUPLICATE KEY UPDATE is_liked = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
    } elseif (isset($_POST['unlike'])) {
        // Insert an unlike entry into the database
        $sql = "INSERT INTO product_reviews (username, product_name, is_liked) VALUES (?, 'Cheese Paratha', 0)
                ON DUPLICATE KEY UPDATE is_liked = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
    }

    // Handle review submission
    if (isset($_POST['review'])) {
        $review = $_POST['review_text'];
        $sql = "INSERT INTO product_reviews (username, product_name, comment) VALUES (?, 'Cheese Paratha', ?)
                ON DUPLICATE KEY UPDATE comment = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $review, $review);
        $stmt->execute();
    }
}
?>
