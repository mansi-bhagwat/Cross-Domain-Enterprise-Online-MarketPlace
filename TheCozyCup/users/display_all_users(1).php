<?php

// Function to fetch users from a URL using cURL
function fetchRemoteUsers($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // curl_setopt($ch, CURLOPT_FAILONERROR, true);

    $response = curl_exec($ch);
    echo "<p> Princely: ". $response."</p>";

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

// Fetch local users using cURL
$localUsers = fetchRemoteUsers($localUrl);

// Display user lists for your local company
echo "<h2>Users from \"The Cozy Cup\"</h2>";
if (!empty($localUsers)) {
    echo "<ul>";
    foreach ($localUsers as $user) {
        echo "<li>{$user['first_name']} {$user['last_name']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No users found in your local database.</p>";
}

/*
// Display user lists for your company B
echo "<h2>Users from \"Company B\"</h2>";
$companyB_users = fetchRemoteUsers('http://cmpe272.000.pe/SoftSolution/get_users.php');
echo "<p> Princely: ". $companyB_users."</p>";
if (!empty($companyB_users)) {
    echo "<ul>";
    foreach ($companyB_users['usernames'] as $user) {
        echo "<li>{$user}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No users found in Company B database.</p>";
}
*/
//************************************* test******************************************************
/*
$url = "http://djmrohitcmpe272cookie.rf.gd/getusers.php";  //"http://cmpe272.000.pe/SoftSolution/get_users.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request and get the response
$response = curl_exec($ch);
if (curl_errno($ch)) {
    // Handle cURL error
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo "<p> Princely: " . htmlspecialchars($response) . "</p>";
}
//echo "<p> Princely: ". $response."</p>";
/*
if (curl_errno($ch)) {
    echo "<li>Failed to fetch external users: " . curl_error($ch) . "</li>";
} else {
    $externalUsers = json_decode($response, true);

    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "<li>Error decoding JSON: " . json_last_error_msg() . "</li>";
    } elseif (is_array($externalUsers)) {
        // Display the external users if available
        foreach ($externalUsers as $user) {
            if (isset($user['first_name']) && isset($user['last_name'])) {
                echo "<li>" . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . "</li>";
            }
        }
    } else {
        echo "<li>No external users found or invalid response format</li>";
    }
}

// Close the cURL session
curl_close($ch);
*/

/*************************************************Test 2*******************************************************/

// Initialize cURL
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, "http://cmpe272.000.pe/SoftSolution/get_users.php");

// Return the response as a string instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Output the raw HTML content
echo "Princely's output:".$response. "";

// Close cURL session
curl_close($ch);


/*
// Display users for each remote company

// Define remote URLs for other companies
$remoteUrls = [
    'Company B' => 'http://cmpe272.000.pe/SoftSolution/get_users.php',
    'Company C' => 'https://companyC.com/get_users.php',
    'Company D' => 'https://companyC.com/get_users.php'
];

// Fetch users from remote companies
$remoteUsers = [];
foreach ($remoteUrls as $company => $url) {
    $remoteUsers[$company] = fetchRemoteUsers($url);
}

foreach ($remoteUrls as $company => $url) {
    $users = fetchRemoteUsers($url);
    
    echo "<h2>Users from \"$company\"</h2>";
    if (!empty($users)) {
        echo "<ul>";
        
        // Adjust the key based on the specific structure of the response
        if (isset($users['users'])) {
            // If the endpoint has 'users' as the key
            foreach ($users['users'] as $user) {
                echo "<li>$user</li>";
            }
        } elseif (isset($users['employees'])) {
            // Handle 'employees' key if it exists
            foreach ($users['employees'] as $user) {
                echo "<li>$user</li>";
            }
        } elseif (isset($users['members'])) {
            // Handle 'members' key if it exists
            foreach ($users['members'] as $user) {
                echo "<li>$user</li>";
            }
        } else {
            echo "<p>Unexpected response format from $company.</p>";
        }
        
        echo "</ul>";
    } else {
        echo "<p>No users found for $company or there was an error fetching data.</p>";
    }
}
*/
?>
