<?php

namespace App\Http\Controllers\API;

use App\Models\driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends BaseController
{
    public function start(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($driver->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($driver->trip_id==null){

            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }elseif($trip->status>0){
            return $this->sendError('please validate errors','the trip is alredy started');
        }
        $fathers=$trip->father()->where('status',">",0);




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
