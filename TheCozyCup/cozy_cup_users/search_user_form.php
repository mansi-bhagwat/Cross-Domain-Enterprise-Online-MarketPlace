<?php
include('../admin_auth.php');  // Include the session validation file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users - Cozy Cup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container label {
            font-size: 1.2em;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1.1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-button {
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .back-button:hover {
            background-color: #e53935;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            .form-container input[type="text"],
            .form-container input[type="submit"],
            .back-button {
                font-size: 1em;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <h2>User Search</h2>
    <div class="form-container">
        <form method="GET" action="search_user.php">
            <label for="search_query">Search by Name, Email, or Phone:</label>
            <input type="text" id="search_query" name="search_query" placeholder="Enter search term" required>
            <input type="submit" value="Search">
        </form>
        <button class="back-button" onclick="window.location.href='user_section.php';">Back to User Section</button>
    </div>

</body>
</html>
