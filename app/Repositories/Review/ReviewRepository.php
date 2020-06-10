<?php
namespace App\Repositories\Review;

use App\Models\Review\Review;
//use App\Traits\UploadAble;
//use Illuminate\Http\UploadedFile;
use App\Contracts\Review\ReviewContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Auth;
/**
 * Class ReviewRepository
 *
 * @package \App\Repositories
 */
class ReviewRepository extends BaseRepository implements ReviewContract
{
    //use UploadAble;

    /**
     * ReviewRepository constructor.
     * @param Review $model
     */
    public function __construct(Review $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listReviews(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findReviewById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Review|mixed
     */
    public function createReview(array $params)
    {
        try {
            $collection         = collect($params);
            $review             = new $this->model;
            $review->fan_id     = Auth::user()->id;
            $review->model_id   = $params['model_id'];
            $review->title      = $params['title'];
            $review->body       = $params['description'];
            $review->rating     = $params['rating'];
            $review->save();
            return $review;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateReview(array $params)
    {
        $review     = $this->findReviewById($params['id']);
        $collection = collect($params)->except('_token');
        $review->title          = $params['title'];
        $review->body           = $params['description'];
        $review->rating         = $params['rating'];
        $review->is_approved    = 0;
        $review->save();
        return $review;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteReview($id)
    {
        $review = $this->findReviewById($id);

        $review->delete();

        return $review;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function getAverageRating($id)
    {
        return $this->model->where(['model_id' => $id/*, 'is_approved' => 1,'is_active' => 1*/])->avg('rating');
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function getTotalRating($id)
    {
        return $this->model->where(['model_id' => $id/*, 'is_approved' => 1,'is_active' => 1*/])->count('rating');
    }


    /**
     * @param $id
     * @return bool|mixed
     */
    public function findOneReviewBy(array $where = [])
    {
        return $this->findOneBy($where);
    }


    /**
     * @param $id
     * @return bool|mixed
     */
    public function findReviewBy(array $where = [])
    {
        return $this->findBy($where);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateReviewStatus(array $params){
        $review                 = $this->findReviewById($params['id']);
        $collection             = collect($params)->except('_token');
        $review->is_approved    = $collection['approval_status'];
        $review->is_active      = 1;
        $review->save();

        return $review;
    }

}
