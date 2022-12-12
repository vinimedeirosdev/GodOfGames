<?php
require_once("templates/header.php");

require_once("dao/GameDAO.php");

// DAO of games
$gameDAO = new GameDAO($conn, $BASE_URL);

$latestGames = $gameDAO->getLatestGames();

$actionGames = $gameDAO->getGamesByCategory("action");

$horrorGames = $gameDAO->getGamesByCategory("horror");

?>

<div id="main-container" class="container-fluid">
  <h2 class="section-title">New Games</h2>
  <p class="section-description">See reviews of the latest games added on GodOfGames!</p>
  <div class="games-container">
    <?php foreach ($latestGames as $game): ?>
      <?php require("templates/game_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($latestGames) === 0): ?>
      <p class="empty-list">There are no registered games yet!</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Action</h2>
  <p class="section-description">See the best action games.</p>
  <div class="games-container">
    <?php foreach ($actionGames as $game): ?>
      <?php require("templates/game_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($actionGames) === 0): ?>
      <p class="empty-list">There are no registered action games yet!</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Horror</h2>
  <p class="section-description">See the best horror games.</p>
  <div class="games-container">
    <?php foreach ($horrorGames as $game): ?>
      <?php require("templates/game_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($horrorGames) === 0): ?>
      <p class="empty-list">There are no registered horror games yet!</p>
    <?php endif; ?>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>