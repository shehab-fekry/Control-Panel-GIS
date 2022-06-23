<?php

namespace App\Http\Controllers\API;

use App\Events\adminNotification;
use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FatherResource;
use App\Models\School;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Trip;
use App\Models\User;

class FatherController extends BaseController
{

  public function showBusDriver()
  {
    $id=Auth::guard("api-fathers")->id();
    $father=Father::where("id",$id)->first();
    if($father->confirmed==false){
        return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');
    }
    elseif($father->trip_id==null){ 
      return $this->sendError('please validate errors','your account do not assigned to any trip yet please contact with one of school admins');
    }
    $trip = Trip::where('id',$father->trip_id)->first();
    $driver = $trip->driver()->first();
      if($driver == NUll){
      return $this->sendError('please validate errors','your trip do not have any driver yet please contact with one of school admins');
    }
    $vehicle = $trip->vehicle()->first();
   if($vehicle == NULL ){
   return $this->sendError('please validate errors','your trip do not have any vehicle yet please contact with one of school admins');
 }
    $response = ['driver'=>$driver,'vehicle'=>$vehicle];
     return $this->sendResponse(FatherResource::collection($response),'fathers retrived successfully');
  }

    public function show()
    {

        $id=Auth::guard("api-fathers")->id();
        $father=Father::where("id",$id)->get();


        return $this->sendResponse(FatherResource::collection($father),'fathers retrived successfully');


    }



    public function update(Request $request)
    {
        $id=Auth::guard('api-fathers')->id();
        $father=Father::get()->find($id);

        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required','string', 'max:30',],
            'mobileNumber'=>['required',],
            'region' => ['required','string',],
            'image_path' => ['required'],
            'lng' => ['required','numeric'],
            'lit' => ['required','numeric'],
            'email' => ['required','string', 'email', 'max:255',Rule::unique('fathers')->ignore($id),],

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $father->name=$input['name'];
        $father->email=$input['email'];
        $father->mobileNumber=$input['mobileNumber'];
        $father->region=$input['region'];
        $father->image_path=$input['image_path'];
        $father->lng=$input['lng'];
        $father->lit=$input['lit'];
        $father->confirmed=false;
        $father->save();
        if($father->trip_id==null){
        $father->trip_id=-1;
        }
        //admin notification
        $admin=User::where('school_id',$father->school_id)->where('is_admin',1)->first();
        $notification['id']=$admin->id;
        $notification['message']='parent:'.$father->name."update his information";
        event(new adminNotification($notification));


        return $this-> sendResponse(new fatherResource($father),'father information updated successfully');
    }
    public function showTrip(){
        $id=Auth::guard('api-fathers')->id();
        $father=Father::get()->find($id);
        $trip=Trip::get()->find($father->trip_id);
        $school = School::get()->find($father->school_id);
        $response = ['trip'=>$trip,'school'=>$school];
        if($father->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($father->trip_id==null){

            return $this->sendError('please validate errors','your account do not assigned to anytrip yet please contact with one of school admins');
        }elseif($father->status==0){ 

                 if($trip->status==0){
                      return $this->sendError('please validate errors','you do not have any child  going to school today please update your children status before the trip is start');
                    }else{
                       return $this->sendError('please validate errors','you do not have any child  going to school today and the trip is alredy started!');
                    }
        }
        switch($trip->status)
        {
            case 0:
                return $this->sendError('please validate errors','the trip is not started yet');
                break;
            case 1:
                return $this-> sendResponse("the trip is started and going to school",$response);
                break;
            case 2:
                return $this-> sendResponse("the trip is started and arrived to school",$response);
                break;
            case 3:
                return $this-> sendResponse("the trip is started and back from school",$response);

        }

    }

    public function destroy()
    {
        $id=Auth::guard('api-fathers')->id();
        $children=Child::where('father_id',$id)->get();
        if(count($children)>0){
          $children->delete();
        }

        $father=Father::find($id);
        //admin notification
        $admin=User::where('school_id',$father->school_id)->where('is_admin',1)->first();
        $notification['id']=$admin->id;
        $notification['message']='parent:'.$father->name."deleted his account!";
        event(new adminNotification($notification));
        $father->delete();
        return $this-> sendResponse("you are logged out",'Account deleted successfully');
    }


}
