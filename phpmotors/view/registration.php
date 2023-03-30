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
  <title>Account Registration | PHP Motors</title>
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
      <h1>Register</h1>

      <?php
        if (isset($message)) {
        echo $message;
        }
      ?>

        <form name="form" id="registration" action="/phpmotors/accounts/index.php" method="post">

          <div class="form-box">
            <label for="clientFirstname">First name</label>
            <br>
            <input type="text" name="clientFirstname" id="fname"
              autocomplete="name" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> >
          </div>

          <div class="form-box">
            <label for="clientLastname">Last name</label>
            <br>
            <input type="text" name="clientLastname" id="lname"
              autocomplete="name" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> >
          </div>

          <div class="form-box">
            <label for="clientEmail">Email</label>
            <br>
            <input type="email" id="email" name="clientEmail" placeholder="email@example.com" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> >
          </div>

            <span class="userNotice">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
          <div class="form-box">
            <label for="clientPassword">Password</label>
            <br>
            <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
          </div>


          <input class="submitBtn" name="submit" type="submit" value="Register">
          <input name="action" type="hidden" value="register">
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