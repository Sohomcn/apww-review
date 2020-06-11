<?php

namespace App\Http\Controllers\Post;

use App\Services\Post\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

class ModelPostController extends BaseController
{
    /**
     * PageController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::User()->id;
        $where = ['model_id' => $user_id];
        $posts = $this->postService->listAllPosts('id','desc',['*'],$where);
        $model_detail = Auth::User();
        return view('post.model.index',compact('posts','model_detail'));
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
            'description'      =>  'required|max:191',
        ]);
        $params = $request->except('_token');
        $post = $this->postService->createPost($params);

        if (!$post) {
            return $this->responseRedirectBack('Error occurred while creating post.', 'error', true, true);
        }
        return $this->responseRedirect('model.post.index', 'Post added successfully' ,'success',false, false);
    }
}
