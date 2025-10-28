<?php
session_start();

// Check if the user is authenticated by checking the session for a valid auth_token
if (isset($_SESSION['auth_token'])) {
    // Get the authentication token from the session
    $auth_token = $_SESSION['auth_token'];
} elseif (isset($_GET['auth_token'])) {
    // If token is passed via URL, verify and store it in the session
    $_SESSION['auth_token'] = $_GET['auth_token'];
    $auth_token = $_SESSION['auth_token'];
} else {
    // If no token, redirect to login page
    header("Location: ../user_registration_and_sign_in/login.php");
    exit();
}

include('../db_connection.php'); // Database connection

// Fetch trending products
$conn = getDbConnection('db_config.php'); // Reusable connection function
$stmt = $conn->prepare("SELECT product_reviews.product_name, sum(is_liked) as product_upvote, products.product_desc as product_description FROM `product_reviews` JOIN products ON product_reviews.product_name = products.product_name GROUP BY product_reviews.product_name ORDER BY product_upvote DESC LIMIT 5;");
$stmt->execute();
$result = $stmt->get_result();
$trending_products = $result->fetch_all(MYSQLI_ASSOC);



// Close the connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marketplace - Home</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <!-- Include Header -->
    <div id="header-container"></div>

    <!-- Trending Products Section -->
    <main>
        <h1>Trending Products (Top 5 in Marketplace)</h1><br>

        <section id="products">
            <div class="products">
                <?php if (count($trending_products) > 0): ?>
                    <?php foreach ($trending_products as $product): ?>
                        <div class="product">
                            <div class="product-image">
                                <?php
                                // Define potential image formats
                                $imageFormats = ['png', 'jpeg', 'jpg', 'gif'];

                                // Generate the product image path dynamically
                                $productName = htmlspecialchars($product['product_name']);
                                $imagePath = null;

                                foreach ($imageFormats as $format) {
                                    $potentialPath = "/marketplace_pages/images/$productName.$format";
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $potentialPath)) {
                                        $imagePath = $potentialPath;
                                        break;
                                    }
                                }

                                // Default image path if no image is found
                                if (!$imagePath) {
                                    $imagePath = "/images/WanderlustAdventures.webp";
                                }
                                ?>
                                <img src="<?= htmlspecialchars($imagePath); ?>" alt="<?= $productName; ?>">
                            </div>
                            <h3><?= htmlspecialchars($product['product_name']); ?></h3>
                            <p><?= htmlspecialchars($product['product_description']); ?></p>
                            
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No trending products for today. Check back later!</p>
                <?php endif; ?>
            </div>
        </section>
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

