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

// Getting form type
$type = filter_input(INPUT_POST, "type");

// Rescue user's data
$userData = $userDAO->verifyToken();

if($type === "create") {



};