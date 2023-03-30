<?php

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
    <title>Image Management | PHP Motors</title>
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
            <h1>Image Management</h1>
            <p>Welcome to the image management page! <br>Please choose one of the options presented below.</p>

            <h2>Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem" class="form-box">Vehicle</label>
 <br>
	<?php echo $prodSelect; ?>
	<fieldset class="radioSelect">
		<label>Is this the main image for the vehicle?</label>
        <br>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
    <br>
 <label class="form-box">Upload Image:</label>
 <input type="file" name="file1">
 <br>
 <br>
 <input type="submit" class="submitBtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>

<hr>

<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>


        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>

<?php unset($_SESSION['message']); ?>