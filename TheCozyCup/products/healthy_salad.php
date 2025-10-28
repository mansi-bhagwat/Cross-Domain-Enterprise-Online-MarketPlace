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
        //$redirectUrl = "/products/healthy_salad.php";
        
        // Dynamic base URL
        $baseUrl = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
        $redirectUrl = $baseUrl . "/healthy_salad.php";
    
        // Initialize prepared statements
        $stmt = null;
    
        // Handle like/unlike
        if (isset($_POST['like_status'])) {
            $isLiked = $_POST['like_status'] == '1' ? 1 : 0;
            $sql = "INSERT INTO product_reviews (username, product_name, is_liked) 
                    VALUES (?, 'Healthy Salad', ?)
                    ON DUPLICATE KEY UPDATE is_liked = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sii', $username, $isLiked, $isLiked);
            $stmt->execute();
        }
    
        // Handle review submission
        if (!empty($_POST['review_text'])) {
            $review = $_POST['review_text'];
            $sql = "INSERT INTO product_reviews (username, product_name, comment) 
                    VALUES (?, 'Healthy Salad', ?)
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
    trackProductVisit('Healthy Salad');

    // Display the product information
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product: Healthy Salad</title>
</head>
<body>
    <h1>Healthy Salad</h1>
    <img src="../images/food/green-salad.jpg" alt="Healthy Salad" class="product-image">
    <p>A refreshing blend of crisp greens, vibrant vegetables, and a zesty vinaigrette, perfect for a light meal or a nutritious side dish.</p>
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
    
    <?php
    $sql = "SELECT username, comment, is_liked 
            FROM product_reviews 
            WHERE product_name = 'Healthy Salad' AND comment IS NOT NULL
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
