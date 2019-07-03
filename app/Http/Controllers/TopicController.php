<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Topic;

class TopicController extends Controller{
    function index(){//get
        $user = Auth::user();
        $knows_about = $user->topics()->edges();
        
        return view("profile/topic",compact('knows_about'));
    }

    function store(Request $request){//post
        $this->validate($request, [
            'name' => 'required|min:2'
		]);

        $user = Auth::user();
        $name = $request->name;
        
        $topic = Topic::where("name", $name)->first();
        
        if ( is_null($topic) ) {
            $topic = new Topic();
            $topic->name = $name;
            $topic->save();
            
        }
        
        $edge = $user->topics()->attach($topic);
        
        return redirect("topic")->with('message', 'Topic added.');
    }

    function create(){//get

    }

    function show(){//get

    }

    function update(Request $request){//put
        
    }

    function destroy($id){//delete
        $user = Auth::user();
        $knows_about = $user->topics()->edgeById( $id );

        if($knows_about->delete()) {
            return Redirect::route('topic.index')->with('message', 'Topic removed.');
        }else{
            return Redirect::route('topic.index')->with('message', 'Topic remove failed.');
        }
    }

    function edit($id){//get

    }
}