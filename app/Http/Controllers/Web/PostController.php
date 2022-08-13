<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
         return view('frontend.post.index')->with([
            'posts' => auth()->user()->posts()->get()
        ]);
    }

     public function create()
    {
       return view('frontend.post.create');
    }

    public function store(StorePostRequest $request)
    {
       $data = $request->validated();
       $data['user_id'] = auth()->id();
       Post::create($data);
       return redirect()->route('dashboard');
    }

     public function show(Post $post)
    {
        return view('frontend.post.show')->with([
            'post' => $post
        ]);
    }

    public function getPostsBy(User $user){
        return view('frontend.index')->with([
            'posts' => $user->posts()->get()
        ]);
    }

}
