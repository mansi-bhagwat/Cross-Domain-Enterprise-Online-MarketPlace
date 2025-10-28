<!DOCTYPE html>
<html lang="en">
    <?php
        include('head.php');
    ?>
    <style>
    .opening-hours {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    .day, .time {
        width: 50%;
    }
    </style>
<body>
    <?php
        include('navbar.php');
    ?>
    <!-- About Container -->
    <div class="w3-container w3-padding-64 w3-teal w3-xlarge w3-text-white w3-cursive" id="about">
        <div class="w3-content">
            <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">About Us</h1>
            <p>The Cozy Cup was founded by Mansi Bhagwat in October 2024.<br><br>
            At Cozy Cup, we believe that every day should start with comfort, warmth, and great food. 
            Whether you're here to grab a morning coffee, enjoy a healthy breakfast, or sit down for a cozy lunch or early dinner, we’ve created a space that feels like home. 
            Our café is designed for you to unwind, with plenty of greenery, soft lighting, and a peaceful ambiance that invites relaxation.
            Our menu is thoughtfully curated with fresh, nutritious ingredients, offering a wide variety of options from energizing breakfasts to satisfying meals for any time of the day. 
            Whether you’re catching up with friends, working remotely, or simply taking a moment for yourself, Cozy Cup is your perfect spot to sip, savor, and stay a while.
            <br><br>Come join us and make your day a little brighter with a touch of coziness and good food!
            </p>
            <p><strong>The Chef?</strong> Mansi<img src="/images/background/chef.jpeg" style="width:150px"
                    class="w3-circle w3-right" alt="Chef"></p>
            <p>Here is a quick look into our dining area :-)</p>
            <img src="/images/background/background_2.png" style="width:100%" class="w3-margin-top w3-margin-bottom"
                alt="Restaurant">
            <h1><b>Location:</b> 2301 Stevens Creek Blvd, San Jose, CA, 95128 </h1>
            <h1><b>Opening Hours</b></h1>

            <div class="w3-row">
                <div class="w3-col s6">
                    <div class="opening-hours">
                        <span class="day">Monday</span>
                        <span class="time">10:00 AM - 06:00 PM</span>
                    </div>
                    <div class="opening-hours">
                        <span class="day">Tuesday</span>
                        <span class="time">10:00 AM - 06:00 PM</span>
                    </div>
                    <div class="opening-hours">
                        <span class="day">Wednesday</span>
                        <span class="time">CLOSED</span>
                    </div>
                    <div class="opening-hours">
                        <span class="day">Thursday</span>
                        <span class="time">10:00 AM - 06:00 PM</span>
                    </div>
                </div>

                <div class="w3-col s6">
                    <div class="opening-hours">
                        <span class="day">Friday</span>
                        <span class="time">10:00 AM - 06:00 PM</span>
                    </div>
                    <div class="opening-hours">
                        <span class="day">Saturday</span>
                        <span class="time">10:00 AM - 06:00 PM</span>
                    </div>
                    <div class="opening-hours">
                        <span class="day">Sunday</span>
                        <span class="time">10:00 AM - 06:00 PM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>