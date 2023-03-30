<?php 

// Check if logged in
if (((!$_SESSION['loggedin'])==TRUE) or (($_SESSION['clientData']['clientLevel']) < 2)) {
    header('Location: /phpmotors/');
    exit;
}


// Build the classifications option list
$vList = '<select name="classificationId" id="classificationId">';
$vList .= "<option>Choose a Car Classification</option>";
foreach ($vclassifications as $vclassification) {
 $vList .= "<option value='$vclassification[classificationId]'";
 if(isset($classificationId)){
  if($vclassification['classificationId'] === $classificationId){
   $vList .= ' selected ';
  }
 } elseif(isset($invInfo['classificationId'])){
 if($vclassification['classificationId'] === $invInfo['classificationId']){
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
  <title>Add Vehicle | PHP Motors</title>
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
      <h1>Add Vehicle</h1>

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
          <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){echo "value='$invMake'";}  ?> >
        </div>

        <div class="form-box">
          <label for="invModel">Model</label>
          <br>
          <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){echo "value='$invModel'";}  ?> >
        </div>

        <div class="form-box">
          <label for="invDescription">Description</label>
          <br>
          <textarea name="invDescription" id="invDescription" required ><?php if(isset($invDescription)){echo $invDescription;}  ?></textarea>
        </div>

        <div class="form-box">
          <label for="invImage">Image Path</label>
          <br>
          <input type="text" name="invImage" id="invImage" required <?php if(isset($invImage)){echo "value='$invImage'";}  ?> >
        </div>

        <div class="form-box">
          <label for="invThumbnail">Thumbnail Path</label>
          <br>
          <input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> >
        </div>

        <div class="form-box">
          <label for="invPrice">Price</label>
          <br>
          <input type="number" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> >
        </div>

        <div class="form-box">
          <label for="invStock"># in Stock</label>
          <br>
          <input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}  ?> >
        </div>

        <div class="form-box">
          <label for="invColor">Color</label>
          <br>
          <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";}  ?> >
        </div>

        <input class="submitBtn" name="submit" type="submit" value="Add Vehicle">
        <input name="action" type="hidden" value="addnewvehicle">
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