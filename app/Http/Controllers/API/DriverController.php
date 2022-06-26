<?php

namespace App\Http\Controllers\API;

use App\Models\Driver;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Father;
use App\Models\Child;
use App\Models\Trip;
use App\Http\Resources\DriverResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Events\adminNotification;
use App\Models\School;

class DriverController extends BaseController
{
    public function show()
    {
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::where('id',$id)->first();
        $school = School::find($driver->school_id);
        $driver->school_code = $school->code;
        return $this->sendResponse($driver,'driver information retrived successfully');
    }

    public function update(Request $request)
    {
        $id=Auth::guard('api-drivers')->id();
        $driver=driver::find($id);
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required','string', 'max:30',],
            'mobileNumber'=>['required',],
            'licenseNumber'=>['required',],
            'image_path'=>['required',],
            'email' => ['required','string', 'email', 'max:255',Rule::unique('drivers')->ignore($id),],

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $driver->name=$input['name'];
        $driver->email=$input['email'];
        $driver->mobileNumber=$input['mobileNumber'];
        $driver->licenseNumber=$input['licenseNumber'];
        $driver->image_path=$input['image_path'];
        $driver->confirmed=false;
        $driver->save();
        if($driver->trip_id==null){
            $driver->trip_id=-1;
            }
          //admin notification
          $admin=User::where('school_id',$driver->school_id)->where('is_admin',1)->first();
          $notification['id']=$admin->id;
          $notification['message']='driver:'.$driver->name."update his information";
          event(new adminNotification($notification));
        return $this-> sendResponse(new driverResource($driver),'driver information updated successfully');

    }
    public function count_childs(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::find($id);
        if ($driver->trip_id == Null){
            $response ['total_childern'] = 0;
            $response ['childern'] = 0;
            $response ['school_name'] = $driver->school->name;
            return $this->sendResponse('please validate errors',"you are not assigned to any trip");
        }
        $trip = Trip::find($driver->trip_id);
        $response ['total_childern'] = 0;
        $response ['childern'] = 0;
        $response ['school_name'] = $driver->school->name;
        if($trip->children()->get() != null){
            $response ['total_childern'] = $trip->children()->count();
        }

        if($fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get() != null){

            $fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get(); 
            foreach($fathers as $father)
            {
            $children=Child::where("father_id",$father->id)->where('status',1)->get();
            }
            $response ['childern'] = $children->count();

            // $response ['childern'] = $trip->children()->where('status',1)->count();
        }; 

        return $this->sendResponse($response,'childern count retrived successfully');

    }


    public function destroy()
    {
        $id=Auth::guard('api-drivers')->id();
       $driver=Driver::find($id);
        //admin notification
        $admin=User::where('school_id',$driver->school_id)->where('is_admin',1)->first();
        $notification['id']=$admin->id;
        $notification['message']='driver:'.$driver->name."update his information";
        event(new adminNotification($notification));
        $driver->delete();
        return $this-> sendResponse("you are logged out",'Account deleted successfully');
    }
}
