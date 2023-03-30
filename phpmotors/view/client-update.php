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
  <title>Update Information | PHP Motors</title>
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
    <?php
       if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
       }
      ?>
      <h1>Manage Account</h1>
      <h2>Update Account</h2>
      <form name="form" action="/phpmotors/accounts/index.php" method="post">

        <div class="form-box">
          <label for="clientFirstname">First name</label>
          <br>
          <input type="text" name="clientFirstname" id="clientFirstname" autocomplete="name" required <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; } elseif(isset($_SESSION['clientData']['clientFirstname']))  {
      $clientFirstname = $_SESSION['clientData']['clientFirstname'];
      echo "value = '$clientFirstname'";}?>>

        </div>

        <div class="form-box">
          <label for="clientLastname">Last name</label>
          <br>
          <input type="text" name="clientLastname" id="clientLastname" autocomplete="name" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])) {
      $clientLastname = $_SESSION['clientData']['clientLastname'];
      echo "value = '$clientLastname'";}?>>
        </div>

        <div class="form-box">
          <label for="clientEmail">Email</label>
          <br>
          <input type="email" id="clientEmail" name="clientEmail" autocomplete="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])) {
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    echo "value = '$clientEmail'";}?>>
        </div>

        <input class="submitBtn" name="submit" type="submit" value="Update Info">
        <input name="action" type="hidden" value="updateUser">
        <input name="clientId" type="hidden" value="
<?php  
if(isset($_SESSION['clientData']['clientId'])) {echo $_SESSION['clientData']['clientId'];}
 ?>
">

      </form>
      <?php
       if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
       }
      ?>
      <h2>Update Password</h2>
      <form name="form" action="/phpmotors/accounts/index.php" method="post">
        <span class="userNotice">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter
          and 1 special character</span>
        <br>
        <br>
        <span class="userNotice">*note your original password will be changed.</span>
        <div class="form-box">
          <label for="clientPassword">Password</label>
          <br>
          <input type="password" name="clientPassword" id="clientPassword"
            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </div>


        <input class="submitBtn" name="submit" type="submit" value="Update Password">
        <input name="action" type="hidden" value="updatePassword">
        <input name="clientId" type="hidden" value="
<?php  
if(isset($_SESSION['clientData']['clientId'])) {echo $_SESSION['clientData']['clientId'];}
 ?>
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