<?php
namespace App\Repositories\Post;

use App\Models\Post\Post;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\Post\PostContract;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Auth;
/**
 * Class ReviewRepository
 *
 * @package \App\Repositories
 */
class PostRepository extends BaseRepository implements PostContract
{
    use UploadAble;

    /**
     * ReviewRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
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
    public function listPosts(string $order = 'id', string $sort = 'desc', array $columns = ['*'], array $where = [])
    {
        return $this->model->where($where)->orderBy($order, $sort)->get($columns);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
   /* public function findReviewById(int $id)
    {
        try {
            return $this->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }*/

    /**
     * @param array $params
     * @return Review|mixed
     */
    public function createPost(array $params)
    {
        try {
                $collection = collect($params);
                $file_name = null;
                $post_type = 0;

                if ($collection->has('upload_file')){
                    $upload_file_ext = $params['upload_file']->getClientOriginalExtension();

                    $image_ext = ['gif', 'jpg', 'png','jepg'];
                    $video_ext = ['ogg', 'ogv', 'avi', 'mpe?g', 'mov', 'wmv', 'flv', 'mp4'];

                    if(in_array($upload_file_ext, $image_ext)){
                        if ($params['upload_file'] instanceof UploadedFile) {
                            $file_name = $this->uploadOne($params['upload_file'], 'post/image');
                        }
                        $post_type = 1;
                    }

                    else if(in_array($upload_file_ext, $video_ext)){
                        if ($params['upload_file'] instanceof UploadedFile) {
                            $file_name = $this->uploadOneVideo($params['upload_file'], 'post/video');
                        }
                        $post_type = 2;
                    }

                }


            $post = new Post;
            $post->model_id = Auth::User()->id;
            $post->price_type = $collection['price_type'];
            $post->amount = number_format($collection['amount'],2);
            $post->post_type = $post_type;
            $post->file = $file_name;
            $post->description = $collection['description'];
            $post->save();
            return $post;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
   /* public function updateReview(array $params)
    {
        $review     = $this->findReviewById($params['id']);
        $collection = collect($params)->except('_token');
        $review->title          = $params['title'];
        $review->body           = $params['description'];
        $review->rating         = $params['rating'];
        $review->is_approved    = 0;
        $review->save();
        return $review;
    }*/

    /**
     * @param $id
     * @return bool|mixed
     */
/* public function deleteReview($id)
    {
        $review = $this->findReviewById($id);

        $review->delete();

        return $review;
    }*/

    /**
     * @param $id
     * @return bool|mixed
     */
   /* public function getAverageRating($id)
    {
        return $this->model->where(['model_id' => $id, 'is_approved' => 1,'is_active' => 1])->avg('rating');
    }*/

    /**
     * @param $id
     * @return bool|mixed
     */
    /*public function getTotalRating($id)
    {
        return $this->model->where(['model_id' => $id, 'is_approved' => 1,'is_active' => 1])->count('rating');
    }*/


    /**
     * @param $id
     * @return bool|mixed
     */
    /*public function findOneReviewBy(array $where = [])
    {
        return $this->findOneBy($where);
    }*/


    /**
     * @param $id
     * @return bool|mixed
     */
    /*public function findReviewBy(array $where = [])
    {
        return $this->findBy($where);
    }*/

    /**
     * @param array $params
     * @return mixed
     */
   /*public function updateReviewStatus(array $params){
        $review                 = $this->findReviewById($params['id']);
        $collection             = collect($params)->except('_token');
        $review->is_approved    = $collection['approval_status'];
        $review->is_active      = 1;
        $review->save();

        return $review;
    }*/

}
