<?php
// Check if logged in
if (!$_SESSION['loggedin']) {
    header('Location: /phpmotors/');
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">
    <title>Client Admin | PHP Motors</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
        </nav>
        <main>
            <h1><?php echo $_SESSION['clientData']['clientFirstname']; echo " "; echo $_SESSION['clientData']['clientLastname'];  ?>
            </h1>
            <p>You are logged in.</p>
            <?php
       if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
       }
      ?>
            <ul id="adminList">
                <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            </ul>
            
            <h2>Account Management</h2>
            <p>Use this <a class='link-button' href="/phpmotors/accounts/index.php?action=update-info">link</a> to update account information.</p>
            

            <?php  

            if(($_SESSION['clientData']['clientLevel']) > 1){
                echo "<h2>Inventory Management</h2>";
                echo "<p>Use this <a class='link-button' href='/phpmotors/vehicles/index.php'>link</a> to manage the inventory.</p>";
               } 
            ?>

            <h2>Manage Your Product Reviews</h2>
            <?php  
            if (isset($reviewsDisplay)) {
                echo $reviewsDisplay;
               } ?>
            

        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>


<?php
        unset($_SESSION['message']);
      ?>