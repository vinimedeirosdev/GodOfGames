<?php
require_once("templates/header.php");

// Check if the user is authenticated
require_once("models/Game.php");
require_once("dao/GameDAO.php");

// Take the game id
$id = filter_input(INPUT_GET, "id");

$game;

$gameDao = new GameDAO($conn, $BASE_URL);

if (empty($id)) {

    $message->setMessage("The game was not found.", "error", "index.php");
} else {

    $game = $gameDao->findById($id);

    // Check if the game exists
    if (!$game) {

        $message->setMessage("The game was not found.", "error", "index.php");
    }
}

// Check if the game is user
$userOwnsGame = false;

if (!empty($userDAO)) {

    if ($userData->id === $game->users_id) {
        $userOwnsGame = true;
    }
}

