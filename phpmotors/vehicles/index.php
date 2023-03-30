<?php
//This is the vehicles controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicles model 
require_once '../model/vehicles-model.php';

// Get the uploads model 
require_once '../model/uploads-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the reviews library
require_once '../model/reviews-model.php';

$navList = navBar();

// Check if logged in, get first name
if(isset($_SESSION['clientData'])){
  $welcomeFirstname = $_SESSION['clientData']['clientFirstname'];
 }

$vclassifications = getVehicleClassifications();


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }



 switch ($action){

  case 'newclassification':
    // Filter and store the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Check for missing data
if(empty($classificationName)){
  $message = '<p class="form-box">***Please enter a new car classification.</p>';
  include '../view/add-classification.php';
  exit; 
 }

 // Send the data to the model
$addClassOutcome = addNewClass($classificationName);

// Check and report the result
if($addClassOutcome === 1){
  header('Location: /phpmotors/vehicles/index.php');
  exit;
 } else {
  $message = "<p class='form-box'>Sorry! The new classification was not added. Please try again.</p>";
  include '../view/add-classification.php';
  exit;
 }


 case 'addnewvehicle':
  // Filter and store the data
  $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_ALLOW_FRACTION));
  $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  

  // Check for missing data
if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription)  || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
$message = '<p class="form-box">***Please provide information for all empty fields.</p>';
include '../view/add-vehicle.php';
exit; 
}

// Send the data to the model
$newVehicleOutcome = addNewVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

// Check and report the result
if($newVehicleOutcome === 1){
$message = "<p class='form-box'>The $invMake $invModel was added successfully!</p>";
include '../view/add-vehicle.php';
exit;
} else {
$message = "<p class='form-box'>Sorry! The vehicle was not added. Please try again.</p>";
include '../view/add-vehicle.php';
exit;
}





    case 'add-classification':
        include '../view/add-classification.php';
        break;
    
       case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;
    
/* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */ 

case 'getInventoryItems': 
  // Get the classificationId 
  $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
  // Fetch the vehicles by classificationId from the DB 
  $inventoryArray = getInventoryByClassification($classificationId);
  // Convert the array to a JSON object and send it back 
  echo json_encode($inventoryArray); 
  break;

  case 'mod':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo)<1){
     $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
   break;

   case 'updateVehicle':
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    
    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
    $message = '<p>Please complete all information for the updated item! Double check the classification of the item.</p>';
    include '../view/vehicle-update.php';
    exit;
    }
    $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
    if ($updateResult) {
      $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated!</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
     }else {
      $message = "<p>Error. The vehicle was not updated.</p>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;

    case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
          $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

        case 'deleteVehicle':
          $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
          
          $deleteResult = deleteVehicle($invId);
          if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
          deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          }
          break;


          case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)){
             $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
            } else {
             $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            include '../view/classification.php';
            break;


          case 'details':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $thumbnails = thumbnailImage($invId);
            $vDetails = getInvItemInfo($invId);
            $reviews = reviewsForInventoryItem($invId);
            if(!isset($vDetails)){
              $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
            } else {
              $thumbnailDisplay = thumbnailOnLeft($thumbnails);
              $detailsDisplay = buildDetailsDisplay($vDetails);
              $reviewsDisplay = buildReviewsDisplay($reviews);
            }
            include '../view/vehicle-detail.php';
            break;



      default:
      $classificationList = buildClassificationList($vclassifications);
      include '../view/vehicle-man.php';
      break;
}

?>