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
use App\Models\School;
use App\Models\User;
Use App\Events\adminNotification;
class AuthController extends BaseController
{

    public function fatherRegister(request $request){
        $input=$request->all();
        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email',"unique:fathers"],
            'password' => ['required', 'string', 'min:8','confirmed'],//,'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'mobileNumber'=>['required','string','max:11','min:11'],
            'code'=>['required','string','exists:schools,code'],
            'region' => ['required', 'string'],
            'lng' => ['required','numeric'],
            'lit' => ['required','numeric'],
            //"photo"=>['required|image']
        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        // $photo=$request->photo;
        // $new_photo=time().$photo->getClientOriginalName();
        // $photo->move('uploads/fathers/',$new_photo);
        // $input['photo']=$new_photo;
        $school=School::where('code',$request->code)->first();
        $input['school_id']=$school->id;
        $input['image_path']="https://cdn-icons-png.flaticon.com/512/3048/3048148.png";
        $input['password']=Hash::make($input['password']);
        $father=Father::create($input);
        $success['father_name']=$father->name;
         //admin notification
         $admin=User::where('school_id',$father->school_id)->where('is_admin',1)->first();
         $notification['id']=$admin->id;
         $notification['message']='new parent account registered with name:'.$father->name;
         event(new adminNotification($notification));
        return $this-> sendResponse($success,'father registered successfully');
    }
    public function fatherLogin(Request $request){

        if(Auth()->guard('father')->attempt(['email'=>$request->email,'password'=>$request->password])){
            config(['auth.guards.api.provider' => 'api-fathers']);

            $id =Auth::guard('father')->id();
            $father=Father::find($id);
            $success['token']=$father->createToken('ahmed')->accessToken;
            $father->api_token=$success['token'];
            $father->save();
            if($father->trip_id==null){
                $father->trip_id=-1;
            }
            $success['father']=$father;
            $school=$father->school()->first();
            $success['schoolName']=$school->name;
            return $this-> sendResponse($success,'father login successfully');
        }
        else{
            return $this->sendError('please check your auth',['error'=>'unauthorized']);
        }
    }
    public function fatherLogout(){
        $id=Auth::guard('api-fathers')->id();
        $father=Father::get()->find($id);
        $father->api_token=null;
        $father->save();
        return $this-> sendResponse('success','father logout successfully');

    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    public function driverRegister(request $request){
        $input=$request->all();
       // 'email','name','password','licenseNumber','confirmed','mobileNumber'
        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255','unique:drivers',],
              'code'=>['required','string','exists:schools,code'],
             'password' => ['required', 'string', 'min:8','confirmed'],
            //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'mobileNumber'=>['required','min:11','max:11'],
            'licenseNumber' => ['required','string',"unique:drivers,licenseNumber"],


        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $school=School::where('code',$request->code)->first();
         $input['image_path']="https://cdn-icons-png.flaticon.com/512/3048/3048148.png";
         $input['school_id']=$school->id;
        // $photo=$request->photo;
        // $new_photo=time().$photo->getClientOriginalName();
        // $photo->move('uploads/drivers/',$new_photo);
        // $input['photo']=$new_photo;
        $input['password']=Hash::make($input['password']);
        $driver=Driver::create($input);
        // $token=$driver->createToken('PassportExample@Section.io')->accessToken;;
        $success['driver_name']=$driver->name;
        $success['SchoolName']=$school->name;
         //admin notification
         $admin=User::where('school_id',$driver->school_id)->where('is_admin',1)->first();
         $notification['id']=$admin->id;
         $notification['message']='new driver account registered with name:'.$driver->name;
         event(new adminNotification($notification));
        return $this-> sendResponse($success,'driver registered successfully');
    }
    public function driverLogin(Request $request){

        if(Auth()->guard('driver')->attempt(['email'=>$request->email,'password'=>$request->password])){
            config(['auth.guards.api.provider' => 'api-drivers']);
            $id =Auth::guard('driver')->id();
            $driver=Driver::find($id);
            $success['token']=$driver->createToken('driver')->accessToken;

            $driver->api_token=$success['token'];
            $driver->save();
            if($driver->trip_id==null){
                $driver->trip_id=-1;
            }
            $success['driver']=$driver;
            return $this-> sendResponse($success,'driver login successfully');
        }
        else
        {
            return $this->sendError('please check your auth',['error'=>'unauthorized']);
        }
    }
    public function driverLogout(){
        $id=Auth::guard('api-drivers')->id();
        $driver=Driver::get()->find($id);
        $driver->api_token=null;
        $driver->save();
        return $this-> sendResponse('success','driver logout successfully');

    }


}
