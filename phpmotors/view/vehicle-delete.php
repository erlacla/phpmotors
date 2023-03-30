<?php 

// Check if logged in
if (((!$_SESSION['loggedin'])==TRUE) or (($_SESSION['clientData']['clientLevel']) < 2)) {
    header('Location: /phpmotors/');
    exit;
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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) 
{ 
	echo "Modify$invMake $invModel"; }?></h1>

            <?php
        if (isset($message)) {
        echo $message;
        }
      ?>
<p class="notice">Confirm Vehicle Deletion. The delete is permanent.</p>
            <form name="form" action="/phpmotors/vehicles/index.php" method="post">

                <div class="form-box">
                    <label for="invMake">Make</label>
                    <br>
                    <input type="text" name="invMake" id="invMake" readonly
                        <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                </div>

                <div class="form-box">
                    <label for="invModel">Model</label>
                    <br>
                    <input type="text" name="invModel" id="invModel" readonly
                        <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                </div>

                <div class="form-box">
                    <label for="invDescription">Description</label>
                    <br>
                    <textarea name="invDescription" id="invDescription" readonly
                        ><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                </div>

                

                <input class="submitBtn" name="submit" type="submit" value="Delete Vehicle">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
echo $invInfo['invId'];} ?>">
            </form>

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