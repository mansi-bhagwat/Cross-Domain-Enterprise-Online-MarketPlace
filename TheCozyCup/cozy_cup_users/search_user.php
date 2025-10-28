<?php
include('../admin_auth.php');  // Include the session validation file
$servername = "localhost";
$username = "u138823229_admin"; 
$password = "Cmpe272@sjsu"; // Replace with your DB password
$dbname = "u138823229_cozy_cup";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $conn->real_escape_string($_GET['search_query']);
    $sql = "SELECT * FROM cozy_cup_users 
            WHERE first_name = '$search_query' 
            OR last_name = '$search_query' 
            OR email = '$search_query' 
            OR home_phone = '$search_query' 
            OR cell_phone = '$search_query'";

    $result = $conn->query($sql);

    echo "<h3>Search Results:</h3>";
    
    // Start the wrapper div
    echo '<div style="display: flex; flex-wrap: wrap; gap: 20px;">';

    if ($result->num_rows > 0) {
        // Fetch and display each row
        while ($row = $result->fetch_assoc()) {
            echo '<div style="border: 1px solid #ccc; border-radius: 8px; padding: 16px; width: 300px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
            echo "<p><strong>Name:</strong> " . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
            echo "<p><strong>Home Address:</strong> " . htmlspecialchars($row['home_address']) . "</p>";
            echo "<p><strong>Home Phone:</strong> " . htmlspecialchars($row['home_phone']) . "</p>";
            echo "<p><strong>Cell Phone:</strong> " . htmlspecialchars($row['cell_phone']) . "</p>";
            echo '</div>';
        }
    } else {
        // If no results found, display a message
        echo "<p>No results found.</p>";
    }

    // Close the wrapper div
    echo '</div>';
}



$conn->close();
?>

<!-- Back Button -->
<div style="margin-top: 20px;">
    <button onclick="window.location.href='user_section.php';">Back to User Section</button>
</div>

