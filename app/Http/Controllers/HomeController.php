<?php

namespace App\Http\Controllers;

use App\Http\Scopes\ScheduleScope;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Carbon\Carbon;

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
        $scheduledPosts = array();
        foreach ($posts as $key => $value) {
            if ($value->created_at->greaterThanOrEqualTo(Carbon::now())) {
                array_push($scheduledPosts, $value);
                unset($posts[$key]);
            }
        }

        return view('home', compact('posts', $posts, 'scheduledPosts', $scheduledPosts));
    }
}
