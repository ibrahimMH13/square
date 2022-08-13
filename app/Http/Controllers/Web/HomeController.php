<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.index')->with([
            'posts' => Post::filter(request())->paginate(10)
        ]);
    }
}
