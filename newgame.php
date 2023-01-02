<?php
require_once("templates/header.php");

// Check if the user is authenticated
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDAO = new UserDAO($conn, $BASE_URL);

$userData = $userDAO->verifyToken(true);

?>

<div id="main-container" class="container-fluid">
  <div class="offset-md-4 col-md-4 new-game-container">
    <h1 class="page-title">Add Game</h1>
    <p class="page-description">Add your review and share!</p>
    <form action="<?= $BASE_URL ?>game_process.php" id="add-game-form" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="create">
      <div class="form-group mb-2">
        <label class="mb-2" for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Type the title of your game">
      </div>
      <div class="form-group mb-2">
        <label class="mb-2" for="image">Image:</label>
        <input type="file" class="form-control-file" name="image" id="image">
      </div>
      <div class="form-group mb-2">
        <label class="mb-2" for="length">Length:</label>
        <input type="text" class="form-control" id="length" name="length" placeholder="Type the length of your game">
      </div>
      <div class="form-group mb-2">
        <label class="mb-2" for="Category">Category:</label>
        <select name="category" id="category" class="form-control mb-1">
          <option value="">Select</option>
          <option value="Action">Action</option>
          <option value="RPG">RPG</option>
          <option value="Horror">Horror</option>
          <option value="Adventure">Adventure</option>
          <option value="Race">Race</option>
          <option value="Fight">Fight</option>
          <option value="Puzzle">Puzzle</option>
          <option value="Survival">Survival</option>
          <option value="FPS">FPS</option>
          <option value="Simulation">Simulation</option>
          <option value="Sports">Sports</option>
          <option value="Strategy">Strategy</option>
          <option value="Party Games">Party Games</option>
        </select>
      </div>
      <div class="form-group mb-2">
        <label class="mb-2" for="trailer">Trailer:</label>
        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insert the trailer link">
      </div>
      <div class="form-group">
        <label class="mb-2" for="description">Description:</label>
        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Describe the game..."></textarea>
      </div>
      <input type="submit" class="btn card-btn" value="Add Game">
    </form>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>