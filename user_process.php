<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDAO = new UserDAO($conn, $BASE_URL);

// Redeem the form type
$type = filter_input(INPUT_POST, "type");

// Update user
if ($type === "update") {

  // Rescue user's data
  $userData = $userDAO->verifyToken();

  // Get post data
  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $bio = filter_input(INPUT_POST, "bio");

  // Create a new object of user
  $user = new User();

  // Fill in user's data
  $userData->name = $name;
  $userData->lastname = $lastname;
  $userData->email = $email;
  $userData->bio = $bio;

  //Update Image
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

      $imageName = $user->imageGenerateName($ext);

      imagejpeg($imageFile, "./img/users/" . $imageName, 100);

      $userData->image = $imageName;

    }

  }


  $userDAO->update($userData);

  // Update user's password
} else if ($type === "changepassword") {

  // Get post data
  $password = filter_input(INPUT_POST, "password");
  $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

  // Rescue user's data
  $userData = $userDAO->verifyToken();
  
  $id = $userData->id;

  if ($password == $confirmpassword) {

    // Create a new object of user
    $user = new User();

    $finalPassword = $user->generatePassword($password);

    $user->password = $finalPassword;
    $user->id = $id;

    $userDAO->changePassword($user);

  } else {

    $message->setMessage("Passwords are not the same.", "error", "back");

  }

} else {

  $message->setMessage("Invalid informations.", "error", "index.php");

}