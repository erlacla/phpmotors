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
  <title>Account Login | PHP Motors</title>
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
      <h1>Sign in</h1>

      <?php
       if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
       }
      ?>

      <form method="post" action="/phpmotors/accounts/">
        <div class="form-box">
          <label for="clientEmail">Email</label>
          <br>
          <input type="email" id="email" name="clientEmail" required
            <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
        </div>

        <span class="userNotice">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special
          character</span>
        <div class="form-box">
          <label for="clientPassword">Password</label>
          <br>
          <input type="password" id="password" name="clientPassword"
            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </div>

        <input class="submitBtn" name="submit" type="submit" value="Sign In">
        <input type="hidden" name="action" value="signin">
        <br>
      </form>
      <a class="form-box" id="member-link" href="/phpmotors/accounts/index.php?action=registration">Not a member
        yet?</a>
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