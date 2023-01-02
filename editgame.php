<?php
require_once("templates/header.php");

// Check if the user is authenticated
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/GameDAO.php");

$user = new User();
$userDAO = new UserDAO($conn, $BASE_URL);

$userData = $userDAO->verifyToken(true);

$gameDAO = new GameDAO($conn, $BASE_URL);

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {

    $message->setMessage("The game was not found.", "error", "index.php");
} else {

    $game = $gameDAO->findById($id);

    // Check if the game exists
    if (!$game) {

        $message->setMessage("The game was not found.", "error", "index.php");
    }
}

// Check if the game have image
if ($game->image == "") {
    $game->image = "game_cover.jpg";
}

?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $game->title ?></h1>
                <p class="page-description">Change the game data in the form below:</p>
                <form id="edit-game-form" action="<?= $BASE_URL ?>game_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $game->id ?>">
                    <div class="form-group mb-2">
                        <label class="mb-2" for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Type the title of your game" value="<?= $game->title ?> ">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-2" for="image">Image:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-2" for="length">Length:</label>
                        <input type="text" class="form-control" id="length" name="length" placeholder="Type the length of your game" value="<?= $game->length ?>">
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
                        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insert the trailer link" value="<?= $game->trailer ?>">
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="description">Description:</label>
                        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Describe the game..."><?= $game->description ?></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Add Game">

                </form>
            </div>
            <div class="col-md-3">
                <div class="game-image-container" style="background-image: url('<?= $BASE_URL ?>img/games/<?= $game->image ?>')"></div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>