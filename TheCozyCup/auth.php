<?php
session_start();

// Function to check authentication status
function checkAuthentication() {
    // Check if the user is authenticated in the session
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        return true;
    }

    // If not, check if the auth_token cookie exists
    if (isset($_COOKIE['auth_token'])) {
        include('./track_product_visits_per_user/db_connection.php');
        $conn = getDbConnection('./track_product_visits_per_user/db_config.php');

        // Validate the auth_token from the cookie
        $stmt = $conn->prepare("SELECT username FROM user_sessions WHERE auth_token = ?");
        $stmt->bind_param("s", $_COOKIE['auth_token']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $user['username'];
            return true;
        }

        $stmt->close();
        $conn->close();
    }

    // If the user is not authenticated, return false
    return false;
}
?>
