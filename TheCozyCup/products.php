<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('head.php');
    ?>
    <style>
        .products-container {
            display: flex;
            flex-wrap: wrap; /* Allows wrapping of cards */
            justify-content: space-around; /* Space between cards */
            padding: 20px;
            margin-top: 100px; /* Add margin to push cards below the navbar */
        }

        .product-card {
            background-color: #fff; /* White background for cards */
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            margin: 10px; /* Space between cards */
            padding: 15px; /* Space inside the card */
            width: 300px; /* Fixed width for cards */
            height: 350px; /* Fixed height for cards to ensure uniformity */
            text-align: center; /* Centered text */
            display: flex; /* Use flexbox for card content */
            flex-direction: column; /* Stack children vertically */
            justify-content: space-between; /* Distribute space between children */
        }

        .product-card img {
            max-width: 100%; /* Responsive image */
            height: 200px; /* Fixed height for images */
            object-fit: cover; /* Maintain aspect ratio, cropping if necessary */
            border-radius: 8px; /* Rounded corners for images */
        }

        .product-name {
            font-size: 40px; /* Font size for product name */
            font-weight: bold; /* Bold text */
            margin: 10px 0; /* Margin for spacing */
        }

        .product-price {
            color: green; /* Price color */
            font-size: 30px; /* Font size for price */
            font-weight: bold;
            margin: 5px 0; /* Margin for spacing */
        }

        .product-description {
            font-size: 20px; /* Font size for description */
            color: #666; /* Gray color */
            font-weight: bold;
            height: 80px; /* Set a fixed height */
            overflow: auto; /* Add scroll when content overflows */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .product-card {
                width: calc(100% - 40px); /* Full width for smaller screens minus margin */
                height: auto; /* Auto height for smaller screens */
            }
        }

        @media (min-width: 769px) {
            .product-card {
                width: calc(33.33% - 40px); /* Three cards in a row on larger screens */
            }
        }

        .visited-products {
            margin: 20px;
            font-size: 28px;
            font-family: 'Times New Roman';
            color: blue;
        }
        
        .frequent-products {
            margin: 20px;
            font-size: 28px;
            font-family: 'Times New Roman';
            color: blue;
        }
    </style>
    <script>
        // JavaScript to toggle the visibility of visited products
        function toggleVisitedProducts() {
            const visitedSection = document.getElementById('visited-products');
            if (visitedSection.style.display === 'none' || visitedSection.style.display === '') {
                visitedSection.style.display = 'block';
            } else {
                visitedSection.style.display = 'none';
            }
        }
        
        // JavaScript to toggle the visibility of frequesnt products
        function toggleFrequentProducts() {
            const visitedSection = document.getElementById('frequent-products');
            if (visitedSection.style.display === 'none' || visitedSection.style.display === '') {
                visitedSection.style.display = 'block';
            } else {
                visitedSection.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <!-- Products Section -->
    <div class="products-container">
        <div class="product-card">
            <a href="./products/coffee.php">
                <img src="./images/food/coffee.jpeg" alt="Coffee" class="product-image">
                <div class="product-name">Coffee</div>
            </a>    
        </div>
        <div class="product-card">
            <a href="./products/eggs_benedict.php">
                <img src="./images/food/Egg-Puff-Pastry-Bundle-Featured-Image-.jpg" alt="Eggs Benedict" class="product-image">
                <div class="product-name">Eggs Benedict</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/healthy_salad.php">
                <img src="./images/food/green-salad.jpg" alt="Healthy Salad" class="product-image">
                <div class="product-name">Healthy Salad</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/tea.php">
                <img src="./images/food/tea.jpeg" alt="Tea" class="product-image">
                <div class="product-name">Tea</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/omelette.php">
                <img src="./images/food/omelette1.jpeg" alt="Omelette" class="product-image">
                <div class="product-name">Omelette</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/grilled_cheese_sandwich.php">
                <img src="./images/food/grilled_cheese_sandwich.png" alt="Grilled Cheese Sandwich" class="product-image">
                <div class="product-name">Grilled Cheese Sandwich</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/nachos.php">
                <img src="./images/food/nachos.png" alt="Nachos" class="product-image">
                <div class="product-name">Nachos</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/cheese_paratha.php">
                <img src="./images/food/cheese_paratha.jpeg" alt="Cheese Paratha" class="product-image">
                <div class="product-name">Cheese Paratha</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/dal_paratha.php">
                <img src="./images/food/dal_paratha.jpeg" alt="Dal Paratha" class="product-image">
                <div class="product-name">Dal Paratha</div>
            </a>
        </div>
        <div class="product-card">
            <a href="./products/idli_sambar.php">
                <img src="./images/food/idli_sambar.jpeg" alt="Idli Sambar" class="product-image">
                <div class="product-name">Idli Sambar</div>
            </a>
        </div>
    </div>

    <!-- Link to show previously visited products -->
    <div class="visited-products">
        <a href="javascript:void(0)" onclick="toggleVisitedProducts()">Show Last 5 Previously Visited Products</a>
    </div>

    <!-- Section for displaying last five visited products -->
    <div id="visited-products" class="visited-products" style="display: none; color: green">
        <?php
        if (isset($_COOKIE['visited_products'])) {
            $visitedProducts = explode(',', $_COOKIE['visited_products']);
            echo "<h1>Recently Visited Products:</h1><ul>";
            foreach ($visitedProducts as $product) {
                echo "<li>$product</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No products visited yet.</p>";
        }
        ?>
    </div>
    
     <!-- Link to show previously visited products -->
    <div class="frequent-products">
        <a href="javascript:void(0)" onclick="toggleFrequentProducts()">Show Five Most Visited Products</a>
    </div>

    <!-- Section for displaying top five most frequently visited products -->
    <div id="frequent-products" class="frequent-products" style="display: none; color: green">
        <?php
        function formatString($input) {
            // Replace spaces with underscores and convert to lowercase
            $formattedString = str_replace(' ', '_', $input);
            return strtolower($formattedString);
        }
        
        if (isset($_COOKIE['frequent_products']) && !empty($_COOKIE['frequent_products'])) {
            // Retrieve and parse the 'frequent_products' cookie
            $frequentProducts = explode(',', $_COOKIE['frequent_products']);
            echo "<h1>Most Visited Products</h1><ul>";
            
            // Parse the products and their counts into an associative array
            $productCounts = [];
            foreach ($frequentProducts as $entry) {
                if (strpos($entry, '|') !== false) { // Ensure valid data format
                    list($name, $count) = explode('|', $entry);
                    $productCounts[trim($name)] = (int)$count; // Trim product names
                }
            }
    
            // Sort products by visit count in descending order
            arsort($productCounts);
            
            // Keep only the top five products
            $topProducts = array_slice($productCounts, 0, 5, true);
    
            foreach ($topProducts as $name => $count) {
                $name = htmlspecialchars($name); // Sanitize product name for output
                
                // Call the formatString function to format the product name so it displays correctly in link
                $formattedName = formatString($name);
                
                // Use the formatted name in the link
                echo "<li><a href='https://dummy/products/{$formattedName}.php'>$name</a> (Visited $count times)</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No products visited frequently yet.</p>";
        }
        ?>
    </div>


</body>
</html>