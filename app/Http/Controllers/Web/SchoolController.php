<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Father;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Trip;
use App\Models\User;
use App\Models\vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    public function assignAdminToSchool(request $data)
    { 
        $admin=Auth::user();
        $input=$data->all();
        $validator=Validator::make($input,[
            'code' => ['required', 'string','exists:schools,code'],
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $school=School::where("code",$data->code)->first();
        $admin->school_id=$school->id;
        $admin->save();
        return redirect()->route("home")->with('success','school joined successfuly');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=Auth::user();
        $school=School::where('id',$admin->school_id)->first();

        return view("school.index",compact('school','admin'));
          $admin=Auth::user();
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $admin=Auth::user();
        // generate code for school
        $code = Str::random(3) .substr( time() , 6, 9);
        $input=$data->all();
        // validation for the input data
        $validator=Validator::make($input,[
            'name' => ['required', 'string',  'max:255'],
            'location' => ['required', 'string'],
        ]);
        // if the validation fails
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        // create the school
        $school= School::create([
            'code' => $code,
            'name' => $data['name'] ,
            $location= explode (",", $data['location'])  ,
            'lng' =>$location[1],
            'lit' =>$location[0],
        ]);
        $admin->school_id = $school->id ;
        $admin-> save();
        // redirect to the school page
        return redirect()->route("home")->with([
            'success'=>'school added successfuly',
            'code'=>'Your school code is ' . $code
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $admin=Auth::user();
        if($admin->school_id==null){
            return view("school.index");
        }
        $school=School::where('id',$admin->school_id);
        return view("school.index",compact('school'));
    }
    public function showLocation($id)
    {
        // $admin=Auth::user();
        // $admin=Auth::user();
        // if($admin->school_id==null){
        //     return view("school.index");
        // }
        $school=School::where('id',$id)->first();
        $location=[$school->lng,$school->lit];
        return Basecontroller::sendResponse($location,'school location');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $School)
    {
        $admin=Auth::user();
        $input=$request->all();
        $validator=Validator::make($input,[
            'code' => ['required', 'string','exists:schools,code'],
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        $School->code=$input['code'];
        // $school=School::where("code",$School->code);
        // $admin->school_id=$school->id;
        $School->save();
        return redirect()->route("school.index")->with('success','school updated successfuly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $School)
    {
        $admin=Auth::user();
        // delete the school children
        $School->children()->delete();
        // delete the school fathers
        $father = Father::where('school_id', $School->id);
        $father->delete();
        // delete the school drivers
        $driver = Driver::where('school_id',$School->id);
        $driver->delete();
        // delete the school vehicles
        $vehicle = vehicle::where('school_id',$School->id);
        $vehicle->delete();
        // delete the school trips
        $Trip = Trip::where('school_id',$School->id);
        $Trip->delete();
        // delete the school
        $School->delete();
        // delete the school from the admin
        $admin->school_id = NULL;
        $admin->save();
        return redirect()->route("school.index")->with('success','school deleted successfuly');
    }

    public function left()
    {
        $admin=Auth::user();

        $admin->school_id = NULL;
        
        $admin->save();
        return redirect()->route("school.index")->with('success','school Left successfuly');
    }
}
