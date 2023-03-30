<?php 

// Check if logged in
if (((!$_SESSION['loggedin'])==TRUE) or (($_SESSION['clientData']['clientLevel']) < 2)) {
    header('Location: /phpmotors/');
    exit;
}


// Build a dropdown using the $vclassifications array
$vList = '<select id="classificationId" name="classificationId">';
$vList .= "<option value=''>Choose Car Classification</option>";
foreach ($vclassifications as $vclassification) {
 $vList .= "<option value='$vclassification[classificationId]'";
 if(isset($classificationId)){
  if($vclassification['classificationId'] == $classificationId){
      $vList .= ' selected ';
  }
 }
 
 $vList .= ">$vclassification[classificationName]</option>";
}
$vList .= '</select>';
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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
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
	echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) 
{ 
	echo "Modify$invMake $invModel"; }?></h1>

            <p>*Note all Fields are Required</p>

            <?php
        if (isset($message)) {
        echo $message;
        }
      ?>

            <form name="form" id="addnewvehicle" action="/phpmotors/vehicles/index.php" method="post">
                <div class="form-box">
                    <label for="classificationId">Car Classification</label>
                    <br>
                    <?php
        echo $vList;
      ?>
                </div>

                <div class="form-box">
                    <label for="invMake">Make</label>
                    <br>
                    <input type="text" name="invMake" id="invMake" required
                        <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                </div>

                <div class="form-box">
                    <label for="invModel">Model</label>
                    <br>
                    <input type="text" name="invModel" id="invModel" required
                        <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                </div>

                <div class="form-box">
                    <label for="invDescription">Description</label>
                    <br>
                    <textarea name="invDescription" id="invDescription"
                        required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                </div>

                <div class="form-box">
                    <label for="invImage">Image Path</label>
                    <br>
                    <input type="text" name="invImage" id="invImage" required
                        <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>>
                </div>

                <div class="form-box">
                    <label for="invThumbnail">Thumbnail Path</label>
                    <br>
                    <input type="text" name="invThumbnail" id="invThumbnail" required
                        <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?>>
                </div>

                <div class="form-box">
                    <label for="invPrice">Price</label>
                    <br>
                    <input type="number" name="invPrice" id="invPrice" required
                        <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>>
                </div>

                <div class="form-box">
                    <label for="invStock"># in Stock</label>
                    <br>
                    <input type="number" name="invStock" id="invStock" required
                        <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?>>
                </div>

                <div class="form-box">
                    <label for="invColor">Color</label>
                    <br>
                    <input type="text" name="invColor" id="invColor" required
                        <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>>
                </div>

                <input class="submitBtn" name="submit" type="submit" value="Update Vehicle">
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
elseif(isset($invId)){ echo $invId; } ?>
">
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