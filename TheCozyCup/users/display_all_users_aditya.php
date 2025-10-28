<?php

// Function to fetch users from a URL using cURL
function fetchRemoteUsers($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects if needed
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36');
    
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // curl_setopt($ch, CURLOPT_FAILONERROR, true);
    // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36');
    

    $response = curl_exec($ch);
    echo "<p>". $response."</p>";

    if (curl_errno($ch)) {
        echo "Error fetching remote users from $url: " . curl_error($ch);
        curl_close($ch);
        return [];
    }

    curl_close($ch);
    return json_decode($response, true);
}

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

// Display users for each remote company

// Define remote URLs for other companies
$remoteUrls = [
    'Company B' => 'https://pawanaditya.tech/users.php',
    'Company C' => 'https://cmpe272.000.pe/SoftSolution/get_users.php',
   // 'Company D' => 'http://djmrohitcmpe272cookie.rf.gd/getusers.php'
];

foreach ($remoteUrls as $company => $url) {
    echo "<h2>Users from \"$company\"</h2>";
    
    $users = fetchRemoteUsers($url);
    
    if (!empty($users) && is_array($users)) {
        echo "<ul>";
        foreach ($users as $user) {
            echo "<li>$user</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No users found for $company or there was an error fetching data.</p>";
    }
}
?>
