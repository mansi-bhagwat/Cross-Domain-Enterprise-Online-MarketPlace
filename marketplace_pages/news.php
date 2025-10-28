<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News - Marketplace</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      color: #333;
    }
    header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }
    header h1 {
      margin: 0;
      font-size: 2.5rem;
    }
    section#news {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
      background-color: #fff;
    }
    section#news h2 {
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
      letter-spacing: 1px;
    }
    .news-item {
      background-color: #ffffff;
      border-radius: 12px;
      margin: 15px 0;
      padding: 30px;
      width: 70%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: left;
      font-size: 1.1rem;
      border: 1px solid #e0e0e0;
    }
    .news-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .news-item h3 {
      font-size: 1.6rem;
      color: #333;
      margin-bottom: 15px;
      font-weight: bold;
      letter-spacing: 1px;
    }
    .news-item p {
      font-size: 1rem;
      color: #555;
      line-height: 1.6;
      letter-spacing: 0.5px;
    }
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px;
      position: relative;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>
  <!-- Include Header -->
    <div id="header-container"></div>

  <!-- News Section -->
  <section id="news">
    <h2>Latest News</h2>
    <div class="news-item">
      <h3>Exciting New Product Launch at The Cozy Cup</h3>
      <p>The Cozy Cup is launching a brand-new coffee blend this week. Get ready to experience a rich and bold flavor that will kick-start your mornings like never before. Don't miss out on this limited-time offer!</p>
    </div>
    <div class="news-item">
      <h3>Soft Solutions Introduces Groundbreaking Software Update</h3>
      <p>Soft Solutions has rolled out a major update to its software that improves performance, adds new features, and enhances user experience. This update is now available to all users. Read more about it on our product page.</p>
    </div>
    <div class="news-item">
      <h3>Innovatech Solutions Partners with Global Leaders</h3>
      <p>Innovatech Solutions is thrilled to announce a strategic partnership with global leaders in the tech industry. This collaboration will bring innovative, scalable solutions to businesses across the world.</p>
    </div>
    <div class="news-item">
      <h3>Wanderlust Adventures Announces New Luxury Travel Packages</h3>
      <p>Wanderlust Adventures is now offering exclusive luxury travel packages to some of the most sought-after destinations. With premium services and unforgettable experiences, these packages are designed for those who seek the best in travel.</p>
    </div>
  </section>

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
