<?php

use Web\DriverController;
use Web\FatherController;
use Web\ChildController;
use Web\VehicleController;
use Web\BusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('father',FatherController::class)->middleware('verified');

Route::resource('child',ChildController::class)->middleware('verified');

Route::resource('driver',DriverController::class)->middleware('verified');

Route::resource('vehicle',VehicleController::class)->middleware('verified');
 // Route For Bus 
Route::resource('bus',BusController::class)->middleware('verified');
// Route::get("bus.index","Web\BusController@index")->middleware('verified');
// Route::get("bus.show","Web\BusController@show")->middleware('verified');
// Route::put("bus.update","Web\BusController@update")->middleware('verified');
// Route::delete("bus.delete","Web\BusController@Destroy")->middleware('verified');
// Last Route
Route::fallback(function(){
    return view("404/404");
});