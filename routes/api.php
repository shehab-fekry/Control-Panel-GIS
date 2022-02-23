<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

////////////////////////////////Fathers routes///////////////////////////////////
///Auth///

Route::post("father/register","API\AuthController@fatherRegister");
Route::post("father/login","API\AuthController@fatherLogin");
///fathers operations with middleware/////
Route::middleware('auth:api-fathers')->group(function(){

Route::get("father/show","API\FatherController@show");
Route::put("father/update","API\FatherController@update");
Route::get("father/delete","API\FatherController@destroy");
Route::get("father/showTrip","API\FatherController@showTrip");

    });
////////////////////////////////Drivers routes//////////////////////////////////
///Auth///
Route::post("driver/register","API\AuthController@driverRegister");
Route::post("driver/login","API\AuthController@driverLogin");
///Drivers operations with middleware/////
Route::middleware('auth:api-Drivers')->group(function(){


    });
