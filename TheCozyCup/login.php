<?php
session_start();
$error = '';

// File that stores login information
$login_file = 'credentials.txt';

// Function to encrypt the password
function encrypt_password($password) {
    return password_hash($password, PASSWORD_DEFAULT); // Hash the password securely
}

// Function to verify the password
function verify_password($entered_password, $stored_hash) {
    return password_verify($entered_password, $stored_hash);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // Open the file for reading
    $file = fopen($login_file, 'r');
    $login_successful = false;

    // Read through the file line by line to check for a matching username and password
    while (($line = fgets($file)) !== false) {
        // Each line should be in the format: username:hashed_password
        list($stored_user, $stored_pass_hash) = explode(':', trim($line));

        // Check if username matches and verify password
        if ($userid == $stored_user && verify_password($password, $stored_pass_hash)) {
            $login_successful = true;
            break;
        }
    }

    fclose($file); // Close the file when done

    // If login successful, redirect to the secure page
    if ($login_successful) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: secure.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

// For testing purposes, if the file doesn't exist, create it with a sample user
if (!file_exists($login_file)) {
    $file = fopen($login_file, 'w');
    $sample_user = 'admin';
    $sample_pass = encrypt_password('admin123'); // Encrypt the password
    fwrite($file, "$sample_user:$sample_pass\n");
    fclose($file); // Close the file after writing
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
    <?php include('navbar.php'); ?>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="login.php">
            <label for="userid">USERNAME</label>
            <input type="text" id="userid" name="userid" required style="margin-left: 10px;"><br><br>
            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password" required style="margin-left: 10px;"><br><br>
            <input type="submit" value="Login">
        </form>
    
        <p style="color:red; margin-top: 20px;"><?php echo $error; ?></p>
    </div>
</body>
</html>