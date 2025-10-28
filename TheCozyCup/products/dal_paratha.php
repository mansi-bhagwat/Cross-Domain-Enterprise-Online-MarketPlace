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
        // $redirectUrl = "/products/dal_paratha.php";
        // Dynamic base URL
        $baseUrl = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
        $redirectUrl = $baseUrl . "/dal_paratha.php";
    
        // Initialize prepared statements
        $stmt = null;
    
        // Handle like/unlike
        if (isset($_POST['like_status'])) {
            $isLiked = $_POST['like_status'] == '1' ? 1 : 0;
            $sql = "INSERT INTO product_reviews (username, product_name, is_liked) 
                    VALUES (?, 'Dal Paratha', ?)
                    ON DUPLICATE KEY UPDATE is_liked = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sii', $username, $isLiked, $isLiked);
            $stmt->execute();
        }
    
        // Handle review submission
        if (!empty($_POST['review_text'])) {
            $review = $_POST['review_text'];
            $sql = "INSERT INTO product_reviews (username, product_name, comment) 
                    VALUES (?, 'Dal Paratha', ?)
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
    trackProductVisit('Dal Paratha');

    // Display the product information
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product: Dal Paratha</title>
</head>
<body>
    <h1>Dal Paratha</h1>
    <img src="../images/food/dal_paratha.jpeg" alt="Dal Paratha">
    <p>A flavorful and nutritious Indian flatbread that combines the richness of whole wheat flour with the earthy flavors of spiced lentils. Each paratha is carefully filled with a blend of cooked lentils, typically moong or chana dal, seasoned with a mix of traditional spices like cumin, coriander, and turmeric. This filling is then wrapped in dough and rolled out to form a perfectly stuffed flatbread. Pan-fried to golden perfection, Dal Paratha is crispy on the outside, with a soft and savory filling inside. Enjoy it with yogurt, pickle, or a side of fresh salad for a hearty breakfast, lunch, or dinner. This wholesome dish is packed with protein and offers a delicious way to enjoy the goodness of lentils.</p>
    <p>Price: $9.50</p>
    
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
            WHERE product_name = 'Dal Paratha' AND comment IS NOT NULL
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
