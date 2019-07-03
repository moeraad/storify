<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Location;

class LocationController extends Controller{
    function index(){//get
        $user = Auth::user();
        $lived = $user->locations()->edges();
        
        return view("profile/location",compact('lived'));
    }

    function store(Request $request){//post
        $this->validate($request, [
            'country' => 'required|min:3',
            'state' => 'required|min:3',
            'city' => 'required|min:3',
            'from' => 'required'
		]);

        $user = Auth::user();
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $from = $request->from;
        $to = $request->to;
        $current = $request->current;
        
        $location = Location::where("country", $country)->where("state", $state)
                    ->where("city", $city)->first();
        
        if ( is_null($location) ) {
            $location = new Location();
            $location->country = $country;
            $location->state = $state;
            $location->city = $city;
            $location->save();
            
        }
        
        $edge = $user->locations()->attach($location);
        $edge->from = $from;
        $edge->to = $to;
        $edge->current = $current;
        $edge->save();
        
        return redirect("location")->with('message', 'Location added.');
    }

    function create(){//get

    }

    function show(){//get

    }

    function update(Request $request){//put
        $this->validate($request, [
            'country' => 'required|min:3',
            'state' => 'required|min:3',
            'city' => 'required|min:3',
            'from' => 'required'
		]);

        $user = Auth::user();
        $id = $request->id;
        $edge_id = $request->edge_id;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $from = $request->from;
        $to = $request->to;
        $current = $request->current;
        
        $currentLocation = Location::find($id);
        $location = Location::where("country", $country)->where("state", $state)
                    ->where("city", $city)->first();

        $oldEdge = $user->locations()->edgeById( $edge_id );
        
        if ( is_null($location) ) {
            $location = new Location();
            $location->country = $country;
            $location->state = $state;
            $location->city = $city;
            $location->save();

            $oldEdge->delete();
            $edge = $user->locations()->attach($location);
        }
        else if($currentLocation != $location){
            $oldEdge->delete();
            $edge = $user->locations()->attach($location);
        }
        else{
            $edge = $oldEdge;
        }
        
        $edge->from = $from;
        $edge->to = $to;
        $edge->current = $current;
        $edge->save();

        return redirect("location")->with('message', 'Location updated.');
    }

    function destroy($id){//delete
        $user = Auth::user();
        $lived = $user->locations()->edgeById( $id );

        if($lived->delete()) {
            return Redirect::route('location.index')->with('message', 'Location removed.');
        }else{
            return Redirect::route('location.index')->with('message', 'Location remove failed.');
        }
    }

    function edit($id){//get
        $user = Auth::user();
        $lived = $user->locations()->edgeById( $id );
        
        return view("profile/edit/location",compact('lived'));
    }
}