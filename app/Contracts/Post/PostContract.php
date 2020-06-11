<?php

namespace App\Contracts\Post;

/**
 * Interface ReviewContract
 * @package App\Contracts
 */
interface PostContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listPosts(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
   // public function findReviewById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createPost(array $params);

    /**
     * @param array $params
     * @return mixed
     */
   // public function updateReview(array $params);

    /**
     * @param $id
     * @return bool
     */
  //  public function deleteReview($id);

    /**
     * @param $id
     * @return bool
     */
 //   public function getAverageRating($id);

    /**
     * @param $id
     * @return bool
     */
  //  public function getTotalRating($id);

    /**
     * @param $id
     * @return bool
     */
  //  public function findOneReviewBy(array $where);

    /**
     * @param $id
     * @return bool
     */
    //public function findPostBy(array $where);
}
