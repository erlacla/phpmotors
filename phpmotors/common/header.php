<div id="headerdiv"><a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo"></a>
<?php

if(isset($_SESSION['clientData'])) {
    $welcomeFirstname = $_SESSION['clientData']['clientFirstname'];
 echo "<span id='welcome'>Welcome $welcomeFirstname!</span>";
 
}


if(isset($_SESSION['clientData'])){
    $welcomeFirstname = $_SESSION['clientData']['clientFirstname'];
echo "<a class='myAccountbtn'  href='/phpmotors/accounts/index.php?action=admin'>$welcomeFirstname</a><span id='bar'>|</span><a class='myAccountbtn' href='/phpmotors/accounts/index.php?action=logout'>Log Out</a>";
 
} else {
    echo "<a class='myAccountbtn' href='/phpmotors/accounts/index.php?action=login'>My Account</a>";
}
?>         

</div>