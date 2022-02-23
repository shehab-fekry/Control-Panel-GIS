<?php

namespace App\Http\Controllers\API;

use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FatherResource;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class FatherController extends BaseController
{


    public function show()
    {

        $id=Auth::guard("api-fathers")->id();
        $father=Father::where("id",$id)->get();


        return $this->sendResponse(FatherResource::collection($father),'fathers retrived successfully');


    }



    public function update(Request $request,)
    {
        $id=Auth::guard('api-fathers')->id();
        $father=Father::get()->find($id);

        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required','string', 'max:30',],
            'mobileNumber'=>['required',],
            'region' => ['required','string',],
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
        $father->lng=$input['lng'];
        $father->lit=$input['lit'];
        $father->save();



        return $this-> sendResponse(new fatherResource($father),'father information updated successfully');}


    public function destroy()
    {


    }
}
