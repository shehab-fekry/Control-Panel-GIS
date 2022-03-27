<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Father;
use App\Models\driver;
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
        return redirect()->route("school.index")->with('success','school created successfuly');
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
        $code = Str::random(3) .substr( time() , 6, 9);
        $input=$data->all();
        $validator=Validator::make($input,[
            // 'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string',  'max:255'],
            'location' => ['required', 'string'],
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        $school= School::create([
            // 'code' => $data['code'],
            'code' => $code,
            'name' => $data['name'] ,
            // 'lng' =>  $data['location'] ,
            $location= explode (",", $data['location'])  ,
            'lng' =>$location[1],
            'lit' =>$location[0],
        ]);
        $admin->school_id = $school->id ;
        $admin-> save();

        // $school=School::where('id',$admin->school_id);
        // return view("school.index",compact('school'))->with('success','driver added successfuly');
        return redirect()->route("school.index")->with([
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
        return view("school.show",compact('school'));
    }
    public function showLocation()
    {
        $admin=Auth::user();
        if($admin->school_id==null){
            return view("school.index");
        }
        $school=School::where('id',$admin->school_id);
        $location=[$school->lit,$school->lon];
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

        $School->children()->delete();

        $father = Father::where('school_id', $School->id);
        $father->delete();

        $driver = driver::where('school_id',$School->id);
        $driver->delete();

        $vehicle = vehicle::where('school_id',$School->id);
        $vehicle->delete();

        $Trip = Trip::where('school_id',$School->id);
        $Trip->delete();

        $School->delete();

        $admin->school_id = NULL;
        
        $admin->save();
        return redirect()->route("school.index")->with('success','school deleted successfuly');
    }
}
