<?php

namespace App\Http\Controllers\API;

use App\Events\showTrip;
use App\Models\driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\tripNotification;
use App\Events\clerkNotification;
use App\Http\Resources\FatherResource;
use App\Http\Resources\ChildResource;
use App\Models\School;
use Illuminate\Database\Eloquent\Collection;

class TripController extends BaseController
{

    public static function tripparents($request){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        $fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get();
        $data=array();
         $request_lat=deg2rad($request->lit);
         $request_lon=deg2rad($request->lng);
         $collection=new Collection();

        foreach($fathers as $father)
        {
            $arr=array();
            $father_lat=deg2rad($father->lit);
            $father_lon=deg2rad($father->lng);
            $count=1;
            $children=Child::where("father_id",$father->id)->where('status',true)->get();

            $ln=$father_lon-$request_lon;
            $li=$father_lat-$request_lat;
            $val = pow(sin($li/2),2)+cos($request_lat)*cos($father_lat)*pow(sin($ln/2),2);
            $res = 2 * asin(sqrt($val));
            $radius = 6371;
            $distance=($res*$radius)*1000;
            $arr+=array('distance'=>$distance);
            $arr+=array('name'=>$father->name);
            $arr+=array('id'=>$father->id);
            $arr+=array('lng'=>$father->lng);
            $arr+=array('lit'=>$father->lit);
            foreach($children as $child)
            {
                $arr+=array($count=>$child->name);
                $count++;
            }
        $collection->push($arr);
        }

        $sorted = $collection->sortBy('distance');
        return $sorted;
    }
    public function start(request $request){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        $fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get();
        if($driver->confirmed==false)
        {
        return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');
        }
        elseif($fathers->count() == 0 )
        {
          return $this->sendError('please validate errors','There is no parents in this trip');
        }
        elseif($driver->trip_id==null)
        {
            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }
        elseif($trip->status >=1){
            return $this->sendError('please validate errors','the trip is alredy started');
        }
        
        $trip->status=1;
         $trip->save();
       $sorted= TripController::tripparents($request);
        $data['fathers']=new FatherResource($sorted);
        $data['school']=School::where('id',$driver->school_id)->first();
        $data['trip']=$trip;
        // notification fo parents
        $notification['trip_id']=$trip->id;
        $notification['message']='the trip is started you will get a notification when it is get close to your home';

        event(new tripNotification($notification));

        //notifications fot clerk and admin
        $notification2['school_id']=$driver->school_id;
        $notification2['message']="driver:".$driver->name." start trip:".$trip->geofence;
        event(new clerkNotification($notification2));
        return $this->sendResponse($data,'trip information retrived successfully');

    }
    public function delivered(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($driver->confirmed==false)
        {
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($driver->trip_id==null)
        {
            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }
        if($trip->status==0){
            return $this->sendError('please validate errors','the trip is not started yet please start trip first');
        }elseif($trip->status==2){
            return $this->sendError('please validate errors','the trip is alredy delivered to school');
        }elseif($trip->status==3){
            return $this->sendError('please validate errors','the trip is backing to home');
        }
        $trip->status=2;
        $trip->save();
        //notifications for parents
        $notification['trip_id']=$driver->trip_id;
        $notification['message']='the bus is delivered to school you will get a notification when it is come back from school';
        event(new tripNotification($notification));
         //notifications fot clerk and admin
         $notification2['school_id']=$driver->school_id;
         $notification2['message']="driver:".$driver->name." of the trip:".$trip->geofence."delivered to school";
         event(new clerkNotification($notification2));

        return $this-> sendResponse("",'the trip is delivered to school succefully you could start the back trip at any time');
    }
    public function backHome(request $request){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($driver->confirmed==false)
        {
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($driver->trip_id==null)
        {
            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }
        switch($trip->status){
            case 0:
                return $this->sendError('please validate errors','the trip is not started yet please start trip first');
            case 1:
                return $this->sendError('please validate errors','the trip is not delivered to school yet');
            case 2:
                $trip->status=3;
                $trip->save();
                $sorted= TripController::tripparents($request);
                $data['fathers']=new FatherResource($sorted);
                // $data['school']=School::where('id',$driver->school_id)->first();
                $data['trip']=$trip;
                //parents notification
                $notification['trip_id']=$trip->id;
                $notification['message']='the bus is coming back to home';
                event(new tripNotification($notification));
                 //notifications fot clerk and admin
                $notification2['school_id']=$driver->school_id;
                $notification2['message']="driver:".$driver->name." of the trip:".$trip->geofence."backing to home";
                event(new clerkNotification($notification2));
                return $this-> sendResponse($data,'the trip is backing to home');
                 case 3:
                return $this->sendError('please validate errors','the trip is alredy backing from school');

        }

    }


    public function end(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($driver->confirmed==false)
        {
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($driver->trip_id==null)
        {
            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }
        if($trip->status==0){
            return $this->sendError('please validate errors','the trip is alredy ended');
        }elseif($trip->status==1){
            return $this->sendError('please validate errors','the trip is not delivered to school yet');
        }elseif($trip->status==2){
            return $this->sendError('please validate errors','the trip is delivered to school you need to start the back trip first');
        }
        $trip->status=0;
        $trip->save();
         //notifications fot clerk and admin
         $notification2['school_id']=$driver->school_id;
         $notification2['message']="driver:".$driver->name." end the trip:".$trip->geofence."successfully";
         event(new clerkNotification($notification2));
        return $this-> sendResponse("",'the trip is ended successfully');

    }
    public function attendence(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $trip=Trip::get()->find($driver->trip_id);
        if($driver->confirmed==false)
        {
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($driver->trip_id==null)
        {
            return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
        }
        $fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get(); 
        $data=array();
        $collection=new Collection();
       foreach($fathers as $father)
       {
           $arr=array();
           $count=1;
           $children=Child::where("father_id",$father->id)->where('status',true)->get();
           $arr+=array('name'=>$father->name);
           $arr+=array('id'=>$father->id);
           $arr+=array('image_path'=>$father->image_path);
           $arr+=array('lng'=>$father->lng);
           $arr+=array('lit'=>$father->lit);
           $arr+=array('children'=>new ChildResource($children));
        //    foreach($children as $child)
        //    {
        //        $arr+=array($count=>$child->name);
        //        $count++;
        //    }
       $collection->push($arr);
       }
       $data=new FatherResource($collection);
       return $this->sendResponse($data,'attendance list retrieved successfully');
    }

}
