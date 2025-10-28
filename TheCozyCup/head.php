<head>
    <title>Welcome to the Cozy Cup</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
    <style>
        /* Ensure body and html fill the screen */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Amatic SC', sans-serif;
        }

        .menu {
            display: none
        }

        /* Set full height for header and allow it to expand */
        header {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("./images/background/background_1.png");
            min-height: 100vh; /* Ensure it covers full viewport */
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .no-bg {
            background: transparent; /* Ensures the background is transparent */
        }

        #myNavbar a {
            color: white;
            font-weight: bold;
        }
        
        /* Style for the login form container */
        .login-container {
            text-align: center;
            padding: 20px;
            font-family: 'Times New Roman';
            font-size: 1em;
        }
        
        /* Style for form elements */
        input[type="text"], input[type="password"] {
            padding: 8px;
            margin: 10px 0;
            width: 100%;
            max-width: 300px; /* Limit the width of the input fields */
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        
        
    </style>
</head>