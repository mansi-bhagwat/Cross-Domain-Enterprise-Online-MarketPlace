<!DOCTYPE html>
<html lang="en">
<?php include('./head.php'); ?>
    <style>
        /* Style for the "THE COZY CUP" text */
        .center-text {
            font-size: 150px;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        /* Responsive adjustment for smaller screens */
        @media (max-width: 768px) {
            .center-text {
                font-size: 100px;
            }
        }

        @media (max-width: 480px) {
            .center-text {
                font-size: 70px;
            }
        }
    </style>
    <body>
    <?php include('./navbar.php'); ?>

    <!-- Header with image -->
    <header id="home">
        <div class="w3-display-bottomleft w3-padding">
            <span class="w3-tag w3-xlarge">Open from 10am to 6pm</span>
        </div>
        <div class="center-text">
            <b>THE COZY CUP</b>
        </div>
    </header>
    </body>
</html>