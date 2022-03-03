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
        if($driver->confirmed==false)
        {
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($driver->trip_id==null)
        {
            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }elseif($trip->status>0){
            return $this->sendError('please validate errors','the trip is alredy started');
        }
        $trip->status=1;
        $trip->save();
        $fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get();
        $data=array();

        foreach($fathers as $father)
        {
            $count=1;
            $children=Child::where("father_id",$father->id)->where('status',true)->get();
            $data[$father->name]=array();
            $data[$father->name]+=array('lng'=>$father->lng);
            $data[$father->name]+=array('lit'=>$father->lit);
            foreach($children as $child)
            {
                $data[$father->name]+=array($count=>$child->name);
                $count++;
            }
        }
        return $this-> sendResponse($data,'father information updated successfully');
    }
    public function delivered(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($trip->status==0){
            return $this->sendError('please validate errors','the trip is not started yet please start trip first');
        }elseif($trip->status==2){
            return $this->sendError('please validate errors','the trip is alredy delivered to school');
        }elseif($trip->status==3){
            return $this->sendError('please validate errors','the trip is backing to home');
        }
        $trip->status=2;
        $trip->save();
        return $this-> sendResponse("",'the trip is delivered to school succefully you could start the back trip at any time');
    }
    public function backHome(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($trip->status==0){
            return $this->sendError('please validate errors','the trip is not started yet please start trip first');
        }elseif($trip->status==1){
            return $this->sendError('please validate errors','the trip is not delivered to school yet');
        }elseif($trip->status==3){
            return $this->sendError('please validate errors','the trip is alredy backing from school');
        }
        $trip->status=3;
        $trip->save();
        return $this-> sendResponse("",'the trip is backing to home');
    }


    public function end($id){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($trip->status==0){
            return $this->sendError('please validate errors','the trip is alredy ended');
        }elseif($trip->status==1){
            return $this->sendError('please validate errors','the trip is not delivered to school yet');
        }elseif($trip->status==2){
            return $this->sendError('please validate errors','the trip is delivered to school you need to start the back trip first');
        }
        $trip->status=0;
        $trip->save();
        return $this-> sendResponse("",'the trip is ended successfully');

    }

}
