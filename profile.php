<?php
require_once("templates/header.php");

// Check if the user is authenticated
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/GameDAO.php");

$user = new User();
$userDAO = new UserDAO($conn, $BASE_URL);
$gameDAO = new GameDAO($conn, $BASE_URL);

// Taked user id
$id = filter_input(INPUT_GET, "id");

if (empty($id)) {

    if (!empty($userData)) {

        $id = $userData->id;
    } else {

        $message->setMessage("The user was not found.", "error", "index.php");
    }
} else {

    $userData = $userDAO->findById($id);

    // If not find user
    if (!$userData) {

        $message->setMessage("The user was not found.", "error", "index.php");
    }
}

$fullName = $user->getFullName($userData);

if ($userData->image == "") {
    $userData->image = "user.png";
}

// Games that the user has added
$userGames = $gameDAO->getGamesByUserId($id);

?>

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title"><?= $fullName ?></h1>
                <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
                <h3 class="about-title">About:</h3>
                <?php if (!empty($userData->bio)) : ?>
                    <p class="profile-description"><?= $userData->bio ?></p>
                <?php else : ?>
                    <p class="profile-description">The user hasn't written anything here yet...</p>
                <?php endif; ?>
            </div>
            <div class="col-md-12 add-game-container">
                <h3>Games adds:</h3>
                <div class="games-container">
                    <?php foreach ($userGames as $game) : ?>
                        <?php require("templates/game_card.php"); ?>
                    <?php endforeach; ?>
                    <?php if (count($userGames) === 0) : ?>
                        <p class="empty-list">User hasn't uploaded games yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>