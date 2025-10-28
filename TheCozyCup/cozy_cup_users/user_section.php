<?php
    include('../admin_auth.php');  // Include the admin authentication check
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include('../head.php');
    ?>
    <title>Cozy Cup - User Section</title>
    <style>
        /* Full-page centering for the specific section */
        .centered-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 50px); /* Adjust height to exclude navbar height */
            font-family: 'Times New Roman';
            background-color: white;
            text-align: center; /* Center-align text */
        }

        /* Styling for the description */
        .description {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #333;
        }

        /* Styling for the buttons */
        .button-container {
            margin: 20px 0;
            display: flex;
            flex-direction: column; /* Stack buttons vertically */
            gap: 10px; /* Add space between buttons */
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 1.6em;
            font-weight: bold;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button-container button:hover {
            background-color: #45a049;
        }

        h2 {
            font-size: 40px;
            font-family: 'Times New Roman';
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
        include('../navbar.php'); /* Navbar remains unaffected */
    ?>
    <div class="centered-container">
        <h2>User Section</h2>
        <p class="description">Manage your users with ease. You can add new users or search existing ones using the options below.</p>
        <div class="button-container">
            <button onclick="window.location.href='create_user_form.php';">Create New User</button>
            <button onclick="window.location.href='search_user_form.php';">Search Users</button>
        </div>
    </div>
</body>
</html>
