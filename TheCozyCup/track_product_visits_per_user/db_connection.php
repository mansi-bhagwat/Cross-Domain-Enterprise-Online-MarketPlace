<?php
function getDbConnection($configFile) {
    // Include the config file for database credentials
    include($configFile);

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for a connection error
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
