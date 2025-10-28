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
       // $redirectUrl = "/products/grilled_cheese_sandwich.php";
        
        // Dynamic base URL
        $baseUrl = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
        $redirectUrl = $baseUrl . "/grilled_cheese_sandwich.php";
    
        // Initialize prepared statements
        $stmt = null;
    
        // Handle like/unlike
        if (isset($_POST['like_status'])) {
            $isLiked = $_POST['like_status'] == '1' ? 1 : 0;
            $sql = "INSERT INTO product_reviews (username, product_name, is_liked) 
                    VALUES (?, 'Grilled Cheese Sandwich', ?)
                    ON DUPLICATE KEY UPDATE is_liked = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sii', $username, $isLiked, $isLiked);
            $stmt->execute();
        }
    
        // Handle review submission
        if (!empty($_POST['review_text'])) {
            $review = $_POST['review_text'];
            $sql = "INSERT INTO product_reviews (username, product_name, comment) 
                    VALUES (?, 'Grilled Cheese Sandwich', ?)
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
    trackProductVisit('Grilled Cheese Sandwich');

    // Display the product information
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product: Grilled Cheese Sandwich</title>
</head>
<body>
    <h1>Grilled Cheese Sandwich</h1>
    <img src="../images/food/grilled_cheese_sandwich1.png" alt="Grilled Cheese Sandwich">
    <p>Indulge in the ultimate comfort food with our Grilled Cheese Sandwich—a golden, crispy delight filled with gooey, melted cheese. Each bite offers a satisfying crunch of perfectly toasted bread, layered with a blend of rich cheeses that ooze with every taste. Simple yet irresistible, this sandwich is a timeless favorite, making it the perfect choice for a quick lunch, cozy snack, or pairing with a hot bowl of soup. Warm, melty, and packed with flavor, our Grilled Cheese Sandwich is crafted to satisfy cravings and bring a little joy to your day.</p>
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
    
    <?php
    $sql = "SELECT username, comment, is_liked 
            FROM product_reviews 
            WHERE product_name = 'Grilled Cheese Sandwich' AND comment IS NOT NULL
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
