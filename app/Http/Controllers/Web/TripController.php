<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Father;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function start($id){
        $trip=Trip::find($id);
        $parents=Father::where('trip_id',$id)->where('status','>',0)->get();

       echo ($parents);




    }
    public function delivered($id){
        $trip=Trip::find($id);

    }
    public function backHome($id){
        $trip=Trip::find($id);

    }
    public function end($id){
        $trip=Trip::find($id);

    }

  public function store()
    {
        Trip::create([
            'driver_id'=>1,
        ]);
    }



    // public function index()
    // {

    // }


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
