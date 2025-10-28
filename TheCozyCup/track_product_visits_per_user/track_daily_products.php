<?php
function trackProductVisit($user_id, $product_id, $db_connection) {
    $visit_date = date('Y-m-d'); // Current date

    // Check if the visit already exists
    $stmt = $db_connection->prepare(
        "SELECT id FROM product_visits_daily WHERE user_id = ? AND product_id = ? AND visit_date = ?"
    );
    $stmt->bind_param("iis", $user_id, $product_id, $visit_date);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        // Insert the visit into the table
        $stmt->close();
        $insert_stmt = $db_connection->prepare(
            "INSERT INTO product_visits_daily (user_id, product_id, visit_date) VALUES (?, ?, ?)"
        );
        $insert_stmt->bind_param("iis", $user_id, $product_id, $visit_date);
        $insert_stmt->execute();
        $insert_stmt->close();
    } else {
        $stmt->close(); // Close the statement if the record already exists
    }
}
?>