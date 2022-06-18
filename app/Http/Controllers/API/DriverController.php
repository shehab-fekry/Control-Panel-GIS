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
class DriverController extends BaseController
{
    public function show()
    {
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::where('id',$id)->get();
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
