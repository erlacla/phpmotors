<?php
//This is the reviews controller

session_start();
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';


$navList = navBar();

$vclassifications = getVehicleClassifications();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action){

// Add a new review
case 'addnewreview':
    // Filter and store the data
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
    // Check for missing data
  if(empty($reviewText)){
  $message = '<p class="form-box">***Please write a review.</p>';
  include '../view/vehicle-detail.php';
  exit;
  }
  
  // Send the data to the model
  $newreviewOutcome = addNewReview($reviewText, $clientId, $invId);
  
  // Check and report the result
  if($newreviewOutcome === 1){
  $message = "<p class='form-box'>Your review was added successfully!</p>";
  $_SESSION['message'] = $message;
  header("location: /phpmotors/vehicles/?action=details&invId=$invId");
  exit;
  } else {
  $message = "<p class='form-box'>Sorry! The review was not added. Please try again.</p>";
  $_SESSION['message'] = $message;
  include '../view/vehicle-detail.php';
  exit;
  }

  // Store message to session
$_SESSION['message'] = $message;
      
include '../view/vehicle-detail.php';
break;


//Deliver a view to edit a review
case 'edit-review':
  $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
  $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
  $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
  $clientReview = getReview($reviewId);
  $inventory = getInvItemInfo($invId);

    if((!$clientReview)){
     $message = 'Sorry, no review could be found.';
     $_SESSION['message'] = $message;
    }
    include '../view/edit-review.php';
    exit;
   break;

//Handle the review update
case 'updateReview':
  // Filter and store the data
  $updatedReview = trim(filter_input(INPUT_POST, 'updatedReview', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
  if (empty($updatedReview)) {
  $message = '<p>Please write a review.</p>';
  $_SESSION['message'] = $message;
  include '../view/edit-review.php';
  exit;
  }
  $updateResult = updateReview($updatedReview, $reviewId);
  if ($updatedReview) {
    $message = "<p class='notify'>Congratulations, your review was successfully updated!</p>";
    $_SESSION['message'] = $message;
    header('Location: /phpmotors/accounts/?action=admin');
    
    exit;
   }else {
    $message = "<p>Error. Your review was not updated.</p>";
    include '../view/edit-review.php';
    exit;
  }
  break;

//Deliever a view to confirm deletion of a review
case 'delete-review':
   $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
   $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
   $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
   $clientReview = getReview($reviewId);
   $inventory = getInvItemInfo($invId);
 
     if((!$clientReview)){
      $message = 'Sorry, no review could be found.';
      $_SESSION['message'] = $message;
     }
     include '../view/delete-review.php';
     exit;
    break;


//Handel the review deletion
case 'deleteReview':
  $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  
  $deleteResult = deleteReview($reviewId);
  if ($deleteResult) {
    $message = "<p class='notice'>The review was	successfully deleted.</p>";
    $_SESSION['message'] = $message;
    header('Location: /phpmotors/accounts/?action=admin');
    exit;
  } else {
    $message = "<p class='notice'>Error: the review was not
  deleted.</p>";
    $_SESSION['message'] = $message;
    header('Location: /phpmotors/accounts/?action=admin');
    exit;
  }
  break;

//A default the will deliver the "admin" view if the client is logged in or the phpmotors home view if not.
default:
  if(isset($_SESSION)) {
    include '../view/admin.php';
  }
  else {
    include '../view/home.php';
  }
    break;
    




}