<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Driver;
use App\Models\School;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class DriverController extends Controller
{

    public function index()
    {
        $admin=Auth::user()->school_id;

        if($admin ==null){
            return redirect()->route('school.index');

        }
        $driver = Driver::where("school_id",$admin)->latest()->paginate(6);

        return view("driver.index",compact("driver"));
    }

    public function create()
    {
        $admin=Auth::user()->school_id;

        if($admin ==null){
            return redirect()->route('school.index');
        }
        return view("driver.create");
    }
    public function store(Request $data)
    {

        $input=$data->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'licenseNumber' => ['required', 'string', 'max:25' , 'min:5' , 'unique:drivers'],
            'mobileNumber' => ['required', 'string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->all());
        }
        Driver::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'licenseNumber' => $data['licenseNumber'],
            'mobileNumber' => $data['mobileNumber'],
            'school_id' =>  Auth::user()->school_id,
            'image_path' => "https://cdn-icons-png.flaticon.com/512/3048/3048148.png"
        ]);

        return redirect()->route("driver.index")
        ->with('success','driver added successfuly');
    }

    public function show(Driver $driver)
    {
        $admin=Auth::user()->school_id;
        $school=School::where("id",$admin)->first();
        $admin1=Auth::user();
        $trips=Trip::where("school_id",$admin1->school_id)->get(); //get all trips of the school
        return view("driver.show",compact('driver'))->with('schools' ,$school)->with('trips' ,$trips);
    }


    public function edit(Driver $driver)
    {
        $admin=Auth::user();
        $trips=Trip::where("school_id",$admin->school_id)->get();
        return view("driver.edit",compact('driver'))->with('trips',$trips);
    }
    public function update(Request $request, Driver $driver)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('drivers')->ignore($driver->id)],
            'licenseNumber' => ['required', 'string', 'max:25' , 'min:5',Rule::unique('drivers')->ignore($driver->id)],
            'confirmed' => ['required', 'int', 'max:20'],
            'trip_id' => ['required', 'int',Rule::unique('drivers')->ignore($driver->id)],
            'mobileNumber' => ['required', 'string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->all());
        }
        $driver->name=$input['name'];
        $driver->email=$input['email'];
        $driver->mobileNumber=$input['mobileNumber'];
        $driver->licenseNumber=$input['licenseNumber'];
        $driver->confirmed=$input['confirmed'];
        $driver->trip_id=$input['trip_id'];
        $driver->save();
        return redirect()->route("driver.index")->with('success','driver updated successfuly');
    }
    public function AssignDriverToTrip(Request $request, Driver $driver){
        $driver->trip_id=$request->trip_id;
        $driver->save();
        return redirect()->route("driver.index")->with('success','driver assigned to trip successfuly');
    }
   public function DriverpasswordReset(Request $request)
    {
        $Driver = Driver::find($request->did);
        $input=$request->all();
        $validator=Validator::make($input,[
            'password' => ['required', 'string', 'min:8','confirmed'],
            // 'password' => ['required', 'string', 'min:8','confirmed',Password::min(8)->mixedCase()->numbers()],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $Driver->password=Hash::make($request->password);
        $Driver->save();
        return redirect()->route("driver.index")->with('success',"driver password updated successfuly");
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route("driver.index")->with('success','driver deleted successfuly');
    }

    public function changeDriverStatus(Request $request )
    {
        $driver = Driver::find($request->mid);
        $driver->confirmed = $request->confirmed;
        $driver->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

}

