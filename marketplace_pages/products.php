<?php
session_start();

// Check if the user is authenticated by checking the session for a valid auth_token
if (isset($_SESSION['auth_token'])) {
    // Get the authentication token from the session
    $auth_token = $_SESSION['auth_token'];
} elseif (isset($_GET['auth_token'])) {
    // If token is passed via URL, store it in the session
    $_SESSION['auth_token'] = $_GET['auth_token'];
    $auth_token = $_SESSION['auth_token'];
} else {
    // If no token, redirect to login page
    header("Location: https://apps.ninjacoder.tech/user_registration_and_sign_in/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marketplace</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

  <!-- Include Header -->
  <div id="header-container"></div>

  <main>
    <div class="container">
      <h1>Welcome to Our Marketplace</h1>
      <section id="products"><br><br><br><br>
        <h2>Our Products/Services</h2><br>
        <div class="products">
          <div class="product">
            <div class="product-image">
              <img src="/images/the cozy cup.png" alt="Product 1">
            </div>
            <h3>The Cozy Cup</h3>
            <p>Grab a morning coffee, enjoy a healthy breakfast, or sit down for a cozy lunch or early dinner.</p>
            <a href="../TheCozyCup/index.php" target="_blank" class="button">Visit Website</a>
          </div>
          <div class="product">
            <div class="product-image">
              <img src="/images/SoftSolution.jpeg" alt="Product 2">
            </div>
            <h3>Soft Solutions</h3>
            <p>Discover innovative solutions for your needs.</p>
            <a href="../SoftSolution/index.php" target="_blank" class="button">Visit Website</a>
          </div>
          <div class="product">
            <div class="product-image">
              <img src="/images/Innovatech_solutions.png" alt="Product 3">
            </div>
            <h3>Innovatech Solutions</h3>
            <p>Reliable and affordable services you can trust.</p>
            <a href="../InnovatechSolutions/index.php" target="_blank" class="button">Visit Website</a>
          </div>
          <div class="product">
            <div class="product-image">
              <img src="/images/Travel.webp" alt="Product 4">
            </div>
            <h3>Wanderlust Adventures</h3>
            <p>Experience premium quality like never before.</p>
            <a href="../WanderlustAdventures/index.php" target="_blank" class="button">Visit Website</a>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Include Footer -->
  <div id="footer-container"></div>

  <script>
    // Load external header and footer
    fetch('../header.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('header-container').innerHTML = data;
      });

    fetch('../footer.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-container').innerHTML = data;
      });
  </script>
</body>
</html>
