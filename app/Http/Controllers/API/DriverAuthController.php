<?php


namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
//use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\personal_access_token;
class AuthController extends BaseController
{

    public function register(request $request){
        $input=$request->all();

        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8'],
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
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){


            $driver =Auth::driver();
            $success['token']=Auth::driver()->createToken('ahmed')->accessToken;

            $success['name']=$driver->name;
            return $this-> sendResponse($success,'driver login successfully');
        }
        else{
            return $this->sendError('please check your auth',['error'=>'unauthorized']);
        }
    }

}
