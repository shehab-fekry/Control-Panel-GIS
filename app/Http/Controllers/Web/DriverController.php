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
            return view("school.index");
        }
        $driver = Driver::where("school_id",$admin)->latest()->paginate(5);
      
        return view("driver.index",compact("driver"));
    }

    public function create()
    {
        $admin=Auth::user()->school_id;
        
        if($admin ==null){
            return view("school.index");
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
            // 'confirmed' => ['required', 'int', 'max:20'],
            // 'trip_id' => ['required', 'int', 'max:20'],
            // 'school_id' => ['required', 'int', 'max:20'],
            'mobileNumber' => ['required', 'string', 'max:20'],
            'image'=>'image'
        ]);
        
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }



    //     $admin=Auth::user();
    //     $data->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'licenseNumber' => ['required', 'string', 'max:25' , 'min:5'],
    //         // 'confirmed' => ['required', 'int', 'max:20'],
    //         // 'trip_id' => ['required', 'int', 'max:20'],
    //         // 'school_id' => ['required', 'int', 'max:20'],
    //         'mobileNumber' => ['required', 'string', 'max:20'],
    //         'image'=>'image'
    //     ]);

        if ($data->image == Null){
            Driver::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'licenseNumber' => $data['licenseNumber'],
                // 'confirmed' => $data['confirmed'],
                'mobileNumber' => $data['mobileNumber'],
                // 'trip_id' => $data['trip_id'],
                'school_id' => Auth::user()->school_id,
                'image_path' => 'driver.png'

            ]);
            return redirect()->route("driver.index")
            ->with('success','driver added successfuly');
        }
     else
         $newPhotoName=time() . '-' . $data->name  .'.' .  $data->image->extension();
         $data->image->move(public_path('upload\driver'),$newPhotoName);
        Driver::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'licenseNumber' => $data['licenseNumber'],
            // 'confirmed' => $data['confirmed'],
            'mobileNumber' => $data['mobileNumber'],
            // 'trip_id' => $data['trip_id'],
            'school_id' =>  Auth::user()->school_id,
            'image_path' => $newPhotoName
        ]);

        return redirect()->route("driver.index")
        ->with('success','driver added successfuly');
    }

    public function show(Driver $driver)
    {
        $admin=Auth::user()->school_id;
        $school=School::where("id",$admin)->first();
        return view("driver.show",compact('driver'))->with('schools' ,$school);
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
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('drivers')->ignore($driver->id)],
            // 'password' => ['required', 'string', 'min:8'],
            'licenseNumber' => ['required', 'string', 'max:25' , 'min:5'],
            // 'confirmed' => ['required', 'int', 'max:20'],
            'trip_id' => ['required', 'int', 'max:20'],
            'school_id' => ['required', 'int', 'max:20'],
            'mobileNumber' => ['required', 'string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $driver->name=$input['name'];
        $driver->email=$input['email'];
        // $driver->password=Hash::make($input['password']);
        $driver->mobileNumber=$input['mobileNumber'];
        $driver->licenseNumber=$input['licenseNumber'];

        // $driver->confirmed=$input['confirmed'];

        $driver->trip_id=$input['trip_id'];
        $driver->school_id=$input['school_id'];
        $driver->save();
        return redirect()->route("driver.index")->with('success','driver updated successfuly');
    }
    public function AssignDriverToTrip(Request $request, Driver $driver){
        $driver->trip_id=$request->trip_id;
        $driver->save();
        return redirect()->route("driver.index")->with('success','driver assigned to trip successfuly');
    }
    public function passwordReset(Request $request, Driver $driver)
    {
        $input=$request->all();
        $validator=Validator::make($input,[

            'password' => ['required', 'string', 'min:8','confirmed','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],

        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $driver->password=Hash::make($request->password);
        $driver->save();
        return redirect()->route("driver.index")->with('success',"driver's password updated successfuly");
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route("driver.index")->with('success','driver deleted successfuly');
    }

}

