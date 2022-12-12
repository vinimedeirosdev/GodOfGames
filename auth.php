<?php
require_once("templates/header.php");
?>

<div id="main-container" class="container-fluid">
  <div class="col-md-12">
    <div class="row" id="auth-row">
      <div class="col-md-4" id="login-container">
        <h2>Login</h2>
        <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
          <input type="hidden" name="type" value="login">
          <div class="form-group mb-2">
            <label for="email" class="mb-2">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Type your e-mail">
          </div>
          <div class="form-group">
            <label class="mb-2" for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Type your password">
          </div>
          <input type="submit" class="btn card-btn" value="Login">
        </form>
      </div>
      <div class="col-md-4" id="register-container">
        <h2>Register</h2>
        <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
          <input type="hidden" name="type" value="register">
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Type your name">
          </div>
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="lastname">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Type your last name">
          </div>
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Type your e-mail">
          </div>
          <div class="form-group mb-2">
            <label class="form-group mb-2" for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Create your password">
          </div>
          <div class="form-group">
            <label class="form-group mb-2" for="confirmpassword">Confirm the password:</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password">
            <input type="submit" class="btn card-btn" value="Register">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>