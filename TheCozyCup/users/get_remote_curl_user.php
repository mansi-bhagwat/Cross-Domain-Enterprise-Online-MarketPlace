<?php
// user_list.php

// Include the database connection
include 'db_connection.php';

// Function to fetch users from local database
function fetchRemoteUsersUsingCurl($pdo) {
    try {
        $stmt = $pdo->query("SELECT name FROM remote_user_curl");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching local users: " . $e->getMessage();
        return [];
    }
}

// Fetch local users
$RemoteUsers = fetchRemoteUsersUsingCurl($pdo);

// Return the list of users as a JSON response
header('Content-Type: application/json');
echo json_encode($RemoteUsers);
?>