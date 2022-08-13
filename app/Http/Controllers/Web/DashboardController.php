<?php

namespace App\Http\Controllers\Web;

use App\Filter\FiltersType\OrderByFilter;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('frontend.dashboard')->with([
            'posts' => $user->posts()->filter(request())->paginate(10),
            'user' => $user
        ]);
    }
 }
