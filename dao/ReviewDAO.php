<?php

require_once("models/Review.php");
require_once("models/Message.php");

require_once("dao/UserDAO.php");

class ReviewDAO implements ReviewDAOInterface
{
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
  {
    $this->conn = $conn;
    $this->url = $url;
    $this->message = new Message($url);
  }

    public function buildReview($data){

        $reviewObject = new Review();

        $reviewObject->id = $data["id"];
        $reviewObject->rating = $data["rating"];
        $reviewObject->review = $data["review"];
        $reviewObject->users_id = $data["users_id"];
        $reviewObject->games_id = $data["games_id"];

        return $reviewObject;

    }

    public function create(Review $review){

        $stmt = $this->conn->prepare("INSERT INTO reviews (
            rating, review, games_id, users_id
            ) VALUES (
                :rating, :review, :games_id, :users_id
            )");
      
          $stmt->bindParam(":rating", $review->rating);
          $stmt->bindParam(":review", $review->review);
          $stmt->bindParam(":games_id", $review->games_id);
          $stmt->bindParam(":users_id", $review->users_id);
      
          $stmt->execute();
      
          // Success Menssage for the add game
          $this->message->setMessage("Review add successfully!", "success", "index.php");

    }

    public function getGamesReview($id){

        $reviews = [];

        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE games_id = :games_id");

        $stmt->bindParam(":games_id", $id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $reviewsData = $stmt->fetchAll();

            $userDao = new UserDAO($this->conn, $this->url);

            foreach($reviewsData as $review) {

                $reviewObject = $this->buildReview($review);

                // Call user data
                $user = $userDao->findById($reviewObject->users_id);

                $reviewObject->user = $user;

                $reviews[] = $reviewObject;

            }
      
          } 

          return $reviews;

        }

    public function hasAlreadyReviewed($id, $users_id){

    }

    public function getRatings($id){

    }
}