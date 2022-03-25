<?php
namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\driver;
use App\Models\father;
use App\Models\child;
use App\Models\vehicle;
use Illuminate\Validation\Rule;

use App\Models\School;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $admin=Auth::user()->school_id;
        return view('home')
        ->with('countdriver',  Driver::where("school_id",$admin)->count())
        ->with('countfather',  father::where("school_id",$admin)->count())
        ->with('countchild',   child::count())
        ->with('countvehicle', vehicle::where("school_id",$admin)->count());
    }
    public function profileUpdate(Request $request){
        $admin=Auth::user();
        //validation rules
        $input=$request->all(); 
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
            'school_id' => ['required', 'string', 'max:25' ],
            'image_path'=>'image'
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        if ($request->image_path == Null){
        $admin->name=$input['name'];
        $admin->email=$input['email']; 
        $admin->school_id=$input['school_id'];
        $admin->save();
        return redirect()->route("admin.index")->with('success','admin updated successfuly');
        }
     else
        // dd($request->image_path);
        $newPhotoName=time() . '-' . $request->name  .'.' .  $request->image_path->extension();
        $request->image_path->move(public_path('upload\admin'),$newPhotoName);
        $admin->name=$input['name'];
        $admin->email=$input['email']; 
        $admin->school_id=$input['school_id'];
        $admin->image_path= $newPhotoName;
        $admin->save();
        return redirect()->route("admin.index")->with('success','admin updated successfuly');
    }


}
