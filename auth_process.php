<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDAO = new UserDAO($conn, $BASE_URL);

//Redeem the form type
$type = filter_input(INPUT_POST, "type");

echo $type;

// Form type check
if ($type === "register") {

  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $password = filter_input(INPUT_POST, "password");
  $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

  // Minimum data verification
  if ($name && $lastname && $email && $password) {

    // Check that the passwords match
    if ($password === $confirmpassword) {

      // Check if the email is already registered in the system
      if ($userDAO->findByEmail($email) === false) {

        $user = new User();

        // Token and password creation
        $userToken = $user->generateToken();
        $finalPassword = $user->generatePassword($password);

        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->password = $finalPassword;
        $user->token = $userToken;

        $auth = true;

        $userDAO->create($user, $auth);

      } else {

        // Send a missing data text message if the user already exists
        $message->setMessage("User already registered, try another email.", "error", "back");

      }

    } else {

      // Text message if passwords do not match
      $message->setMessage("Passwords are not the same.", "error", "back");

    }

  } else {

    // Send a missing data text message
    $message->setMessage("Please fill in all fields.", "error", "back");

  }


} else if ($type === "login") {

  $email = filter_input(INPUT_POST, "email");
  $password = filter_input(INPUT_POST, "password");

  // Try auth user
  if($userDAO->authenticateUser($email, $password)) {

    $message->setMessage("Welcome!", "success", "editprofile.php");

    // Redirect the user if unable to auth
  } else {

    $message->setMessage("Incorrect username or password.", "error", "back");

  }

} else {

  $message->setMessage("Invalid informations.", "error", "index.php");

}