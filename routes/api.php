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
//user authentication
Route::post('/user-register','UserController@register');
Route::post('/user-login','UserController@login');

//Admin authentication
Route::post('/admin-register','AdminController@register');
Route::post('/admin-login','AdminController@login');

//Ambulance authentication
Route::post('/ambulance-register','AmbulanceController@register');
Route::post('/ambulance-login','AmbulanceController@login');

//MedicalPlace authentication
Route::post('/medicalplace-register','MedicalPlaceController@register');
Route::post('/medicalplace-login','MedicalPlaceController@login');

//Doctor authentication
Route::post('/doctor-register','DoctorController@register');
Route::post('/doctor-login','DoctorController@login');

Route::group(['prefix' => 'user' , 'middleware' => 'auth:user-api'], function(){
    Route::get('/info','UserController@details');

});

Route::group(['prefix' => 'admin' , 'middleware' => 'auth:admin-api'], function(){
    Route::get('/info','AdminRegisterController@details');
});

Route::group(['prefix' => 'medicalplace' , 'middleware' => 'auth:medicalplace-api'], function(){
    Route::get('/info','MedicalPlaceController@details');
});

Route::group(['prefix' => 'ambulance' , 'middleware' => 'auth:ambulance-api'], function(){
    Route::get('/info','AmbulanceController@details');
});

Route::group(['prefix' => 'doctor' , 'middleware' => 'auth:doctor-api'], function(){
    Route::get('/info','DoctorController@details');
});
