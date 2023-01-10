<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
  // Clear the message
  $message->clearMessage();

}

$userDAO = new UserDAO($conn, $BASE_URL);

$userData = $userDAO->verifyToken(false);

error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>God Of Games</title>
  <link rel="short icon" href="<?= $BASE_URL ?>img/godofgames_icon.png">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.2/css/bootstrap.css"
    integrity="sha512-+QrNe4Kul4TNKwDK+EJM71C9z5I9I/iYLEIJPYTfmXouMSU8tkayWYnOsAKjDAaOOH21+MS747IPTYcD+2euuQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- CSS -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
</head>

<body>
  <header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
      <a href="<?= $BASE_URL ?>" class="navbar-brand">
        <img src="<?= $BASE_URL ?>img/logo.png" alt="GofOfGames" id="logo">
        <span id="godofgames-title">God Of Games</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
      <form action="<?= $BASE_URL ?>search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
        <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Search Games"
          aria-label="Search">
        <button id="icon-search" class="btn my-2 my-sm-0" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
          <?php if ($userData): ?>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>newgame.php" class="nav-link">
              <i class="far fa-plus-square"></i> Include Games
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard.php" class="nav-link">My Games</a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold">
              <?= $userData->name ?>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Logout</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Login / Register</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>
  <?php if (!empty($flassMessage["msg"])): ?>
  <div class="msg-container">
    <p class="msg <?= $flassMessage["type"] ?>">
      <?= $flassMessage["msg"] ?>
    </p>
  </div>
  <?php endif; ?>