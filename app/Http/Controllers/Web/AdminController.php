<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::latest();
        return view("admin.index",compact("admin"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view("admin.edit",compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $users)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('drivers')->ignore($users->id)],
            'school_id' => ['required', 'string', 'max:25' ],
            // 'image_path'=>'image'
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        // $newPhotoName=time() . '-' . $users->name  .'.' .  $users->image->extension();
        // $users->image->move(public_path('upload\admin'),$newPhotoName);
        $users->name=$input['name'];
        $users->email=$input['email'];
        $users->school_id=$input['school_id'];
        $users->password=$input['password'];
        // $users->image_path= $newPhotoName;
        $users->save();
        return redirect()->route("admin.index")->with('success','admin updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
