<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Comment;
use App\Post;

class CommentController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "content" => "required|min:1"
        ]);

        $user = Auth::user();
        $content = $request->content;
        $post_id = $request->post_id;
        $post = Post::find($post_id);

        $comment = new Comment();
        $comment->content = $content;
        $comment->likes = 0;
        $comment->save();
        
        $edge = $user->comments($post)->attach($comment);

        return redirect("feeds")->with('message', 'Comment added.');
    }
}
