<?php
function trackProductVisit($productName) {
    // Track the last 5 visited products
    $visitedProducts = isset($_COOKIE['visited_products']) ? explode(',', $_COOKIE['visited_products']) : [];

    // Remove the product if it’s already in the list
    if (($key = array_search($productName, $visitedProducts)) !== false) {
        unset($visitedProducts[$key]);
    }

    // Add the product to the beginning of the array
    array_unshift($visitedProducts, $productName);

    // Keep only the last five products
    if (count($visitedProducts) > 5) {
        array_pop($visitedProducts);
    }

    // Save the updated list back to the cookie
    setcookie('visited_products', implode(',', $visitedProducts), time() + (86400 * 10), '/'); // 10 days

    // Track the top 5 most frequently visited products
    trackProductFrequency($productName);
}

function trackProductFrequency($productName) {
    // Retrieve the 'frequent_products' cookie, or initialize an empty array if it doesn't exist
    $frequentProducts = isset($_COOKIE['frequent_products']) ? explode(',', $_COOKIE['frequent_products']) : [];

    // Parse products and their counts into an associative array
    $productCounts = [];
    foreach ($frequentProducts as $entry) {
        if (strpos($entry, '|') !== false) { // Ensure valid data format
            list($name, $count) = explode('|', $entry);
            $productCounts[trim($name)] = (int)$count; // Trim product names
        }
    }

    // Increment the visit count for the current product or add it if not present
    if (isset($productCounts[$productName])) {
        $productCounts[$productName]++;
    } else {
        // Add the product with a count of 1 if it's not already in the array
        $productCounts[$productName] = 1;
    }

    // Convert the array back to a format suitable for storing in a cookie
    $frequentProducts = [];
    foreach ($productCounts as $name => $count) {
        $frequentProducts[] = $name . '|' . $count;
    }

    // Save the updated list back to the cookie (maintaining all products)
    setcookie('frequent_products', implode(',', $frequentProducts), time() + (86400 * 10), '/'); // 10 days
}


?>
