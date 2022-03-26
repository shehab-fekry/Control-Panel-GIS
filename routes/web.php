<?php

use Web\TripController;
use Web\DriverController;
use Web\FatherController;
use Web\ChildController;
use Web\VehicleController;
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
// Route::post("/assignAdminToSchool",function(){
//     return 'hhhhha';
// })->name('assignAdminToSchool');

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
// Route::post('/home','HomeController@assignAdminToSchool')->name('assignAdminToSchool')->middleware('verified');

// Route For school 
// Route::post("school/assignAdminToSchool","web\SchoolController@assignAdminToSchool")->name('assignAdminToSchool')->middleware('verified');
Route::resource('school',SchoolController::class)->middleware('verified');


// Route For trip 
Route::resource('trip',TripController::class )->middleware('verified');
Route::get('tripedit', 'Web\TripController@indexedit')->name('trip.indextrip');

// Route For father 
Route::resource('father',FatherController::class)->middleware('verified');
Route::get('changeStatus', 'FatherController@changeStatus');
// Add child 
Route::post('store_Child', 'Web\FatherController@store_Child')->name('father.store_Child');


// Route For driver 
Route::resource('driver',DriverController::class)->middleware('verified');


// Route For vehicle 
Route::resource('vehicle',VehicleController::class)->middleware('verified');



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