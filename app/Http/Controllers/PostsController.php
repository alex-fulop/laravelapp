<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Scopes\FilterScope;
use Illuminate\Support\Carbon;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::pluck('name', 'id');
        $posts = Post::all();
        return view('pages.posts', compact('posts', $posts, 'categories', $categories));
    }

    public function filter(FilterRequest $request)
    {
        $categories = Category::pluck('name', 'id');

        $filter = $request->input('categories');

        $filters = Category::findMany($filter);

        $filterNames = array();
        foreach ($filters as $filter) {
            array_push($filterNames, $filter->name);
        }

        $posts = Post::HasFilters($filterNames)->get();

        return view('pages.posts', compact('posts', $posts, 'categories', $categories));

        // dd($posts);

        // $filteredPosts = array();
        // foreach ($posts as $post) {
        //     $categories = $post->categories;

        //     if ($categories == $filters)
        //         array_push($filteredPosts, $post);
        // }

        // $categories = Category::pluck('name', 'id');
        // $filters = Category::find($filter);
        // $filteredPosts = array();
        // foreach ($posts as $post) {
        //     if ($post->categories == $filters)
        //         array_push($filteredPosts, $post);
        //}
        // $Filter = Category::pluck('name', 'id');
        // $categories = Category::pluck('name', 'id');
        // $posts = Post::whereHas('categories', function ($q) use ($Filter, $filter) {
        //     $q->where('name', ['Action', 'Comedy']);
        // })->get();

        // $categories = Category::pluck('name', 'id');
        // //Check to see if we have a filter request
        // $filters = DB::table('posts')->join('category_post', 'category_post.post_id', 'posts.id')->get();
        // $posts = DB::table('posts')->join('category_post','category_post.');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $current = Carbon::now();
        $selectCategories = array();

        // foreach ($categories as $category) {
        //     $selectCategories[$category->id] = $category->name;
        // }

        // Pluck does all this

        return view('pages.create', compact('current', $current, 'categories', $selectCategories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = new Post();
        $post->handleRequest($request);

        return redirect('pages')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = $post->comments;
        return view('pages.view', compact('post', $post, 'comments', $comments));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('pages.create', compact('post', $post, 'current', Carbon::now()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreRequest $request, $id)
    {
        $post = Post::find($id);
        $post->handleRequest($request);

        return redirect('pages')->with('Success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('pages')->with('success', 'Post Removed');
    }
}
