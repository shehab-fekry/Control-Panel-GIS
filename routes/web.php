<?php

use Web\TripController;
use Web\DriverController;
use Web\FatherController;
use Web\ChildController;
use Web\VehicleController;
use Web\BusController;
use Web\AdminController;
use Web\SchoolController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});


 // Route For Auth 
Auth::routes(['verify'=>true]);


// Route For home 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

// Route For Admin 
Route::resource('admin',AdminController::class)->middleware('verified');

// admin profile update
Route::post('/home','HomeController@profileUpdate')->name('profileupdate')->middleware('verified');

// Route For school 
Route::resource('school',SchoolController::class)->middleware('verified');
// Route::put("school/assignAdminToSchool/{admin}","web\SchoolController@assignAdminToSchool");
// Route::get('admin/{id}', 'Web\AdminController@assignAdminToSchool')->name('admin.assignAdminToSchool');

// assign adminn to school
// Route::post('/home','HomeController@assignAdminToSchool')->name('assignAdminToSchool')->middleware('verified');


// Route For trip 
Route::resource('trip',TripController::class )->middleware('verified');
Route::get('tripedit', 'Web\TripController@indexedit')->name('trip.indextrip');

// Route For father 
Route::resource('father',FatherController::class)->middleware('verified');

// // Add child 
// Route::post("father.store_Child","web\FatherController@store_Child")->middleware('verified');
// Route::post('someurl', 'FatherController@store_Child');


// Route For child 
Route::resource('child',ChildController::class)->middleware('verified');


// Route For driver 
Route::resource('driver',DriverController::class)->middleware('verified');


// Route For vehicle 
Route::resource('vehicle',VehicleController::class)->middleware('verified');


// Route For Bus 
Route::resource('bus',BusController::class)->middleware('verified');
// Route::get("bus.index","Web\BusController@index")->middleware('verified');
// Route::get("bus.show","Web\BusController@show")->middleware('verified');
// Route::put("bus.update","Web\BusController@update")->middleware('verified');
// Route::delete("bus.delete","Web\BusController@Destroy")->middleware('verified');


Route::get('send-mail', function () {

    // Email data details
    $details = [
        'title' => 'Email to Multiple Users',
        'body' => 'This is sample content we have added for this test mail sending to multiple users.'
    ];

    // Email to users
    $users=User::get();
    // $users = [
    //     "hossam.anber6@gmail.com",
    //     "m.3nber@gmail.com"
    // ]; 

    foreach ($users as $user) { // sending mail to users.

        Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
    }
    return redirect()->route("home")->with('success','Email is Sent, please check your inbox.');
})->middleware('verified');


// Last Route For error
Route::fallback(function(){
    return view("404/404");
});