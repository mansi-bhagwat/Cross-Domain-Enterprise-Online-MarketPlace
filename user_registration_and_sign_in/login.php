<?php
session_start();
include('../db_connection.php'); // Include the reusable connection function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Establish database connection
    $conn = getDbConnection('db_config.php');

    // Prepare a query to check if the user exists
    $table = "users";
    $stmt = $conn->prepare("SELECT * FROM $table WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify the user
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // Generate a secure token for authentication on other sites
            //$secret_key = "shared_secret"; // Shared secret key between all sites

            // Path to the file containing the secret key
            $file_path = './secret_key.txt';
            // Read the secret key from the file
            $secret_key = trim(file_get_contents($file_path)); // Use trim to remove any unnecessary whitespace or newlines
            $timestamp = time();
            $auth_token = hash('sha256', $_SESSION['user_id'] . $secret_key . $timestamp);

            // Store the auth_token in the session
            $_SESSION['auth_token'] = $auth_token;

            // First, delete the existing session for the current user
            $delete_stmt = $conn->prepare("DELETE FROM user_sessions WHERE username = ?");
            $delete_stmt->bind_param("s", $_SESSION['username']); // "s" for string (username)
            $delete_stmt->execute();
            
            // Now insert the new auth_token for the current user
            $insert_stmt = $conn->prepare("INSERT INTO user_sessions (username, auth_token) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $_SESSION['username'], $auth_token); // "ss" for two strings (username, auth_token)
            $insert_stmt->execute();


            // Check if the insert was successful
            if ($insert_stmt->affected_rows > 0) {
                // Redirect to the marketplace or member websites with the token
                $redirect_url = '../marketplace_pages/home.php?auth_token=' . $auth_token;
                header("Location: $redirect_url");
                exit();
            } else {
                // Handle the error if the insert fails
                echo "Error: Could not store the session token.";
            }

            // Close the insert statement
            $insert_stmt->close();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "User not found!";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Form for login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
        .back-button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <button type="submit">Login</button>
        </form>
        <!-- Registration button for new users -->
        <p>Don't have an account? <a href="./register.php" class="back-button">Register here</a></p>
        <a href="../marketplace_pages/home.php" class="back-button">&larr; Back to Home</a>
    </div>
</body>
</html>
