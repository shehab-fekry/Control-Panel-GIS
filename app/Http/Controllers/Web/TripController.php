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
            return redirect()->route('school.index');
        }
        $trips=Trip::where('school_id',$admin->school_id)->latest()->paginate(3);
        return view("trip.index",compact("trips"));

    }
    public function indexedit()
    {
        $admin=Auth::user();
        if($admin->school_id==null){
            return redirect()->route('school.index');
        }
        $trips=Trip::where('school_id',$admin->school_id)->get();
        return view("trip.indextrip",compact("trips"));

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

        return redirect()->route("trip.index")
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


    public function edit(Trip $trip)
    {
        $admin=Auth::user();
        // $trips=Trip::where("school_id",$admin->school_id)->get();
        // return view("trip.edit",compact('trip'))->with('trips',$trips);
        return view("trip.edit",compact('trip'));
    }


    // public function update(Request $request, Trip $trip)
    // {
    //     //
    // }


    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route("trip.index")->with('success','trip deleted successfuly');
    }
}
