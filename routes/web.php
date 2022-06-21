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


Route::get('/', function () {
    return view('welcome');
});


 // Route For Auth 
Auth::routes(['verify'=>true]);


// Route For home 
Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);


Route::group(['namespace' => 'Admin', 'middleware' => 'twofactor'], function () {
    // Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified'); });

// Route For Admin 
Route::resource('admin',AdminController::class)->middleware('verified');

// admin profile update
Route::post('/home','HomeController@profileUpdate')->name('profileupdate')->middleware('verified');
Route::post('assignAdminToSchool', 'Web\SchoolController@assignAdminToSchool')->name('school.assignAdminToSchool')->middleware('verified');
Route::post('left', 'Web\SchoolController@left')->name('school.left')->middleware('verified');


// Route For school 
Route::resource('school',SchoolController::class)->middleware('verified');


// Route For trip 
Route::resource('trip',TripController::class )->middleware('verified');
Route::get('tripedit', 'Web\TripController@indexedit')->name('trip.indextrip');
// Route::get('tripedit', 'Web\TripController@indexedit')->name('trip.indextrip');

///////////////////////////////////// Route For father ///////////////////////////////////////////////////////////////
Route::resource('father',FatherController::class)->middleware('verified');
Route::get('changeStatus', 'Web\FatherController@changeStatus')->name('changeStatus');
//passwordReset
Route::put('passwordReset', 'Web\FatherController@passwordReset')->name('passwordReset');
// Add child 
Route::post('store_Child', 'Web\FatherController@store_Child')->name('father.store_Child');
Route::get('changeFatherStatus', 'Web\FatherController@changeFatherStatus')->name('changeFatherStatus');
//////////////////////////////////// Route For driver///////////////////////////////////////////////////////////////// 
Route::resource('driver',DriverController::class)->middleware('verified');
Route::get('changeDriverStatus', 'Web\DriverController@changeDriverStatus')->name('changeDriverStatus');
Route::put('DriverpasswordReset', 'Web\DriverController@DriverpasswordReset')->name('DriverpasswordReset');

////////////////////////////////// Route For vehicle ////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('vehicle',VehicleController::class)->middleware('verified');



Route::get('send-mail', function () {

    // Email data details
    $details = [
        'title' => 'school is closed now',
        'body' => 'hossam ali.'
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