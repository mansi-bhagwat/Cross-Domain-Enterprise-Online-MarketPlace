<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Marketplace</title>
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
    section#about {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
      background-color: #fff;
    }
    section#about h2 {
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
      letter-spacing: 1px;
    }
    .product-description {
      background-color: #ffffff;
      border-radius: 12px;
      margin: 15px 0;
      padding: 30px;
      width: 70%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
      font-size: 1.1rem;
      border: 1px solid #e0e0e0;
    }
    .product-description:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .product-description h3 {
      font-size: 1.6rem;
      color: #333;
      margin-bottom: 15px;
      font-weight: bold;
      letter-spacing: 1px;
    }
    .product-description p {
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

  <!-- About Section -->
  <section id="about">
    <h2>About Our Marketplace</h2>
    <div class="product-description">
      <h3>The Cozy Cup</h3>
      <p>Grab a morning coffee, enjoy a healthy breakfast, or sit down for a cozy lunch or early dinner. At The Cozy Cup, we believe in making your day better with every sip and bite.</p>
    </div>
    <div class="product-description">
      <h3>Soft Solutions</h3>
      <p>Discover innovative solutions for your needs. Soft Solutions is dedicated to delivering reliable and effective technology that fits seamlessly into your lifestyle.</p>
    </div>
    <div class="product-description">
      <h3>Innovatech Solutions</h3>
      <p>Reliable and affordable services you can trust. Innovatech is here to help you streamline your processes and achieve success in the ever-evolving tech world.</p>
    </div>
    <div class="product-description">
      <h3>Wanderlust Adventures</h3>
      <p>Experience premium quality like never before. Wanderlust Adventures brings you the best travel experiences with a touch of luxury and adventure that leaves lasting memories.</p>
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
