<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Http\Requests\CommentStoreRequest;
use Illuminate\Http\Request;
use PDO;

class CommentsController extends Controller
{
    public function index()
    {
    }

    public function store(CommentStoreRequest $request, $id)
    {
        $post = Post::find($id);
        $post_id = $post->id;
        $comment = new Comment;
        $comment->handleRequest($request, $post_id);

        return redirect('pages/' . $post_id)->with('success', 'Comment Added');
    }
    public function edit($id)
    {
        dd('ggod');
    }

    public function update(CommentStoreRequest $request, $id)
    {
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post_id;
        $comment->delete();

        return redirect('pages/' . $post_id)->with('status', 'Comment Deleted');
    }
}
