<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function index()
    {
        $driver  = Driver::latest()->paginate(7);
        return view("driver.index",compact("driver"));
    }

 
    public function create()
    {
        return view("driver.create");
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'licenseNumber' => ['required', 'string', 'max:25' , 'min:5'],
            'confirmed' => ['required', 'int', 'max:20'],
            'mobileNumber' => ['required', 'string', 'max:20'],
        ]);
        Driver::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'licenseNumber' => $data['licenseNumber'],
            'confirmed' => $data['confirmed'],
            'mobileNumber' => $data['mobileNumber'],
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
        return view("driver.edit",compact('driver'));
    }
  
    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());
        return redirect()->route("driver.index")->with('success','driver updated successfuly');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route("driver.index")->with('success','driver deleted successfuly');
    }
}
