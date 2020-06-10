<?php

namespace App\Http\Controllers\Review;

use App\Services\Review\ReviewService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{

    /**
     * PageController constructor.
     * @param ReviewService $reviewService
     */
    public function __construct(ReviewService $reviewService, UserService $userService)
    {
        $this->reviewService = $reviewService;
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($model_id = 0)
    {
        if($model_id){
            $where = ['model_id' => $model_id];
            $reviews = $this->reviewService->findReviewBy($where);
        }
        else{
            $reviews = $this->reviewService->listAllReviews();
        }

        if($reviews){
            foreach ($reviews as $review) {
                $fan_details = $this->userService->findOneUserByOrFail(['id' => $review['fan_id'], 'usertype' => 3]);
                $model_details = $this->userService->findOneUserByOrFail(['id' => $review['model_id'], 'usertype' => 2]);
                $review['fan_name'] = $fan_details['name'];
                $review['model_name'] = $model_details['name'];
            }
        }
        return view('review.admin.index',compact('reviews'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = $this->reviewService->findReviewById($id);
        $fan_detail = $this->userService->findOneUserByOrFail(['id' => $review['fan_id'], 'usertype' => 3]);
        $model_detail = $this->userService->findOneUserByOrFail(['id' => $review['model_id'], 'usertype' => 2]);
        $review['fan_name'] = $fan_detail['name'];
        $review['model_name'] = $model_detail['name'];
        return view('review.admin.show',compact('review'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = $this->reviewService->deleteReview($id);
        if (!$review) {
            return redirect()->back('error-message','Some thing went wrong');
        }
        return redirect()->route('admin.review.index')->with('success-message','Record deleted Successfully');
    }

    public function updateStatus(Request $request) {
        $response = $this->reviewService->updateStatus($request);
        if($response){
            return response()->json(array('message'=>'Successfully updated package status'));
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_models()
    {
        $where = ['usertype' => 2];
        $models = $this->userService->findUserBy($where);

        if($models){
            foreach ($models as $model) {
                $model_rating = $this->reviewService->getAverageRating($model['id']);
                $total_rating = $this->reviewService->getTotalRating($model['id']);
                $model['rating'] = $model_rating;
                $model['total'] = $total_rating;
            }
        }
        return view('review.admin.all-models',compact('models'));
    }
}
