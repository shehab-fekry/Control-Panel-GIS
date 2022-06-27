<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Father;
use App\Models\School;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;


class FatherController extends Controller
{

    public function index()
    {
        $admin=Auth::user()->school_id;

        if($admin ==null){
            return redirect()->route('school.index');
        }
        $fathers = Father::where("school_id",$admin)->latest()->paginate(6);
        return view("Father.index",compact("fathers"));
    }


    public function create()
    {
        $admin=Auth::user()->school_id;

        if($admin ==null){
            return redirect()->route('school.index');
        }
        return view("Father.create");
    }

    public function store(Request  $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:fathers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobileNumber' => ['required', 'string', 'max:20'],
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->all());
        }

        Father::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobileNumber' => $request->input('mobileNumber'),
            'school_id' => Auth::user()->school_id,
            'image_path' => 'https://cdn-icons-png.flaticon.com/512/3048/3048148.png'
        ]);

        return redirect()->route("father.index")
        ->with('success','Father added successfuly');


    }


    public function show(Father $father)
    {
        $childs=Child::get();
        $admin1=Auth::user();
        $trips=Trip::where("school_id",$admin1->school_id)->get(); //get all trips of the school
        return view("Father.show",compact('father'))->with('childs',$childs)->with('trips' ,$trips);
    }
    public function edit(Father $father)
    {
        $admin=Auth::user();
        $trips=Trip::where("school_id",$admin->school_id)->get();
        return view("Father.edit",compact('father'))->with('trips',$trips);
    }

public function update(Request $request, Father $father)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string','min:4','max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('fathers')->ignore($father->id)],
            'mobileNumber' => ['required', 'string', 'max:25' , 'min:5'],
            'trip_id' => ['int'],
            'confirmed' => [ 'string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->all());
        }

        $father->name=$input['name'];
        $father->confirmed=$input['confirmed'];
        $father->email=$input['email'];
        $father->trip_id=$input['trip_id'];
        $father->mobileNumber=$input['mobileNumber'];
        $father->save();
        return redirect()->route("father.index")->with('success','father updated successfuly');
    }
    public function AssignFatherToTrip(Request $request, Father $father){
        $father->trip_id=$request->trip_id;
        $father->save();
        return redirect()->route("father.index")->with('success','father assigned to trip successfuly');
    }
    public function passwordReset(Request $request)
    {
        $father = Father::find($request->fid);
        $input=$request->all();
        $validator=Validator::make($input,[
            'password' => ['required', 'string', 'min:8','confirmed'],
            // 'password' => ['required', 'string', 'min:8','confirmed',Password::min(8)->mixedCase()->numbers()],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $father->password=Hash::make($request->password);
        $father->save();
        return redirect()->route("father.index")->with('success',"father password updated successfuly");
    }

    public function changeStatus(Request $request  )
    {
        $child = Child::find($request->mid);
        $child->confirmed = $request->confirmed;
        $child->save();
        return response()->json(['success'=>'Status change successfully.']);
    }




    public function destroy(Father $father)
    {
        $School = School::first();
        $School->children()->delete();

        $father->delete();
        return redirect()->route("father.index")->with('success','father deleted successfuly');
    }
    public function changeFatherStatus(Request $request )
    {
        $father = Father::find($request->mid);
        $father->confirmed = $request->confirmed;
        $father->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
