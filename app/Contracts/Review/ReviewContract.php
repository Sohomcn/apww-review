<?php

namespace App\Contracts\Review;

/**
 * Interface ReviewContract
 * @package App\Contracts
 */
interface ReviewContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listReviews(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findReviewById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createReview(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateReview(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteReview($id);

    /**
     * @param $id
     * @return bool
     */
    public function getAverageRating($id);

    /**
     * @param $id
     * @return bool
     */
    public function getTotalRating($id);

    /**
     * @param $id
     * @return bool
     */
    public function findOneReviewBy(array $where);

    /**
     * @param $id
     * @return bool
     */
    public function findReviewBy(array $where);
}
