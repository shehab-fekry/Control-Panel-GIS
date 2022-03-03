<?php

namespace App\Http\Controllers\API;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\ChildResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Father;


class ChildController extends BaseController
{

    public function index()
    {
        $id=Auth::guard('api-fathers')->id();
        $id=Auth::id();
        $children=Child::where("father_id",$id)->where("confirmed",true)->get();
        $count=Child::where("father_id",$id)->where("confirmed",false)->count();
        $input=$children->all();
        if(empty($input)){
            return $this->sendError('please validate errors',"you have ".$count." chidrens waiting to confirm from admin you are not have any childrens confirmed yet");
        }
        else
        {
            return $this-> sendResponse(ChildResource::collection($input),'you have '.$count.' chidrens waiting to confirm from admin');
        }
    }
    public function store(Request $request)
    {
        $id=Auth::guard('api-fathers')->id();
        $father=Father::find($id);
        $input=$request->all();
        $validator= Validator::make($input, [
            'name' => ['required', 'string', 'max:30'],
            'photo'=>['required|image']
        ]);
        $photo=$request->photo;//file
        $new_photo=time().$photo->getClientOriginalName();//string
        $photo->move('uploads/children/',$new_photo);
        $input['photo']="uploads/children/".$new_photo;
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }elseif($father->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }
        $input['father_id']=$id;
        $child=Child::create($input);
        $child->get();
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

        ]);
        if($validator->fails()){
            return $this->sendError('please validate errors',$validator->errors());
        }
        $child->name=$input['name'];
        $child->save();
        return $this-> sendResponse(new ChildResource($child),'child information updated successfully');
    }

    public function updateChildStatus($id){
        $fid=Auth::guard('api-fathers')->id();
        $father=Father::find($fid);
        $child=Child::get()->find($id);
        if($father->confirmed==false){
            return $this->sendError('please validate errors','your account do not confirmed yet please contact with one of school admins');

        }elseif($child->confirmed==false){
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
