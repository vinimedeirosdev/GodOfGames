<?php

  $db_name = "god_of_games";
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "";

  $conn = new PDO("mysql:dbname=". $db_name . ";host=". $db_host, $db_user, $db_pass);

  //Enable PDO errors
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
