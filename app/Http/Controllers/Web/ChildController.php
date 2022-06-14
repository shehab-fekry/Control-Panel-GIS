<?php

namespace App\Http\Controllers\Web;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChildController extends Controller
{

    public function index($id)
    {
        $child  = Child::where('father_id',$id)->latest()->paginate(7);
        return view("child.index",compact("child"));
    }


    public function create()
    {
        return view("child.create");
    }



    public function store(Request  $data)
    {
        $admin=Auth::user();

        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'email', 'max:255', 'unique:children'],
            'father_id' => ['required', 'string', 'max:20'],
            'photo'=>['required|image']
        ]);
        $photo=$data->photo;//file
        $new_photo=time().$photo->getClientOriginalName();//string
        $photo->move('uploads/children/',$new_photo);

        Child::create([
            'name' => $data['name'],
            'status' => $data['status'],
            'father_id' => $data['father_id'],
            'photo'=>"uploads/children/".$new_photo,
            'school_id'=>$admin->school_id
        ]);

        return redirect()->route("child.index")
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
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'father_id' => ['required', 'int'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $child->name=$input['name'];
        $child->status=$input['status'];
        $child->father_id=$input['father_id'];
        $child->save();
        return redirect()->route("child.index")->with('success','child updated successfuly');
    }

    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route("child.index")->with('success','child deleted successfuly');
    }
}
