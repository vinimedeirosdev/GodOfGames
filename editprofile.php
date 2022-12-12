<?php
require_once("templates/header.php");

require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDAO = new UserDAO($conn, $BASE_URL);

$userData = $userDAO->verifyToken(true);

$fullName = $user->getFullName($userData);

if ($userData->image == "") {
  $userData->image = "user.png";
}

?>

<div id="main-container" class="container-fluid">
  <div class="col-md-12">
    <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="update">
      <div class="row">
        <div class="col-md-4">
          <h1>
            <?= $fullName ?>
          </h1>
          <p class="page-description">
            Change your data in the form below:
          </p>
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Type your name"
              value="<?= $userData->name ?>">
          </div>
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="lastname">Lastname:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Type your lastname"
              value="<?= $userData->lastname ?>">
          </div>
          <div class="form-group">
            <label class="form-group mb-2" for="email">E-mail:</label>
            <input type="text" readonly class="form-control disabled" id="email" name="email"
              placeholder="Type your email" value="<?= $userData->email ?>">
          </div>
          <input type="submit" class="btn card-btn" value="Change">
        </div>
        <div class="col-md-4">
          <div id="profile-image-container"
            style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
          <div class="form-group mb-2">
            <label class="form-group mb-2"for="image">Photo:</label>
            <input type="file" class="form-control-file" name="image">
          </div>
          <div class="form-group">
            <label class="form-group mb-2" for="bio">About you:</label>
            <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Talk about you..."><?= $userData->bio ?></textarea>
          </div>
        </div>
      </div>
    </form>
    <div class="row" id="change-password-container">
      <div class="col-md-4">
        <h2>Change the password:</h2>
        <p class="page-description">
          Type your new password and confirm to altered your password:
        </p>
        <form action="<?= $BASE_URL ?>user_process.php" method="POST">
          <input type="hidden" name="type" value="changepassword">
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"
              placeholder="Type your new password">
          </div>
          <div class="form-group">
            <label class="form-group mb-2" for="confirmpassword">Confirm your password:</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
              placeholder="Confirm your new password">
          </div>
          <input type="submit" class="btn card-btn" value="Change Password">
        </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>