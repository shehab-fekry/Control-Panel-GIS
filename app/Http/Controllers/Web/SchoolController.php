<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    public function assignAdminToSchool(request $data)
    {
        $admin=Auth::user();
        $data->validate([
            'code'=>['required','string','exists:schools,code']
        ]);
        $school=School::where("code",$data->code);
        $admin->school_id=$school->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=Auth::user();
        // if($admin->school_id==null){
        //     return view("school.create");
        // }
        $school=School::where('id',$admin->school_id);
        return view("school.index",compact('school'));
        // /////////////////////////////////////////////////////////////////
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
        // if($admin->school_id==null){
        //     return view("school.create");
        // }
        // $school=School::where('id',$admin->school_id);
        // return view("school.index",compact('school'));
        // /////////////////////////////////////////////////////////////////
        $code = Str::random(3) .substr( time() , 6, 9);
        $input=$data->all();
        $validator=Validator::make($input,[
            // 'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string',  'max:255'],
        ]);
        
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
         School::create([
            // 'code' => $data['code'],
            'code' => $code,
            'name' => $data['name'] ,
            'lng' => '4565',
            'lit' => '44563',
        ]);

        // $school=School::where('id',$admin->school_id);
        // return view("school.index",compact('school'))->with('success','driver added successfuly');
        return view("school.index")->with('success','school added successfuly')
        ->with('code','Your code is ');
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
    public function update(Request $request, $id)
    {
        //
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
