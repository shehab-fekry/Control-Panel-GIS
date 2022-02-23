<?php


namespace App\Http\Controllers\API;

use App\Models\Father;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends BaseController
{

    public function fatherRegister(request $request){
        $input=$request->all();

        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','u'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'mobileNumber'=>['required'],
            'region' => ['required', 'string'],
            'lng' => ['required','numeric'],
            'lit' => ['required','numeric'],

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }

        $input['password']=Hash::make($input['password']);
        $father=Father::create($input);
        $token=$father->createToken('PassportExample@Section.io')->accessToken;;
        $success['name']=$father->name;
        return $this-> sendResponse($token,'father registered successfully');
    }
    public function fatherLogin(Request $request){

        if(Auth()->guard('father')->attempt(['email'=>$request->email,'password'=>$request->password])){
            config(['auth.guards.api.provider' => 'api-fathers']);


            $father =Auth::guard('father')->user();

            $success['token']=$father->createToken('ahmed')->accessToken;

            $success['name']=$father->name;
            return $this-> sendResponse($success,'father login successfully');
        }
        else{
            return $this->sendError('please check your auth',['error'=>'unauthorized']);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    public function driverRegister(request $request){
        $input=$request->all();
       // 'email','name','password','licenseNumber','confirmed','mobileNumber'
        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users',],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'mobileNumber'=>['required'],
            'licenseNumber' => ['required'],

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }

        $input['password']=Hash::make($input['password']);
        $driver=Driver::create($input);
        $token=$driver->createToken('PassportExample@Section.io')->accessToken;;
        $success['name']=$driver->name;
        return $this-> sendResponse($token,'driver registered successfully');
    }
    public function driverLogin(Request $request){

        if(Auth()->guard('driver')->attempt(['email'=>$request->email,'password'=>$request->password])){
            config(['auth.guards.api.provider' => 'drivers']);


            $driver =Auth::guard('driver')->user();

            $success['token']=Auth::guard('driver')->user()->createToken('ahmed')->accessToken;

            $success['name']=$driver->name;
            return $this-> sendResponse($success,'driver login successfully');
        }
        else{
            return $this->sendError('please check your auth',['error'=>'unauthorized']);
        }
    }


}
