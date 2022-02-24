<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FatherController extends Controller
{

    public function index()
    {

        $father  = Father::latest()->paginate(7);
        return view("father.index",compact("father"));
    }


    public function create()
    {
        // return Father::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
        return view("father.create");
    }

    public function store(Request  $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'm_number' => ['required', 'string', 'max:20'],
            'trip_id' => ['required', 'int', 'max:20'],
            'status' => ['required', 'int', 'max:20'],
            'region' => ['string', 'max:20'],
            'lng' => ['string', 'max:20'],
            'lit' => ['string', 'max:20'],
        ]);
        Father::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobileNumber' => $data['m_number'],
            'trip_id' => $data['trip_id'],
            'status' => $data['status'],
            'region' => $data['region'],
            'lng' => $data['lng'],
            'lit' => $data['lit'],
        ]);

        return redirect()->route("father.index")
        ->with('success','Father added successfuly');

 
    }


    public function show(Father $father)
    {
        return view("father.show",compact('father'));
    }


    public function edit(Father $father)
    {
        return view("father.edit",compact('father'));
    }


    public function update(Request $request, Father $father)
    {
        $father->update($request->all());
        return redirect()->route("father.index")->with('success','father updated successfuly');
    }


    public function destroy(Father $father)
    {
        $father->delete();
        // $children=Child::where($father)->get();
        // if(count($children)>0){
        //   $children->delete();
        // }
        return redirect()->route("father.index")->with('success','father deleted successfuly');
    }
}
