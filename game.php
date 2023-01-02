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

// Check if the game have image
if ($game->image == "") {
    $game->image = "game_cover.jpg";
}


// Check if the game is user
$userOwnsGame = false;

if (!empty($userDAO)) {

    if ($userData->id === $game->users_id) {
        $userOwnsGame = true;
    }
}

// Rescue the game reviews
$alreadyReviewed = false;

?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 game-container">
            <h1 class="page-title"><?= $game->title ?></h1>
            <p class="game-details">
                <span>Length: <?= $game->length ?></span>
                <span class="pipe"></span>
                <span><?= $game->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i>9
            </p>
            <iframe src="<?= $game->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope;picture-in-picture" allowfullscreen></iframe>
            <p><?= $game->description ?></p>
        </div>
        <div class="col-md-4">
            <div class="game-image-container" style="background-image: url('<?= $BASE_URL ?>/img/games/<?= $game->image ?>')"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Reviews:</h3>
            <!-- Checks whether to activate the review for the user or not -->
            <?php if(!empty($userData) && !$userOwnsGame && !$alreadyReviewed): ?>
            <div class="col-md-12" id="review-form-container">
                <h4>Send your review:</h4>
                <p class="page-description">Fill in the form with a note and comment about the game.</p>
                <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="games_id" value="<?= $game->id ?>">
                    <div class="form-group">
                        <label for="rating">Game rating:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Select</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Your comment:</label>
                        <textarea name="review" id="review" rows="3" class="form-control" placeholder="What did you think of the game?"></textarea>
                    </div>
                    <input type="submit" class="btn card-btn mt-2" value="Send Comment">
                </form>
            </div>
            <?php endif; ?>
            <!-- Comments -->
            <div class="col-md-12 review">
                <div class="row">
                    <div class="col-md-1">
                        <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>img/users/user.png')"></div>
                    </div>
                    <div class="col-md-9 author-details-container">
                        <h4 class="author-name">
                            <a href="#">Vini Teste</a>
                        </h4>
                        <p><i class="fas fa-star"></i>9</p>
                        <div class="col-md-12">
                            <p class="comment-title">Comment:</p>
                            <p>This is the user comment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>