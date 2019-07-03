<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('feeds');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "content" => "required|min:1",
            "privacy" => "required"
        ]);

        $user = Auth::user();
        $content = $request->content;
        $privacy = $request->privacy;
        
        $post = new Post();
        $post->content = $content;
        $post->privacy = $privacy;  //private=0, public=1
        $post->likes = 0;
        $post->save();
        
        $edge = $user->posts()->attach($post);

        return redirect("feeds")->with('message', 'Post added.');
    }
}
