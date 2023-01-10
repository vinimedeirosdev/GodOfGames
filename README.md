# GodOfGames

A game listing site developed with PHP and MySQL, where we can create an account and add games, reviews and ratings.

<img height="500em" src="https://github.com/ViniStrife/GodOfGames/blob/main/assets/Desktop-10-01-2023-19-38-14.gif"></img>

## Instructions:

For you to use this project on your machine you have to put the data in your own "database(Mysql)" of your localhost using "XAMPP Control" preferably:

`CREATE DATABASE god_of_games;`

`CREATE TABLE games (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  description TEXT,
  image VARCHAR(100),
  trailer VARCHAR(150),
  category VARCHAR(500),
  lenght VARCHAR(50),
  users_id INT UNSIGNED PRIMARY KEY
  );`
  
`CREATE TABLE reviews (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rating INT(11),
  review TEXT,
  users_id INT UNSIGNED PRIMARY KEY,
  gamess_id INT UNSIGNED PRIMARY KEY
  );`
  
`CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  lastname VARCHAR(100),
  email VARCHAR(200),
  password VARCHAR(200),
  image VARCHAR(200),
  token VARCHAR(200),
  bio TEXT
  );`
  
## Programming Languages:
  
  <li>PHP</li>
  <li>CSS</li>
  <li>BOOTSTRAP</li>
  <li>MYSQL</li>
