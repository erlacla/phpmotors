<?php
// Check if logged in
if (((!$_SESSION['loggedin'])==TRUE) or (($_SESSION['clientData']['clientLevel']) < 2)) {
    header('Location: /phpmotors/');
    exit;
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
    <title>Add Classification | PHP Motors</title>
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
            <h1>Add Car Classification</h1>

            <?php
        if (isset($message)) {
        echo $message;
        }
      ?>
            <form name="form" action="/phpmotors/vehicles/index.php" method="post">
            <span class="userNotice">Please limit to 30 characters.</span>
                <div class="form-box">
                    <label for="classificationName">Classification Name</label>
                    <br>
                    <input type="text" name="classificationName" id="classificationName" maxlength="30" required>
                </div>
                <div>
                    <input class="submitBtn" name="submit" type="submit" value="Add Classification">
                    <input name="action" type="hidden" value="newclassification">
                </div>
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