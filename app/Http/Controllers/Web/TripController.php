<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Father;
use App\Models\Trip;
use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TripController extends Controller
{
    public function index()
    {
        $admin=Auth::user();
        if($admin->school_id==null){
            return view("school.create");
        }
        $vehicles=vehicle::where('school_id',$admin->school_id)->get();
        return view("vehicle.index",compact("vehicles"));

    }

  public function store(request $data)
    {
        $admin=Auth::user();


        $data->validate([
            'geofence' => ['required', 'string'],
        ]);
        Trip::create([
            'geofence' => $data['geofence'],
            'school_id' => $admin->school_id,

        ]);

        return redirect()->route("child.index")
        ->with('success','trip added successfuly');
    }






    // public function create()
    // {
    //     //
    // }





    // public function show(Trip $trip)
    // {
    //     //
    // }


    // public function edit(Trip $trip)
    // {
    //     //
    // }


    // public function update(Request $request, Trip $trip)
    // {
    //     //
    // }


    // public function destroy(Trip $trip)
    // {
    //     //
    // }
}
