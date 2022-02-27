<?php

namespace App\Http\Controllers\API;

use App\Models\driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;
use App\Models\Father;
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
        // $trip->status=1;
        // $trip->save();
        $fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get();
        $data=array();

        foreach($fathers as $father){
$count=1;
  $children=Child::where("father_id",$father->id)->where('status',true)->get();
$data[$father->name]=array();
$data[$father->name]+=array('lng'=>$father->lng);
$data[$father->name]+=array('lit'=>$father->lit);
foreach($children as $child){


             $data[$father->name]+=array($count=>$child->name);
             $count++;

}

            }



            return $this-> sendResponse($data,'father information updated successfully');


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
