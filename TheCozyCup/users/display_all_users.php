<?php
//include 'get_local_users.php';
// Include the database connection
include 'db_connection.php';

// Function to fetch users from a URL using cURL
function fetchRemoteUsers($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // curl_setopt($ch, CURLOPT_FAILONERROR, true);
    // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36');
    

    $response = curl_exec($ch);
    //echo "<p>". $response."</p>";

    if (curl_errno($ch)) {
        echo "Error fetching remote users from $url: " . curl_error($ch);
        curl_close($ch);
        return [];
    }

    curl_close($ch);
    return json_decode($response, true);
}

/*
// Define the local endpoint URL
$localUrl = 'https://ninjacoder.tech/users/get_local_users.php';  // Replace with your local URL to `get_local_users.php`

echo "<h2>Users from \"The Cozy Cup\"</h2>";

// Fetch local users using cURL
$localUsers = fetchRemoteUsers($localUrl);

// Display user lists for your local company
if (!empty($localUsers)) {
    echo "<ul>";
    foreach ($localUsers as $user) {
        echo "<li>{$user['first_name']} {$user['last_name']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No users found in your local database.</p>";
}
*/
//*******************************************************************
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

// Call the function to fetch local users
$localUsers = fetchLocalUsers($pdo);

echo "<h2>Users from \"The Cozy Cup\"</h2>";
//var_dump($localUsers); // For debugging purposes

if (!empty($localUsers)) {
    echo "<ul>";
    foreach ($localUsers as $user) {
        // Ensure the first and last names are correctly displayed
        if (isset($user['first_name'], $user['last_name'])) {
            $fullName = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
            echo "<li>$fullName</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p>No users found.</p>";
}

//*******************************************************************
// Display users for remote company B


// Function to fetch users from local database
function fetchRemoteUsersUsingCurl($pdo) {
    try {
        $stmt = $pdo->query("SELECT name FROM remote_user_curl");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching remote users: " . $e->getMessage();
        return [];
    }
}

// Fetch remote users
$RemoteUsers = fetchRemoteUsersUsingCurl($pdo);

// Display user names as list items
echo "<h2>Users from \"Soft Solutions\"</h2>";
if (!empty($RemoteUsers)) {
    echo "<ul>";
    foreach ($RemoteUsers as $user) {
        // Each $user is an associative array with 'name' as a key
        echo "<li>" . htmlspecialchars($user['name']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No users found.</p>";
}


?>
