<?php
    // Include necessary files
    include('../track_product_visits_per_user/db_connection.php');
    include('user_session.php');
    
    // Establish database connection
    $conn = getDbConnection('../track_product_visits_per_user/db_config.php');
    
    // Fetch the username (if not already set in the session)
    $username = getUsername($conn);
    
    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare for redirection
      //  $redirectUrl = "/products/tea.php";
        
        // Dynamic base URL
        $baseUrl = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
        $redirectUrl = $baseUrl . "/tea.php";
    
        // Initialize prepared statements
        $stmt = null;
    
        // Handle like/unlike
        if (isset($_POST['like_status'])) {
            $isLiked = $_POST['like_status'] == '1' ? 1 : 0;
            $sql = "INSERT INTO product_reviews (username, product_name, is_liked) 
                    VALUES (?, 'Tea', ?)
                    ON DUPLICATE KEY UPDATE is_liked = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sii', $username, $isLiked, $isLiked);
            $stmt->execute();
        }
    
        // Handle review submission
        if (!empty($_POST['review_text'])) {
            $review = $_POST['review_text'];
            $sql = "INSERT INTO product_reviews (username, product_name, comment) 
                    VALUES (?, 'Tea', ?)
                    ON DUPLICATE KEY UPDATE comment = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $username, $review, $review);
            $stmt->execute();
        }
    
        // Redirect back to products page after submission
        header("Location: $redirectUrl");
        exit();
    }
    
    // Include the function to track visited products
    include('track_visits.php');
    trackProductVisit('Tea');

    // Display the product information
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product: Tea</title>
</head>
<body>
    <h1>Tea</h1>
    <img src="../images/food/tea.jpeg" alt="Tea" class="product-image">
    <p>Masala Tea, a soul-warming beverage infused with rich spices, captures the essence of traditional Indian flavors in every sip. This tea combines robust black tea leaves with a blend of aromatic spices like cardamom, cinnamon, cloves, and ginger, creating a symphony of flavors that’s both invigorating and comforting. The spices add a gentle warmth and a hint of zest, perfectly balanced with creamy milk, resulting in a drink that’s as soothing as it is energizing. Whether enjoyed in the quiet moments of the morning or shared with friends in the evening, Masala Tea offers a delightful escape with its spicy-sweet aroma and satisfying depth.</p>
    <p>Price: $4.00</p>
    
     <!-- Unified Form for Like/Unlike and Review -->
    <form method="POST">
        <label>
            <input type="radio" name="like_status" value="1"> Like
        </label>
        <label>
            <input type="radio" name="like_status" value="0"> Unlike
        </label>
        <br><br>
        <textarea name="review_text" rows="4" cols="50" placeholder="Write your review here..."></textarea><br>
        <button type="submit">Submit</button>
    </form>
    
    <!-- Display recent reviews (if any) -->

    <?php
    $sql = "SELECT username, comment, is_liked 
            FROM product_reviews 
            WHERE product_name = 'Tea' AND comment IS NOT NULL
            ORDER BY id DESC 
            LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($reviewUsername, $reviewComment, $reviewIsLiked);

    echo "<h3>Recent 5 Product Reviews:</h3>";
    echo "<ul>";

    $hasReviews = false;
    while ($stmt->fetch()) {
        $hasReviews = true;
        $likeStatus = $reviewIsLiked ? "Liked" : "Unliked";
        echo "<li><strong>$reviewUsername:</strong> $reviewComment (Rating: $likeStatus)</li>";
    }

    if (!$hasReviews) {
        echo "<li>No reviews yet.</li>";
    }

    echo "</ul>";
    ?>
    
    <a href="../products.php">Back to products</a>
</body>
</html>
