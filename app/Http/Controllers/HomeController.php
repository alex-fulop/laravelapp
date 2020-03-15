<?php

namespace App\Http\Controllers;

use App\Http\Scopes\ScheduleScope;
use Illuminate\Http\Request;
use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $posts = Post::withoutGlobalScope(ScheduleScope::class)->where('user_id', '=', $user_id)->get();

        return view('home')->with('posts', $posts);
    }
}
