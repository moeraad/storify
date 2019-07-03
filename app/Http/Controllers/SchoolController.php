<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\School;

class SchoolController extends Controller{
    function index(){//get
        $user = Auth::user();
        $studied = $user->schools()->edges();
        
        return view("profile/school",compact('studied'));
    }

    function store(Request $request){//post
        $this->validate($request, [
            'name' => 'required|min:3',
            'location' => 'required|min:3',
            'degree' => 'required|min:3',
            'field' => 'required|min:3',
            'from' => 'required',
            'to' => 'required'
		]);

        $user = Auth::user();
        $name = $request->name;
        $location = $request->location;
        $degree = $request->degree;
        $field = $request->field;
        $from = $request->from;
        $to = $request->to;
        $current = $request->current;
        
        $school = School::where("name", $name)->where("location", $location)->first();
        
        if ( is_null($school) ) {
            $school = new School();
            $school->name = $name;
            $school->location = $location;
            $school->save();
            
        }
        
        $edge = $user->schools()->attach($school);
        $edge->degree = $degree;
        $edge->field = $field;
        $edge->from = $from;
        $edge->to = $to;
        $edge->current = $current;
        $edge->save();
        
        return redirect("school")->with('message', 'School added.');
    }

    function create(){//get

    }

    function show(){//get

    }

    function update(Request $request){//put
        $this->validate($request, [
            'name' => 'required|min:3',
            'location' => 'required|min:3',
            'degree' => 'required|min:3',
            'field' => 'required|min:3',
            'from' => 'required',
            'to' => 'required'
		]);

        $user = Auth::user();
        $id = $request->id;
        $edge_id = $request->edge_id;
        $name = $request->name;
        $location = $request->location;
        $degree = $request->degree;
        $field = $request->field;
        $from = $request->from;
        $to = $request->to;
        $current = $request->current;
        
        $currentSchool = School::find($id);
        $school = School::where("name", $name)->where("location", $location)->first();

        $oldEdge = $user->schools()->edgeById( $edge_id );
        
        if ( is_null($school) ) {
            $school = new School();
            $school->name = $name;
            $school->location = $location;
            $school->save();

            $oldEdge->delete();
            $edge = $user->schools()->attach($school);
        }
        else if($currentSchool != $school){
            $oldEdge->delete();
            $edge = $user->schools()->attach($school);
        }
        else{
            $edge = $oldEdge;
        }
        
        $edge->degree = $degree;
        $edge->field = $field;
        $edge->from = $from;
        $edge->to = $to;
        $edge->current = $current;
        $edge->save();

        return redirect("school")->with('message', 'School updated.');
    }

    function destroy($id){//delete
        $user = Auth::user();
        $studied = $user->schools()->edgeById( $id );

        if($studied->delete()) {
            return Redirect::route('school.index')->with('message', 'School removed.');
        }else{
            return Redirect::route('school.index')->with('message', 'School remove failed.');
        }
    }

    function edit($id){//get
        $user = Auth::user();
        $studied = $user->schools()->edgeById( $id );
        
        return view("profile/edit/school",compact('studied'));
    }
}