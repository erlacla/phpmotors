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
    <title><?php if(isset($vDetails)){ 
	 echo "$vDetails[invModel]";}?> | PHP Motors</title>
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

            <h1><?php if(isset($vDetails)){ 
	 echo "$vDetails[invModel]";}?></h1>



            <?php
        if (isset($message)) {
        echo $message;
        }
      ?>
            <div id="detailReverse">
                <div><?php if(isset($detailsDisplay)){
                    echo $detailsDisplay;
                    } ?></div>

                <div><?php if(isset($thumbnailDisplay)){
        echo $thumbnailDisplay;
        } ?></div>
            </div>
            <hr>
            <h2>Customer Reviews</h2>
            

            <h3><?php if(isset($vDetails)){ 
	 echo "Review the $vDetails[invModel]";}?></h3>



            <?php  

if (!$_SESSION) {
    echo "<p>You can add a review for the $vDetails[invModel] after logging in.</p>";
    echo "<a class='form-box' href='/phpmotors/accounts/index.php?action=login'>Login here</a>";
    
   } 
   else {
    echo "<form class='form' name='form' action='/phpmotors/reviews/index.php' method='post'>";

    if(isset($_SESSION['clientData'])) {
        $fname = $_SESSION['clientData']['clientFirstname'];
        $letter = $fname[0];
        $lname = $_SESSION['clientData']['clientLastname'];
        $clientId = $_SESSION['clientData']['clientId'];
        $invId = $vDetails['invId'];
     
    
    echo "<label>Screen Name:<br><input type='text' value='$letter$lname' readonly></label>";
    echo "<br>";
    echo "<label>Review:<br><textarea required name='reviewText'></textarea></label>";
    echo "<br>";
    echo "<input class='submitBtn' name='submit' type='submit' value='Submit Review'>";
    echo "<input name='action' type='hidden' value='addnewreview'>";
    echo "<input name='clientId' type='hidden' value='$clientId'>";
    echo "<input name='invId' type='hidden' value='$invId'>";
    echo "</form>";
   }}
?>


            <?php if(count($reviews) < 1){
                    echo "<p class='notice'>Be the first to write a review.</p>";
                    } 
                    else {
                        echo $reviewsDisplay;
                    }?>


        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>
