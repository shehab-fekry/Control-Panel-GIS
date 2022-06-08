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
        $driver=driver::get()->find($id);

        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required','string', 'max:30',],
            'mobileNumber'=>['required',],
            'licenseNumber'=>['required',],
            'email' => ['required','string', 'email', 'max:255',Rule::unique('drivers')->ignore($id),],

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $driver->name=$input['name'];
        $driver->email=$input['email'];
        $driver->mobileNumber=$input['mobileNumber'];
        $driver->licenseNumber=$input['licenseNumber'];
        $driver->save();



        return $this-> sendResponse(new driverResource($driver),'driver information updated successfully');

    }

    public function destroy(Driver $driver)
    {
        $id=Auth::guard('api-drivers')->id();
       Driver::find($id)->delete();

        return $this-> sendResponse("you are logged out",'Account deleted successfully');
    }
}
