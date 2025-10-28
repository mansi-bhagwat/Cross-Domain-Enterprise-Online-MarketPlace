<?php
include('../admin_auth.php');  // Include the admin authentication check

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Check if fields are set and not empty
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['home_address']) || empty($_POST['home_phone']) || empty($_POST['cell_phone'])) {
        echo "Please fill in all the required fields.";
    } else {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $home_address = $_POST['home_address'];
        $home_phone = $_POST['home_phone'];
        $cell_phone = $_POST['cell_phone'];
    
        $sql = "INSERT INTO cozy_cup_users (first_name, last_name, email, home_address, home_phone, cell_phone)
                VALUES ('$first_name', '$last_name', '$email', '$home_address', '$home_phone', '$cell_phone')";
    
        if ($conn->query($sql) === TRUE) {
            echo "New user created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!-- Back Button -->
<div style="margin-top: 20px;">
    <button onclick="window.location.href='user_section.php';">Back to User Section</button>
</div>

