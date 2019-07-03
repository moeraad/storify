<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Interest;

class InterestController extends Controller{
    function index(){//get
        $user = Auth::user();
        $care_about = $user->interests()->edges();
        
        return view("profile/interest",compact('care_about'));
    }

    function store(Request $request){//post
        $this->validate($request, [
            'name' => 'required|min:2'
		]);

        $user = Auth::user();
        $name = $request->name;
        
        $interest = Interest::where("name", $name)->first();
        
        if ( is_null($interest) ) {
            $interest = new Interest();
            $interest->name = $name;
            $interest->save();
            
        }
        $edges = $user->interests()->edges($interest);

        $edge = $user->interests()->attach($interest);
        
        return redirect("interest")->with('message', 'Interest added.');
    }

    function create(){//get

    }

    function show(){//get

    }

    function update(Request $request){//put
        
    }

    function destroy($id){//delete
        $user = Auth::user();
        $care_about = $user->interests()->edgeById( $id );

        if($care_about->delete()) {
            return Redirect::route('interest.index')->with('message', 'Interest removed.');
        }else{
            return Redirect::route('interest.index')->with('message', 'Interest remove failed.');
        }
    }

    function edit($id){//get

    }
}