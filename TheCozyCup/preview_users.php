<?php
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Read the users document
$usersDocument = file_get_contents('current_users.txt');
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
    <?php include('navbar.php'); ?>

    <div class="w3-container w3-center" style="font-family: 'Times New Roman', monospace; margin-top: 20px;">
        <h2 class="w3-text-blue" style="margin: 40px auto; font-size: 3em;">Preview of Current Users</h2>

        <!-- Display the document contents with monospaced font for alignment -->
        <pre style="background-color: #f4f4f4; padding: 20px; max-width: 600px; margin: 20px auto; border-radius: 8px; white-space: pre-wrap; text-align: left;"><?php echo htmlspecialchars(trim($usersDocument)); ?></pre>

        <!-- Back button to return to secure section -->
        <a href="secure.php" class="w3-button w3-gray w3-margin-top" style="border-radius: 12px;">Back</a>
    </div>
</body>
</html>
