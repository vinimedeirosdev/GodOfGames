<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Review.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/GameDAO.php");
require_once("dao/ReviewDAO.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);
$gameDAO = new GameDAO($conn, $BASE_URL);
$reviewDAO = new ReviewDAO($conn, $BASE_URL);

// Getting form type
$type = filter_input(INPUT_POST, "type");

// Rescue user's data
$userData = $userDAO->verifyToken();

if($type === "create") {

    // Getting post data
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $games_id = filter_input(INPUT_POST, "games_id");
    $users_id = $userData->id;

    $reviewObject = new Review();

    $gameData = $gameDAO->findById($games_id);

    // Validating if the game exists
    if($gameData) {

        // Checked minimum data
        if(!empty($rating) && !empty($review) && !empty($games_id)) {

            $reviewObject->rating = $rating;
            $reviewObject->review = $review;
            $reviewObject->games_id = $games_id;
            $reviewObject->users_id = $users_id;

            $reviewDAO->create($reviewObject);

        } else {

            $message->setMessage("You need insert the rating and comment.", "error", "back");

        }

    } else {

        $message->setMessage("Invalid informations.", "error", "index.php");

    }

} else {

    $message->setMessage("Invalid informations.", "error", "index.php");

}