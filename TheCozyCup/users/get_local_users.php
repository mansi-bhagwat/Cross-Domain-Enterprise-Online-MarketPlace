<?php
// user_list.php

// Include the database connection
include 'db_connection.php';

// Function to fetch users from local database
function fetchLocalUsers($pdo) {
    try {
        $stmt = $pdo->query("SELECT first_name, last_name FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching local users: " . $e->getMessage();
        return [];
    }
}

// Fetch local users
$localUsers = fetchLocalUsers($pdo);

// Return the list of users as a JSON response
header('Content-Type: application/json');
echo json_encode($localUsers);
?>
