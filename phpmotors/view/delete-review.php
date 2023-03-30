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
    <title>Delete Your Review | PHP Motors</title>
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
            <h1>Delete Your Review</h1>
            <p class="underline"><?php if(isset($inventory)){ 

echo "$inventory[invMake] $inventory[invModel] review";

}

?></p>



<p><?php if(isset($clientReview)){ 
$time = strtotime($clientReview['reviewDate']);
$dateFormatted = (date("d F, Y",$time));
echo "Reviewed on $dateFormatted";
}

?></p>

        <?php
    if (isset($message)) {
    echo $message;
    }
  ?>
<p class="notice">Confirm Vehicle Deletion. The delete is permanent.</p>
        <form name="form" id="deleteReview" action="/phpmotors/reviews/index.php" method="post">


            <div class="form-box">
                <label for="deleteReview">Review Text</label>
                <br>
                <textarea name="deleteReview" id="deleteReview" readonly
                    required><?php if(isset($reviewText)){ echo $reviewText; } elseif(isset($clientReview['reviewText'])) {echo $clientReview['reviewText']; }?></textarea>
            </div>



            <input class="submitBtn" name="submit" type="submit" value="Delete Review">
            <input type="hidden" name="action" value="deleteReview">
            <input type="hidden" name="reviewId" value="
                <?php if(isset($clientReview['reviewId'])){ echo $clientReview['reviewId'];} 
                elseif(isset($clientReview)){ echo $clientReview; } ?>">
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