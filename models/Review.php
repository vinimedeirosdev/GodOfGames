<?php

class Review
{
    public $id;
    public $rating;
    public $review;
    public $users_id;
    public $games_id;
}

interface ReviewDAOInterface {

    public function buildReview($data);
    public function create(Review $review);
    public function getGamesReview($id);
    public function hasAlreadyReviewed($id, $users_id);
    public function getRatings($id);

}