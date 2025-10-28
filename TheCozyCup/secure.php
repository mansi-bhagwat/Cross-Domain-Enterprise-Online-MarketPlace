<?php
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
    <?php include('navbar.php'); ?>

    <div class="secure-section w3-container w3-center" style="font-family: Times New Roman;">
        <h2 style="margin: 40px auto; font-size: 3em; color: blue;">DOCUMENT LISTINGS</h2>

        <!-- Table for listing users document -->
        <table class="w3-table w3-bordered w3-striped" style="max-width: 600px; margin: 20px auto;">
            <thead>
                <tr class="w3-light-grey">
                    <th>Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Current Users List</td>
                    <td>
                        <!-- Button to preview the document -->
                        <a href="preview_users.php" class="w3-button w3-blue w3-margin-right" style="border-radius: 12px;">Preview</a>

                        <!-- Button to download the document -->
                        <a href="current_users.txt" class="w3-button w3-green" download="current_users.txt" style="border-radius: 12px;">Download</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="logout.php" class="w3-button w3-red w3-margin-top" style="border-radius: 12px;">Logout</a>
    </div>
</body>
</html>
