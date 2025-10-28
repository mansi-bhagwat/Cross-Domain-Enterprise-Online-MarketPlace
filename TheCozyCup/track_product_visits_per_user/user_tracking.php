<?php
include('db_connection.php'); // Include the reusable connection function

function trackProductVisitInDB($productId) {
    // Retrieve the user ID using cURL from the external API
    $user_id = getUserIdFromAPI();

    // Fetch session ID from user_sessions table based on the user ID
    $session_id = getSessionIdFromDatabase($user_id);

    // Track the visit and insert it into the product_visits table
    insertProductVisit($user_id, $session_id, $productId);
}

function getUserIdFromAPI() {
    // URL of the external API to get the user ID
    $url = 'https://apps.ninjacoder.tech/api/get_user_id.php';

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Get response as a string
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Follow redirects

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        // Handle cURL error
        echo 'cURL Error: ' . curl_error($ch);
        return null;
    }

    // Close cURL session
    curl_close($ch);

    // Return the user ID or handle case where it's invalid
    return $response ? trim($response) : null;
}

function getSessionIdFromDatabase($user_id) {
    // Create connection
    $conn = getDbConnection('db_config.php');

    // Query to retrieve session ID from user_sessions table
    $sql = "SELECT session_id FROM user_sessions WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Return the session ID
        $row = $result->fetch_assoc();
        $session_id = $row['session_id'];
    } else {
        // Handle case where no session ID is found
        $session_id = null;
    }

    // Close connection
    $conn->close();

    return $session_id;
}

function insertProductVisit($user_id, $session_id, $product_id) {
    // Create connection
    $conn = getDbConnection('db_config.php');

    // Get the current date
    $visit_date = date('Y-m-d H:i:s');

    // Check if the user has visited the product already to update visit count
    $sql = "SELECT visit_count FROM product_visits WHERE user_id = '$user_id' AND product_id = '$product_id' AND session_id = '$session_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the visit count
        $row = $result->fetch_assoc();
        $new_visit_count = $row['visit_count'] + 1;

        // Update the product visit record
        $update_sql = "UPDATE product_visits SET visit_count = '$new_visit_count', visit_date = '$visit_date' WHERE user_id = '$user_id' AND product_id = '$product_id' AND session_id = '$session_id'";
        $conn->query($update_sql);
    } else {
        // Insert a new record for the product visit
        $insert_sql = "INSERT INTO product_visits (user_id, session_id, product_id, visit_count, visit_date)
                       VALUES ('$user_id', '$session_id', '$product_id', 1, '$visit_date')";
        $conn->query($insert_sql);
    }

    // Close connection
    $conn->close();
}

?>
