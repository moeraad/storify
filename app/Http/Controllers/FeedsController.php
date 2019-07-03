<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Post;

class FeedsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wrote = $user->posts()->edges();
    
        return view('feeds',compact("wrote"));
    }
}
