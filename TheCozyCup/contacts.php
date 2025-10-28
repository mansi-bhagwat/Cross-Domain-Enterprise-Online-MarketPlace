<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('head.php');
    ?>
    <style>
        body {
            display: flex;               /* Use flexbox for the body */
            flex-direction: column;      /* Align items vertically */
            align-items: center;         /* Center items horizontally */
        }

        header {
            width: 100%;                 /* Ensure the header takes the full width */
        }
        
        /* Style for the card container */
        .card-container {
            background-color: rgba(51, 99, 32, 0.8);
            color: white;
            text-align: center;
            padding: 20px; /* Add padding for better text wrapping */
            width: 80%; /* Card width */
            max-width: 500px; /* Max width for larger screens */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for the card */
            margin: 80px auto 0; /* Centering the card */
            height: 450px; /* Fixed height for the card */
            overflow: hidden; /* Hide overflowing content */
            display: flex;
            flex-direction: column; /* Stack children vertically */
        }

        /* Scrollable content inside the card */
        .card-content {
            font-size: 20px;
            overflow-y: auto; /* Enable vertical scroll when content exceeds */
            padding: 10px;
            flex-grow: 1; /* Allow the content area to expand */
        }

        .card-content span {
            font-size: 30px; /* Adjust font size for text inside the card */
            font-weight: bold;
            word-wrap: break-word; /* Ensure long words wrap */
        }
        
    </style>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <!-- Header with image -->
    <header id="home">
        <div class="card-container">
            <div class="card-content">
                <span class="w3-text-white w3-cursive" style="font-size:40px; font-weight: bold;"><b>We look forward to having you at the Cozy Cup!</b><br></span>
                <p>
                    <?php
                        $contacts = fopen("./input_text/contacts.txt", "r");
                        while(($line=fgets($contacts))!==false)
                        {
                            echo '<span class="w3-text-white w3-cursive" style="font-size:30px; font-weight: bold; text-transform: none;">' . $line . '</span><br/>';
                            echo "<br/>";
                        }
                        fclose($contacts);
                    ?>
                </p>
            </div>
        </div>
    </header>
</body>
</html>
