<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ChildController extends Controller
{
  
    public function index()
    {
       
        $child  = Child::latest()->paginate(7);
        return view("child.index",compact("child"));
    }


    public function create()
    {
        return view("child.create");
    }

   

    public function store(Request  $data)
    { 
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'email', 'max:255', 'unique:children'],
            'father_id' => ['required', 'string', 'max:20'],
        ]);
        Child::create([
            'name' => $data['name'],
            'status' => $data['status'],
            'father_id' => $data['father_id'],
        ]);

        return redirect()->route("father.child")
        ->with('success','child added successfuly');
    }

    public function show(Child $child)
    {
        return view("child.show",compact('child'));

    }

    public function edit(Child $child)
    {
        return view("child.edit",compact('child'));
    }


    public function update(Request $request, Child $child)
    {
        $child->update($request->all());
        return redirect()->route("child.index")->with('success','child updated successfuly');
    }

    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route("child.index")->with('success','child deleted successfuly');
    }
}
