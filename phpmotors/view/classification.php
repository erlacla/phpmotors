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
    <title><?php echo $classificationName; ?> Vehicles | PHP Motors, Inc.</title>
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
        <h1><?php echo $classificationName; ?> Vehicles</h1>

        <?php if(isset($message)){
        echo $message; }
        ?>

        <?php if(isset($vehicleDisplay)){
        echo $vehicleDisplay;
        } ?>

        
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>
<?php
        unset($_SESSION['message']);
      ?>