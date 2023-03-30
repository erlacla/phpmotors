<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="css/small.css">
    <link rel="stylesheet" media="screen" href="css/large.css">
    <title>Home | PHP Motors</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php';?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php';?>
        </nav>
        <main>
            <h1>Welcome to PHP Motors!</h1>
<div id="box-img">
            
            <div id="homefloat">
                <p id="bold">DMC Delorean</p>
                <p>3 Cup holders<br>Superman doors<br>Fuzzy dice!</p>
            </div>
            <img id="deloreanimg" src="images/vehicles/delorean.jpg" alt="Delorean">
            <button id="box-button">Own Today</button>
        </div>
            <div id="section-wrapper">

                <section>
                    <h2>Delorean Upgrades</h2>
                    <div id="boxes">
                        <figure>
                            <div class="imgdivblue"><img src="images/upgrades/flux-cap.png" alt="Flux Capacitor"></div>

                            <figcaption><a href="">Flux Capacitor</a></figcaption>
                        </figure>
                        <figure>
                            <div class="imgdivblue"><img src="images/upgrades/flame.jpg" alt="Flame Decals"></div>

                            <figcaption><a href="">Flame Decals</a></figcaption>
                        </figure>
                        <figure>
                            <div class="imgdivblue"><img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                            </div>

                            <figcaption><a href="">Bumper Stickers</a></figcaption>
                        </figure>
                        <figure>
                            <div class="imgdivblue"><img src="images/upgrades/hub-cap.jpg" alt="Hub Caps"></div>

                            <figcaption><a href="">Hub Caps</a></figcaption>
                        </figure>
                    </div>

                </section>


                <section>
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast it's almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </section>


            </div>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
    </div>
    <script src="js/inventory.js"></script>
</body>

</html>
<?php
        unset($_SESSION['message']);
      ?>