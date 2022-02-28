<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $vehicle = vehicle::latest()->paginate(7);
        return view("vehicle.index",compact("vehicle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("vehicle.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'licensePlate' => ['required', 'string', 'max:10', 'unique:vehicles'],
            'model' => ['string', 'max:20'],
            'driver_id' => ['string', 'max:20'],
            'color' => ['string', 'max:20'],
        ]);
        vehicle::create([
            'licensePlate' => $request['licensePlate'],
            'model' => $request['model'],
            'driver_id' => $request['driver_id'],
            'color' => $request['color'],
        ]);

        return redirect()->route("vehicle.index")
        ->with('success','vehicle added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(vehicle $vehicle)
    {
        return view("vehicle.show",compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(vehicle $vehicle)
    {
        return view("vehicle.edit",compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vehicle $vehicle)
    {
        $vehicle->update($request->all());
        return redirect()->route("vehicle.index")->with('success','vehicle updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route("vehicle.index")->with('success','vehicle deleted successfuly');
    }
}
