<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\child;
use App\Models\Father;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Models\School;

class TripController extends Controller
{
    public function index()
    {
        $admin=Auth::user();
        if($admin->school_id==null){
            return redirect()->route('school.index');
        }
        $trips=Trip::where('school_id',$admin->school_id)->latest()->paginate(3);
        return view("trip.index",compact("trips"));

    }
    public function indexedit()
    {
        $admin=Auth::user();
        if($admin->school_id==null){ 
            return redirect()->route('school.index');
        }
        $trips=Trip::where('school_id',$admin->school_id)->get();
        return view("trip.indextrip",compact("trips"));

    }


  public function store(request $data)
    {
        $admin=Auth::user();


        $data->validate([
            'geofence' => ['required', 'string'],
        ]);
        Trip::create([
            'geofence' => $data['geofence'],
            'school_id' => $admin->school_id,

        ]);

        return redirect()->route("trip.index")
        ->with('success','trip added successfuly');
    }

public function live($id){
$trip =Trip::find($id)->first();
if($trip->status==0){
    return Basecontroller::sendResponse('please validate errors','the trip is not started yet');
    // $this->sendError('please validate errors','the trip is not started yet');
}
$school=$trip->school()->first();

$fathers=Father::where('trip_id',$trip->id)->where('status','>',0)->get();
$data=array();
$response=array();
$response['school']=array('location'=>[$school->lit,$school->lng]);
 $school_lat=deg2rad($school->lit);
 $school_lon=deg2rad($school->lng);
 $father_count=1;
foreach($fathers as $father)
{
    $father_lat=deg2rad($father->lit);
    $father_lon=deg2rad($father->lng);
    $children=Child::where("father_id",$father->id)->where('status',true)->get();

    $ln=$father_lon-$school_lon;
    $li=$father_lat-$school_lat;
    $val = pow(sin($li/2),2)+cos($school_lat)*cos($father_lat)*pow(sin($ln/2),2);
    $res = 2 * asin(sqrt($val));
    $radius = 6371; //radius of earth
    $distance=($res*$radius)*1000;
    $data[$father->name]=array();
    $data[$father->name]+=array('distance'=>$distance);
    $data[$father->name]+=array('name'=>$father->name);
    $data[$father->name]+=array('location'=>[$father->lng,$father->lit]);
    $childrens=array();
    $count=1;
    foreach($children as $child)
    {
        array_push($childrens,$child->name);
        // $childrens  $count=>$child->name);
        // $count++;
    }
    $data[$father->name]+=array('children'=>$childrens);
    // $father_count++;
}
$collection=collect($data);
$sorted = $collection->sortBy('distance');

$response['fathers']=$sorted;
return Basecontroller::sendResponse($response,'father information updated successfully');


}




    // public function create()
    // {
    //     //
    // }





    public function show(Trip $trip)
    {
        // $childs=Child::get();
        // return view("trip.show",compact('trip'))->with('trip',$childs);
        $driver=Driver::where('trip_id',$trip->id)->get();
        $father=father::where('trip_id',$trip->id)->get();


        $fathers=father::where('trip_id',$trip->id)->get();

        $child = School::first();
        $child->children()->get();
    
        // $fathers=father::find($id);
        // $fathers1= $fathers->select('id')->get() ;
        // $child=child::where('father_id',$fathers1)->get();
        // $school=School::where("code",$user->code);
        // $admin->school_id=$school->id;
        return view("trip.show",compact('trip'))->with([
            'driver'=>$driver,
            'father'=>$father,
            'child'=>$child,
        ]);
    }


    public function edit(Trip $trip)
    {
        $admin=Auth::user();
        // $trips=Trip::where("school_id",$admin->school_id)->get();
        // return view("trip.edit",compact('trip'))->with('trips',$trips);
        return view("trip.edit",compact('trip'));
    }


    // public function update(Request $request, Trip $trip)
    // {
    //     //
    // }


    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route("trip.index")->with('success','trip deleted successfuly');
    }
}
