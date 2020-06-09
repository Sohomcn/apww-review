<?php

namespace App\Services\Review;

use App\Contracts\Review\ReviewContract;
//use Auth;

class ReviewService
{
    protected $reviewRepository;

    /**
     * class ReviewService constructor
     */
    public function __construct(ReviewContract $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function listAllReviews()
    {
        return $this->reviewRepository->listReviews();
    }

    public function findReviewById($id)
    {
        return $this->reviewRepository->findReviewById($id);
    }

    public function findOneReviewBy(array $where)
    {
        return $this->reviewRepository->findOneReviewBy($where);
    }

    public function findReviewBy(array $where)
    {
        return $this->reviewRepository->findReviewBy($where);
    }

    public function getAverageRating($model_id)
    {
        return $this->reviewRepository->getAverageRating($model_id);
    }

    public function getTotalRating($model_id)
    {
        return $this->reviewRepository->getTotalRating($model_id);
    }

    public function createReview(array $params){
        return $this->reviewRepository->createReview($params);
    }

    public function updateReview(array $params){
        return $this->reviewRepository->updateReview($params);
    }

    public function deleteReview($id) {
        return $this->reviewRepository->deleteReview($id);
    }

    public function updateStatus($request) {
        $params = $request->except('_token');
        return $this->reviewRepository->updateReviewStatus($params);
    }
}
