<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class DriverController extends Controller
{

    public function index()
    {
        // $admin=Auth::user();
        // if($admin->school_id==null){
        //     return view("school.create");
        // }
        // $driver = Driver::where("school_id",$admin)->latest()->paginate(5);
        $driver = Driver::latest()->paginate(7);
        return view("driver.index",compact("driver"));
    }


    public function create()
    {
        return view("driver.create");
    }

    public function store(Request $data)
    {
        $admin=Auth::user();
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'licenseNumber' => ['required', 'string', 'max:25' , 'min:5'],
            'confirmed' => ['required', 'int', 'max:20'],
            'trip_id' => ['required', 'int', 'max:20'],
            'school_id' => ['required', 'int', 'max:20'],
            'mobileNumber' => ['required', 'string', 'max:20'],
            'image'=>'image'
        ]);
        if ($data->image == Null){
            Driver::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'licenseNumber' => $data['licenseNumber'],
                'confirmed' => $data['confirmed'],
                'mobileNumber' => $data['mobileNumber'],
                'trip_id' => $data['trip_id'],
                'school_id' => $data['school_id'],
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
            'confirmed' => $data['confirmed'],
            'mobileNumber' => $data['mobileNumber'],
            'trip_id' => $data['trip_id'],
            'school_id' => $data['school_id'],
            'image_path' => $newPhotoName
        ]);

        return redirect()->route("driver.index")
        ->with('success','driver added successfuly');
    }

    public function show(Driver $driver)
    {
        return view("driver.show",compact('driver'));
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
            'password' => ['required', 'string', 'min:8'],
            'licenseNumber' => ['required', 'string', 'max:25' , 'min:5'],
            'confirmed' => ['required', 'int', 'max:20'],
            'trip_id' => ['required', 'int', 'max:20'],
            'school_id' => ['required', 'int', 'max:20'],
            'mobileNumber' => ['required', 'string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $driver->name=$input['name'];
        $driver->email=$input['email'];
        $driver->password=Hash::make($input['password']);
        $driver->mobileNumber=$input['mobileNumber'];
        $driver->licenseNumber=$input['licenseNumber'];
        $driver->confirmed=$input['confirmed'];
        $driver->trip_id=$input['trip_id'];
        $driver->school_id=$input['school_id'];
        $driver->save();
        return redirect()->route("driver.index")->with('success','driver updated successfuly');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route("driver.index")->with('success','driver deleted successfuly');
    }
}
