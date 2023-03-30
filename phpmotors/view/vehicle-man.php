<?php
// Check if logged in
if (((!$_SESSION['loggedin'])==TRUE) or (($_SESSION['clientData']['clientLevel']) < 2)) {
    header('Location: /phpmotors/');
exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">
    <title>Vehicle Management | PHP Motors</title>
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
            <h1>Vehicle Management</h1>
            <ul>
                <li><a class="form-box" href="/phpmotors/vehicles/index.php?action=add-classification">Add
                        Classification</a></li>

                <li><a class="form-box" href="/phpmotors/vehicles/index.php?action=add-vehicle">Add Vehicle</a></li>
            </ul>

            <?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Vehicles By Classification</h2>'; 
 echo '<p>Choose a classification to see those vehicles</p>'; 
 echo $classificationList; 
}
?>

<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>

<table id="inventoryDisplay"></table>

        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html><?php unset($_SESSION['message']); ?>