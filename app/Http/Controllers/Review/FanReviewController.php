<?php

namespace App\Http\Controllers\Review;

use App\Services\Review\ReviewService;
use App\Services\Review\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class FanReviewController extends Controller
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
        return view('review.fan.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($model_id)
    {
        $model_details = $this->userService->findOneUserByOrFail(['id' => $model_id, 'usertype' => 2]);
        return view('review.fan.create',compact('model_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rating'           => 'required|numeric|min:1|max:5',
            'title'            => 'required|max:50',
            'description'      => 'required|max:300',
        ]);

        $params = $request->except('_token');
        $review = $this->reviewService->findOneReviewBy(['model_id' => $params['model_id'], 'fan_id' => Auth::User()->id]);

        if($review){
            $params['id'] = $review->id;
            $review = $this->reviewService->updateReview($params);
        }else{
            $review = $this->reviewService->createReview($params);
        }

        if($review){
           return redirect()->route('fan.review.index')->with('success-message','Saved Successfully');
        }else{
            return redirect()->back('error-message','Some thing went wrong');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function models_review($model_id)
    {
        $reviews = $this->reviewService->findReviewBy(['model_id' => $model_id, 'is_approved' => 1,'is_active' => 1]);

        $model_details = $this->userService->findOneUserByOrFail(['id' => $model_id, 'usertype' => 2]);
        $model_rating = $this->reviewService->getAverageRating($model_id);
        $total_rating = $this->reviewService->getTotalRating($model_id);

        if($reviews){
            foreach ($reviews as $review) {
                $fan_details = $this->userService->findOneUserByOrFail(['id' => $review['fan_id'], 'usertype' => 3]);
                $review['fan_name'] = $fan_details['name'];
                $review['model_name'] = $model_details['name'];
            }
        }
        return view('review.fan.models-review',compact('reviews','model_details','model_rating','total_rating'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_review()
    {
        $reviews = $this->reviewService->findReviewBy(['fan_id' => Auth::User()->id, 'is_approved' => 1,'is_active' => 1]);

        $fan_details = $this->userService->findOneUserByOrFail(['id' => Auth::User()->id, 'usertype' => 3]);

        if($reviews){
            foreach ($reviews as $review) {
                $model_details = $this->userService->findOneUserByOrFail(['id' => $review['model_id'], 'usertype' => 2]);
                $review['fan_name']     = $fan_details['name'];
                $review['model_name']   = $model_details['name'];
            }
        }
        return view('review.fan.my-review',compact('reviews','model_details'));
    }


}
