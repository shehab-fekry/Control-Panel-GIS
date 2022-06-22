<?php
namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Father;
use App\Models\Child;
use App\Models\vehicle;
use Illuminate\Validation\Rule;
use App\Models\School;
use App\Models\Trip;
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
        // $School->children();
        // $fathers =father::where("school_id",$admin)->first() ; 
        // if ($admin == NULL) {
        //     $father = 0 ; 
        // } else {
        //     $father =$fathers->id ;  
        // }

        $admin1=Auth::user();
        if ($admin == NULL) {
            $School = 0;
            $childgoing = 0;
            $childnotgoing = 0;
        } else {
            $School = $admin1->school()->withCount([ 'children' ])->first()->children_count;    
            $childgoing  = Father::where("school_id",$admin)->sum('status');
            $childnotgoing = $School - $childgoing;
        }


        return view('home')
        ->with('countdriver',  Driver::where("school_id",$admin)->count())
        ->with('countfather',  Father::where("school_id",$admin)->count())
        ->with('childgoing',  $childgoing)
        ->with('childnotgoing',  $childnotgoing)
        ->with('countchild',  $School)
        ->with('countvehicle', vehicle::where("school_id",$admin)->count())
        ->with('tripstop', Trip::where('status',0)->where('school_id',$admin)->count())
        ->with('tripgs', Trip::where('status',1)->where('school_id',$admin)->count())
        ->with('triprs', Trip::where('status',2)->where('school_id',$admin)->count())
        ->with('triprb', Trip::where('status',3)->where('school_id',$admin)->count());
    }
    public function profileUpdate(Request $request){
        $admin=Auth::user();
        //validation rules 
        $input=$request->all(); 
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
            'school_id' => ['required', 'string', 'max:25' ],
        ]);
        // if the validation fails 
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        // update the admin
        $admin->name=$input['name'];
        $admin->email=$input['email']; 
        $admin->school_id=$input['school_id'];
        $admin->save();
        return redirect()->route("admin.index")->with('success','admin updated successfuly');
}
}
