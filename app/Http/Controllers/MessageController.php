<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Post;
use App\User;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //$wrote = $user->posts()->edges();
    
        return view('messages');
    }

    public function create()
    {
        $users = User::all();
        return view('compose_message', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "content" => "required|min:2"
        ]);
        
        $user = Auth::user();
        $content = $request->content;
        $receiver_id = $request->recepient;
        $receiver = User::find($receiver_id);

        $message = new Message();
        $message->content = $content;
        $message->save();


    }
}
