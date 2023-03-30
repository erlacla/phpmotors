<?php
//This is the accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the reviews library
require_once '../model/reviews-model.php';


$navList = navBar();

// Check if logged in, get first name
// if(isset($_SESSION['clientData'])){
//   $welcomeFirstname = $_SESSION['clientData']['clientFirstname'];
//  }

//  $welcomeFirstname = $_SESSION['clientData']['clientFirstname'];


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }

switch ($action) {

case 'register':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
    

    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if($existingEmail){
     $message = '<p class="notice">***That email address already exists. Do you want to login instead?</p>';
     include '../view/login.php';
     exit;
    }




// Check for missing data
if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
  $message = '<p>***Please provide information for all empty fields.</p>';
  include '../view/registration.php';
  exit; 
 }

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
if ($regOutcome === 1) {
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
  $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
  header('Location: /phpmotors/accounts/?action=login');
  exit;
 } else {
  $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
  include '../view/registration.php';
  exit;
 }



case 'signin':

    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
if (empty($clientEmail) || empty($checkPassword)) {
  $_SESSION['message'] = '<p>***Please provide information for all empty fields.</p>';
  include '../view/login.php';
  exit; 
  }
    
  // A valid password exists, proceed with the login process
  // Query the client data based on the email address
  $clientData = getClient($clientEmail);
  // Compare the password just submitted against
  // the hashed password for the matching client
  $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
  // If the hashes don't match create an error
  // and return to the login view
  if(!$hashCheck) {
    $_SESSION['message'] = '<p>***Please check your password and try again.</p>';
    include '../view/login.php';
    exit;
  }
  // A valid user exists, log them in
  $_SESSION['loggedin'] = TRUE;
  // Remove the password from the array
  // the array_pop function removes the last
  // element from an array
  array_pop($clientData);
  // Store the array into the session
  $_SESSION['clientData'] = $clientData;
  // $welcomeFirstname = $_SESSION['clientData']['clientFirstname'];
  $clientId = $clientData['clientId'];
  $clientReviews = reviewsByClient($clientId);
  // Build the reviews information into HTML for display
if ($clientReviews) {
  $reviewsDisplay = buildclientreviews($clientReviews);
  
 } else {
  $reviewsDisplay = '<p class="notice">No reviews submitted yet.</p>';
 }
  
 
//   echo '<pre>';
// print_r($clientReviews);
// echo '</pre>';
// die;

// Send them to the admin view
  include '../view/admin.php';
  exit;

  case 'logout':
    unset($_SESSION['clientData']);
    session_destroy();
    header('Location: /phpmotors/index.php');

  case 'admin':
    if(isset($_SESSION['clientData'])){
      $clientReviews = reviewsByClient($_SESSION['clientData']['clientId']);
  // Build the reviews information into HTML for display
    if ($clientReviews) {
      $reviewsDisplay = buildclientreviews($clientReviews);
  
  } else {
      $reviewsDisplay = '<p class="notice">No reviews submitted yet.</p>';
 }
      include '../view/admin.php';
    }
    break;

    

  case 'update-info':
      if(isset($_SESSION['clientData'])){
        include '../view/client-update.php';
      }
       break;




  case 'updateUser':
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
      
      // Check for existing email address in the table
      $existingEmail = checkExistingEmail($clientEmail);
      if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
        if($existingEmail){
          $message = '<p class="notice">***That email address already exists.</p>';
          $_SESSION['message'] = $message;
          include '../view/client-update.php';}
        
        exit;
      }
      
        //Check for missing data
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $_SESSION['message'] = '<p>***Please complete all information for the updated item!</p>';
      include '../view/client-update.php';
      exit;
      }

    
      //Send results to the model
      $updatedUserInfo = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
      if ($updatedUserInfo) {
        $clientDataUpdated = getClientById($clientId);
        array_pop($clientDataUpdated);
        $_SESSION['clientData'] = $clientDataUpdated;
        $message = "<p class='notify'>$clientFirstname, your information was successfully updated!</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/accounts/');
        exit;
        }else {
        $message = "<p>Sorry $clientFirstname, we could not update your account information. Please try again later.</p>";
        include '../view/client-update.php';
        exit;
      }
      break;

  
  case 'updatePassword':
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    
    $checkPassword = checkPassword($clientPassword);
    if(!$checkPassword) {
      $_SESSION['message'] = '<p>***Please check your password matches required pattern and try again.</p>';
      include '../view/client-update.php';
      exit;
    }
    //Send results to the model
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    $updatePassword = updatePassword($hashedPassword, $clientId);
    if ($updatePassword) {
      $_SESSION['clientData']['clientPassword'] = $updatePassword;
      $message = "<p class='notify'>$clientFirstname, your password was successfully updated!</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/');
      exit;
      }else {
      $message = "<p>Sorry $clientFirstname, we could not update your password. Please try again later.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;
    

  case 'login':
    include '../view/login.php';
    break;

   case 'registration':
    include '../view/registration.php';
    break;

  default:
    include '../view/admin.php';
    break;
    }

    ?>
