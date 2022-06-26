<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\showTrip;
use App\Events\fatherNotification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

////////////////////////////////Fathers Apllication routes///////////////////////////////////

///Auth///
Route::post("father/register","API\AuthController@fatherRegister");
Route::post("father/login","API\AuthController@fatherLogin");
///fathers operations with middleware/////
Route::middleware('auth:api-fathers')->group(function(){
Route::get("father/show","API\FatherController@show");
Route::put("father/update","API\FatherController@update");
Route::delete("father/delete","API\FatherController@destroy");
Route::get("father/showBusDriver","API\FatherController@showBusDriver");
Route::get("father/showTrip","API\FatherController@showTrip");
////////child operations//////////////

Route::get("childrens","API\ChildController@index");
Route::post("child/create","API\ChildController@store");
Route::get("child/show/{id}","API\ChildController@show");
Route::put("child/update/{id}","API\ChildController@update");
Route::put("child/updateStatus/{id}","API\ChildController@updateChildStatus");
Route::delete("child/delete/{id}","API\ChildController@destroy");

    });
////////////////////////////////Drivers routes//////////////////////////////////
///Auth///
Route::post("driver/register","API\AuthController@driverRegister");
Route::post("driver/login","API\AuthController@driverLogin");
///Drivers operations with middleware/////
Route::middleware('auth:api-drivers')->group(function(){
    Route::get("driver/show","API\DriverController@show");
    Route::put("driver/update","API\DriverController@update");
    Route::get("driver/count_childs","API\DriverController@count_childs");
    Route::delete("driver/delete","API\DriverController@Destroy");
///trip operations///////
    Route::put("changeLocation",function(request $request ){
        event(new showTrip($request));
        return response()->json(["message"=>"location changed"]);
    });
    Route::put("fatherNotification/{id}",function($id){
        event(new fatherNotification($id));
        return response()->json(["message"=>"parent notified"]);
    });
    Route::post('trip/start',"API\TripController@start");
    Route::post('trip/delivered',"API\TripController@delivered");
    Route::post('trip/backHome',"API\TripController@backHome");
    Route::post('trip/end',"API\TripController@end");
    Route::get('trip/attendence',"API\TripController@attendence");
    });

    Route::get("trip/live/{id}","Web\TripController@live");
    Route::get("trip/preview/{id}","Web\TripController@preview");
    Route::get("school/location/{id}","Web\SchoolController@showLocation");
////////////////////////////////Drivers routes//////////////////////////////////
