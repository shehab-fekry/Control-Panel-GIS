<?php

namespace App\Http\Controllers\API;
use App\Events\adminNotification;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\ChildResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Father;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ChildController extends BaseController
{

    public function index()
    {
        $id=Auth::guard('api-fathers')->id();
        // $father=Father::find($id);
        // // $father=Father::find($id)->withCount([ 'child' => function (Builder $query) {
        // //     $query->where('confirmed',false);
        // // }])->get();
         $children=Child::where("father_id",$id)->get();

         $input=$children->all();
        // if(empty($input)){
        //     return $this->sendError('please validate errors',"yhhou have".$father[0]->children_count." chidrens waiting to confirm from admin you are not have any childrens confirmed yet");
        // }
          if(empty($input)){
             return $this->sendError('please validate errors',"you are not have any childrens confirmed yet");
         }
        else
        {
            return $this-> sendResponse(ChildResource::collection($input),'chilrens information retrived successfully');
        }
    }
    public function store(Request $request)
    {
        $id=Auth::guard('api-fathers')->id();
        $father=Father::find($id);
        $input=$request->all();
        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:30'],
            'gender' => ['required', 'string'],
            'class' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'image_path'=>['required']
        ]);
        // $photo=$request->photo;//file
        // $new_photo=time().$photo->getClientOriginalName();//string
        // $photo->move('uploads/children/',$new_photo);
        // $input['photo']="uploads/children/".$new_photo;
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }elseif($father->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }
        $input['father_id']=$id;
        $child=Child::create($input);
        $child->get();
        // admin notification
        $admin_id= User::where("school_id",$father->school_id)->where("is_admin",1)->first();
        $message="Father:".$father->name ." added new child ".$child->name." to his childrens";
        $data=array(
            'message'=>$message,
            'id'=>$admin_id
        );
        event(new adminNotification($data));
        return $this->sendResponse($child,'child added successfully');
    }
    public function show($id)
    {
        $fid=Auth::guard('api-fathers')->id();
        $child=Child::find($id);
        if(is_null($child)){//is_null()
            return $this->sendError('child not exists');

        }elseif($child->father_id!==$fid){
            return $this->sendError('please validate errors',"you are not authorized to do this action");
        }
         return $this->sendResponse(new childResource($child),'child retrived successfully');


    }


    public function update(Request $request,$id)
    {
        $child=Child::get()->find($id);

        if(Auth::guard('api-fathers')->id()!==$child->father_id){
        return $this->sendError('please validate errors',"you are not authorized to do this action");
        }
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required',
            'gender' => ['required', 'string'],
            'class' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'image_path' => ['required'],


        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $child->name=$input['name'];
        $child->gender=$input['gender'];
        $child->class=$input['class'];
        $child->age=$input['age'];
        $child->image_path=$input['image_path'];
        $child->save();
        return $this-> sendResponse(new ChildResource($child),'child information updated successfully');
    }

    public function updateChildStatus($id){
        $fid=Auth::guard('api-fathers')->id();
        $father=Father::find($fid);
        $child=Child::get()->find($id);
        if($father->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($child->confirmed==0){
            return $this->sendError('please validate errors','your child do not confirmed yet please contact with one of school admins');
        }
        elseif($father->trip_id==null){


            return $this->sendError('please validate errors','your account  not assigned to trip yet please contact with one of school admins');
        }elseif(Auth::guard('api-fathers')->id()!==$child->father_id){
            return $this->sendError('please validate errors',"you are not authorized to do this action");
        }elseif($child->status==false){

            $child->status=true;
            $father->status=$father->status+1;
            $child->save();
            $father->save();
            return $this-> sendResponse(new ChildResource($child),'child status updated to true successfully');
         }else{
            $child->status=false;
            $father->status=$father->status-1;
            $child->save();
            $father->save();
            return $this-> sendResponse(new ChildResource($child),'child status updated to false successfully');
         }
    }
    public function destroy($id)
    {
        $fid=Auth::guard('api-fathers')->id();
        $father=Father::find($fid);
        $child=Child::get()->find($id);
        if($fid!=$child->father_id){
            return $this->sendError('please validate errors',"you are not authorized to do this action");
        }
        if($child->status==true){
            $father->status=$father->status-1;
            $father->save();
        }
        $child->delete();
        return $this-> sendResponse(new ChildResource($child),'child information deleted successfully');
    }
}
