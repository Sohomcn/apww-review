<?php

namespace App\Http\Controllers\Review;

use App\Services\Review\ReviewService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ModelReviewController extends Controller
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
    public function index()
    {
        $model_id = Auth::User()->id;
        $reviews = $this->reviewService->findReviewBy(['model_id' => $model_id, 'is_approved' => 1,'is_active' => 1]);

        $model_details = $this->userService->findOneUserByOrFail(['id' => $model_id, 'usertype' => 2]);
        $model_rating = $this->reviewService->getAverageRating($model_id);
        $total_rating = $this->reviewService->getTotalRating($model_id);

        if($reviews){
            foreach ($reviews as $review) {
                $fan_details = $this->userService->findOneUserByOrFail(['id' => $review['fan_id'], 'usertype' => 3]);
                $review['fan_name']     = $fan_details['name'];
                $review['model_name']   = $model_details['name'];
            }
        }
        return view('review.model.index',compact('reviews','model_details','model_rating','total_rating'));
    }
}
