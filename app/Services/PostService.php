<?php

namespace App\Services;

use App\Models\Post;
use App\Traits\HandleResponse;
use Illuminate\Support\Facades\Route;

class PostService
{
    use HandleResponse;


    /**
     * @param mixed $request
     * 
     * @return response
     */
    public function getAllPosts($request)
    {
        $limit = config('app.pagination');

        $posts = Post::when($request->sort_by, function ($query) use ($request) {
            $query->orderBy($request->sort_by);
        })->paginate($limit);


        $data = [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts
        ];

        return $this->InertiaResponse('Welcome', $this->JsonResponse($data, 'Posts retrive successfully!'));
    }



    public function savePost($request)
    {
        auth()->user()->posts()->create( $request->only(['title', 'description', 'publication_date']) );

        return $this->InertiaResponse('Posts/Create', ['status' => 'Post created successfully!']);
    }
}
