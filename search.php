<?php
require_once("templates/header.php");

require_once("dao/GameDAO.php");

// DAO of games
$gameDAO = new GameDAO($conn, $BASE_URL);

// Rescue user search
$q = filter_input(INPUT_GET, "q");

$games = $gameDAO->findByTitle($q);

?>

<div id="main-container" class="container-fluid">
  <h2 class="section-title" id="search-title">Are you searching for: <span id="search-result"> <?= $q ?> </span></h2>
  <p class="section-description">Search results returned based on your search.</p>
  <div class="games-container">
    <?php foreach ($games as $game): ?>
      <?php require("templates/game_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($games) === 0): ?>
      <p class="empty-list">There are no games for this search, <a href="<?= $BASE_URL ?>" class="back-link">back</a>.</p>
    <?php endif; ?>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>