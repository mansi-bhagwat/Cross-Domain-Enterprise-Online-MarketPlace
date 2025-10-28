<?php
session_start(); // Start the session to check if user is logged in
?>

<header>
  <div>
    <?php 
    // Dynamically create the base URL for the domain
    $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 
    ?>
    <a href="<?php echo $baseURL; ?>/marketplace_pages/home.php">Home</a>
    <a href="<?php echo $baseURL; ?>/marketplace_pages/about.php">About</a>
    <a href="<?php echo $baseURL; ?>/marketplace_pages/products.php">Products/Services</a>
    <a href="<?php echo $baseURL; ?>/marketplace_pages/news.php">News</a>
  </div>
  <div>
    <?php
    if (isset($_SESSION['user_id'])) {
      // If the user is logged in, show a personalized greeting and logout link
      echo '<a href="#">Hello, ' . htmlspecialchars($_SESSION['username']) . '</a> | ';
      echo '<a href="' . $baseURL . '/user_registration_and_sign_in/logout.php">Logout</a>';
    } else {
      // If the user is not logged in, show Sign In and Sign Up links
      echo '<a href="' . $baseURL . '/user_registration_and_sign_in/login.php">Sign In</a> | ';
      echo '<a href="' . $baseURL . '/user_registration_and_sign_in/register.php">Sign Up</a>';
    }
    ?>
    <a href="#cart">Shopping Cart</a>
  </div>
</header>
