<?php
// Start the session to access session variables
//session_start();

// Include necessary files
include('../track_product_visits_per_user/db_connection.php');
include('user_session.php');

// Establish database connection
$conn = getDbConnection('../track_product_visits_per_user/db_config.php');

// Fetch the username (if not already set in the session)
$username = getUsername($conn);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dynamic base URL
    $baseUrl = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
    $redirectUrl = $baseUrl . "/cheese_paratha.php";

    // Like/Unlike submission
    if (isset($_POST['like_status'])) {
        $isLiked = $_POST['like_status'] == '1' ? 1 : 0;

        // Check if record exists
        $sql = "SELECT COUNT(*) FROM product_reviews WHERE username = ? AND product_name = 'Cheese Paratha'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($recordExists);
        $stmt->fetch();
        $stmt->close();

        if ($recordExists > 0) {
            // Update existing record
            $sql = "UPDATE product_reviews SET is_liked = ? WHERE username = ? AND product_name = 'Cheese Paratha'";
        } else {
            // Insert new record
            $sql = "INSERT INTO product_reviews (username, product_name, is_liked) VALUES (?, 'Cheese Paratha', ?)";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($recordExists > 0 ? 'is' : 'si', $isLiked, $username);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Review submission
    if (!empty($_POST['review_text'])) {
        $review = $_POST['review_text'];

        // Check if record exists
        $sql = "SELECT COUNT(*) FROM product_reviews WHERE username = ? AND product_name = 'Cheese Paratha'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($recordExists);
        $stmt->fetch();
        $stmt->close();

        if ($recordExists > 0) {
            // Update existing record
            $sql = "UPDATE product_reviews SET comment = ? WHERE username = ? AND product_name = 'Cheese Paratha'";
        } else {
            // Insert new record
            $sql = "INSERT INTO product_reviews (username, product_name, comment) VALUES (?, 'Cheese Paratha', ?)";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($recordExists > 0 ? 'ss' : 'ss', $review, $username);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Redirect back to products page after submission
    header("Location: $redirectUrl");
    exit();
}

// Track the product visit
include('track_visits.php');
trackProductVisit('Cheese Paratha');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product: Cheese Paratha</title>
</head>
<body>
    <h1>Cheese Paratha</h1>
    <img src="../images/food/cheese_paratha.jpeg" alt="Cheese Paratha">
    <p>Indulge in the delicious fusion of traditional and modern flavors with our Cheese Paratha</p>
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

    <!-- Display current review (if any) -->
    <?php
    $sql = "SELECT username, comment, is_liked 
            FROM product_reviews 
            WHERE product_name = 'Cheese Paratha' AND comment IS NOT NULL
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
    $stmt->close();
    ?>

    <a href="../products.php">Back to products</a>
</body>
</html>
