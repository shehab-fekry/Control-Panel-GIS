<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{

    public function index()
    {

        $admin=Auth::user()->school_id;
        if($admin==null){
            return redirect()->route('school.index');
        }
        $vehicle = vehicle::where('school_id',$admin)->latest()->paginate(7);
        return view("vehicle.index",compact("vehicle"));
    }


    public function create()
    {
        $admin=Auth::user()->school_id;
        
        if($admin ==null){
            return redirect()->route('school.index');
        }
        
        $admin=Auth::user();
        $driver=Driver::where("school_id",$admin->school_id)->where("confirmed",1)->get();
        // $selectedID = 2;
        return view("vehicle.create")
        ->with('driver',$driver);
        
    }


    public function store(Request $request)
    {
        $admin=Auth::user();
        $input=$request->all();
        $validator=Validator::make($input,[
            'licensePlate' => ['required', 'string', 'max:10',Rule::unique('vehicles')],
            'model' => ['string', 'max:20'],
            'driver_id' => ['string', 'max:20',Rule::unique('vehicles')],
            'color' => ['string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->all());
        }       
        vehicle::create([
            'licensePlate' => $request['licensePlate'],
            'model' => $request['model'],
            'driver_id' => $request['driver_id'],
            'color' => $request['color'],
            'school_id' => $admin->school_id,
        ]);

        return redirect()->route("vehicle.index")
        ->with('success','vehicle added successfuly');
    }


    public function show(vehicle $vehicle)
    { 
        $driver=Driver::where("id",$vehicle->driver_id)->first();
        return view("vehicle.show",compact('vehicle'))->with('driver',$driver);
    }


    public function edit(vehicle $vehicle)
    {
        $admin=Auth::user(); 
        $driver=Driver::where("school_id",$admin->school_id)->get();
        return view("vehicle.edit",compact('vehicle'))->with('driver',$driver);
    }


    public function update(Request $request, vehicle $vehicle)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'licensePlate' => ['required', 'string', 'max:10',Rule::unique('vehicles')->ignore($vehicle->id)],
            'model' => ['string', 'max:20'],
            'driver_id' => ['string', 'max:20',Rule::unique('vehicles')->ignore($vehicle->id)],
            'color' => ['string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors()->all());
        }

        $vehicle->licensePlate=$input['licensePlate'];
        $vehicle->model=$input['model'];
        $vehicle->driver_id=$input['driver_id'];
        $vehicle->color=$input['color']; 
        $vehicle->save();
        return redirect()->route("vehicle.index")->with('success','vehicle updated successfuly');
    }

  
    public function destroy(vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route("vehicle.index")->with('success','vehicle deleted successfuly');
    }
}
