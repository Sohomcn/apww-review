<?php

namespace App\Services\Post;

use App\Contracts\Post\PostContract;

class PostService
{
    protected $postRepository;

    /**
     * class ReviewService constructor
     */
    public function __construct(PostContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listAllPosts(string $order = 'id', string $sort = 'desc', array $columns = ['*'], array $where = [])
    {
        return $this->postRepository->listPosts($order ,$sort , $columns , $where);
    }

    public function createPost(array $params){
        return $this->postRepository->createPost($params);
    }

    /*


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



    public function updateReview(array $params){
        return $this->reviewRepository->updateReview($params);
    }

    public function deleteReview($id) {
        return $this->reviewRepository->deleteReview($id);
    }

    public function updateStatus($request) {
        $params = $request->except('_token');
        return $this->reviewRepository->updateReviewStatus($params);
    }*/
}
