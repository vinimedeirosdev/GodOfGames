<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/GameDAO.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);
$gameDAO = new GameDAO($conn, $BASE_URL);

// Redeem the form type
$type = filter_input(INPUT_POST, "type");

// Rescue user's data
$userData = $userDAO->verifyToken();

if ($type === "create") {

  // Git the inputs data
  $title = filter_input(INPUT_POST, "title");
  $description = filter_input(INPUT_POST, "description");
  $trailer = filter_input(INPUT_POST, "trailer");
  $category = filter_input(INPUT_POST, "category");
  $length = filter_input(INPUT_POST, "length");

  $game = new Game();

  // Minimum validation of data
  if(!empty($title) && !empty($description) && !empty($category)) {

    $game->title = $title;
    $game->description = $description;
    $game->trailer = $trailer;
    $game->category = $category;
    $game->length = $length;
    $game->users_id = $userData->id;

    // Upload of game image
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

      $image = $_FILES["image"];
      $imageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/bmp'];
  
      $ext = strtolower(substr($image["name"], -4));
  
      // Check type of image
      if (in_array($image["type"], $imageTypes)) {
  
        if ($ext == ".jpg") {
  
          $imageFile = imagecreatefromjpeg($image["tmp_name"]);
  
        } else if ($ext == ".png") {
  
          $imageFile = imagecreatefrompng($image["tmp_name"]);
  
        } else {
  
          $message->setMessage("Type invalid of image.", "error", "back");
  
        }
  
        $imageName = $game->imageGenerateName($ext);
  
        imagejpeg($imageFile, "./img/games/" . $imageName, 100);
  
        $game->image = $imageName;
  
      }
  
    }

    $gameDAO->create($game);

  } else {

    $message->setMessage("You need at least add: title, description and category!", "error", "back");

  }

} else if($type === "delete") {

  // Receive form data
  $id = filter_input(INPUT_POST, "id");

  $game = $gameDAO->findById($id);

  if($game) {

    // Check if the game belongs to the user
    if($game->users_id === $userData->id) {

      $gameDAO->destroy($game->id);

    } else {

      $message->setMessage("Invalid informations.", "error", "index.php");
  
    }

  } else {

    $message->setMessage("Invalid informations.", "error", "index.php");

  }

} else {

  $message->setMessage("Invalid informations.", "error", "index.php");

}