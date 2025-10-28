<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: "Amatic SC", sans-serif;
            background-color: #f9f9f9; /* Light background for contrast */
        }

        /* Styling for the news page container */
        .news-container {
            max-width: 1200px;
            margin: 100px auto 50px; /* Center the content and add margin for spacing */
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        /* Styling for each news card */
        .news-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: 450px; /* Fixed height for the card */
            margin: 20px;
            padding: 20px;
            text-align: center;
            overflow-y: auto; /* Enable vertical scrolling */
            transition: transform 0.3s ease;
        }

        .news-card:hover {
            transform: scale(1.05); /* Slightly enlarge the card on hover */
        }

        /* Image in the news card */
        .news-card img {
            width: 100%;
            height: 250px; /* Adjusted image height */
            object-fit: cover;
            border-radius: 10px;
        }

        /* Title for each card */
        .news-title {
            font-size: 28px;
            font-weight: bold;
            margin: 15px 0;
        }

        /* Description in the card */
        .news-description {
            font-size: 20px;
            font-weight: bold;
            color: #666;
            margin: 10px 0;
        }

        /* Button to learn more */
        .learn-more-btn {
            background-color: #33771c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .learn-more-btn:hover {
            background-color: #2a5d16; /* Darken button on hover */
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    
    <!-- News Section -->
    <div class="news-container">
        <!-- Rewards Program Card -->
        <div class="news-card">
            <img src="./images/news/loyalty_program.png" alt="Loyalty Program">
            <div class="news-title">Join Our Loyaly Program!</div>
            <div class="news-description">
                Earn points with every purchase and get a free coffee after 10 visits! Sign up today and start saving.
            </div>
            <button class="learn-more-btn">Learn More</button>
        </div>

        <!-- Discount Card -->
        <div class="news-card">
            <img src="./images/news/discount.png" alt="Discount Offer">
            <div class="news-title">20% Off on All Beverages</div>
            <div class="news-description">
                Enjoy 20% off on all beverages every Monday! Start your week with a refreshing cup at the Cozy Cup.
            </div>
            <button class="learn-more-btn">Get Discount</button>
        </div>

        <!-- New Menu Launch Card -->
        <div class="news-card">
            <img src="./images/news/new_menu.png" alt="New Menu Launch">
            <div class="news-title">Exciting New Menu Launch!</div>
            <div class="news-description">
                We are introducing new beverages. Come and taste our latest offerings.
            </div>
            <button class="learn-more-btn">View Menu</button>
        </div>

        <!-- Community Event Card -->
        <div class="news-card">
            <img src="./images/news/coffee_tasting.png" alt="Community Event">
            <div class="news-title">Community Coffee Tasting Event</div>
            <div class="news-description">
                Join us for a coffee-tasting event next Saturday. Sample a variety of brews and meet fellow coffee lovers.
            </div>
            <button class="learn-more-btn">RSVP Now</button>
        </div>
    </div>
</body>
</html>
