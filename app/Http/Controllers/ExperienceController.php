<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Experience;

class ExperienceController extends Controller{
    function index(){//get
        $user = Auth::user();
        $worked = $user->experiences()->edges();
        
        return view("profile/experience",compact('worked'));
    }

    function store(Request $request){//post
        $this->validate($request, [
            'name' => 'required|min:3',
            'location' => 'required|min:3',
            'position' => 'required|min:3',
            'from' => 'required'
		]);

        $user = Auth::user();
        $name = $request->name;
        $location = $request->location;
        $position = $request->position;
        $from = $request->from;
        $to = $request->to;
        $current = $request->current;
        
        $experience = Experience::where("name", $name)->where("location", $location)->first();
        
        if ( is_null($experience) ) {
            $experience = new Experience();
            $experience->name = $name;
            $experience->location = $location;
            $experience->save();
            
        }
        
        $edge = $user->experiences()->attach($experience);
        $edge->position = $position;
        $edge->from = $from;
        $edge->to = $to;
        $edge->current = $current;
        $edge->save();
        
        return redirect("experience")->with('message', 'Experience added.');
    }

    function create(){//get

    }

    function show(){//get

    }

    function update(Request $request){//put
        $this->validate($request, [
            'name' => 'required|min:3',
            'location' => 'required|min:3',
            'position' => 'required|min:3',
            'from' => 'required'
		]);

        $user = Auth::user();
        $id = $request->id;
        $edge_id = $request->edge_id;
        $name = $request->name;
        $location = $request->location;
        $position = $request->position;
        $from = $request->from;
        $to = $request->to;
        $current = $request->current;
        
        $currentExperience = Experience::find($id);
        $experience = Experience::where("name", $name)->where("location", $location)->first();

        $oldEdge = $user->experiences()->edgeById( $edge_id );
        
        if ( is_null($experience) ) {
            $experience = new Experience();
            $experience->name = $name;
            $experience->location = $location;
            $experience->save();

            $oldEdge->delete();
            $edge = $user->experiences()->attach($experience);
        }
        else if($currentExperience != $experience){
            $oldEdge->delete();
            $edge = $user->experiences()->attach($experience);
        }
        else{
            $edge = $oldEdge;
        }
        
        $edge->position = $position;
        $edge->from = $from;
        $edge->to = $to;
        $edge->current = $current;
        $edge->save();

        return redirect("experience")->with('message', 'Experience updated.');
    }

    function destroy($id){//delete
        $user = Auth::user();
        $worked = $user->experiences()->edgeById( $id );

        if($worked->delete()) {
            return Redirect::route('experience.index')->with('message', 'Experience removed.');
        }else{
            return Redirect::route('experience.index')->with('message', 'Experience remove failed.');
        }
    }

    function edit($id){//get
        $user = Auth::user();
        $worked = $user->experiences()->edgeById( $id );
        
        return view("profile/edit/experience",compact('worked'));
    }
}