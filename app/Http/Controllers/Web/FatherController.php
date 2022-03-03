<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class FatherController extends Controller
{

    public function index()
    {

        $father  = Father::latest()->paginate(7);
        return view("father.index",compact("father"));
    }


    public function create()
    {
        return view("father.create");
    }

    public function store(Request  $data)
    {

       $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:fathers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'm_number' => ['required', 'string', 'max:20'],
            'trip_id' => ['required', 'int', 'max:20'],
            'status' => ['required', 'int', 'max:20'],
            'region' => ['string', 'max:20'],
            'lng' => ['string', 'max:20'],
            'lit' => ['string', 'max:20'],
            'photo'=>'required|image'
        ]);


        $photo=$data->photo;//file
        $new_photo=time().$photo->getClientOriginalName();//string
        $photo->move('uploads/fathers/',$new_photo);
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
            'photo'=>'uploads/fathers/'.$new_photo
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
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('fathers')->ignore($father->id)],
            'password' => ['required', 'string', 'min:8'],
            'mobileNumber' => ['required', 'string', 'max:25' , 'min:5'],
            'trip_id' => ['int', 'max:20'],
            'status' => [ 'string', 'max:20'],
            'region' => ['string', 'max:20'],
            'lng' => [ 'string', 'max:20'],
            'lit' => [ 'string', 'max:20'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }

        $father->name=$input['name'];
        $father->email=$input['email'];
        $father->trip_id=$input['trip_id'];
        $father->password=Hash::make($input['password']);
        $father->mobileNumber=$input['mobileNumber'];
        $father->status=$input['status'];
        $father->region=$input['region'];
        $father->lng=$input['lng'];
        $father->lit=$input['lit'];
        $father->save();
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
