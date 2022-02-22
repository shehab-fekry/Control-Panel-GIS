<?php


namespace App\Http\Controllers\API;

use App\Models\Father;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FatherAuthController extends BaseController
{

    public function register(request $request){
        $input=$request->all();

        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:fathers'],
            'password' => ['required', 'string', 'min:8'],
            'mobileNumber'=>['required'],
            'region' => ['required', 'string'],
            'lng' => ['required'],
            'lit' => ['required'],

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
    public function login(Request $request){

        if(Auth()->guard('father')->attempt(['email'=>$request->email,'password'=>$request->password])){
            config(['auth.guards.api.provider' => 'fathers']);


            $father =Auth::guard('father')->user();

            $success['token']=Auth::guard('father')->user()->createToken('ahmed')->accessToken;

            $success['name']=$father->name;
            return $this-> sendResponse($success,'father login successfully');
        }
        else{
            return $this->sendError('please check your auth',['error'=>'unauthorized']);
        }
    }

}
