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

Route::group(['prefix' => 'user' , 'middleware' => 'auth:user-api'], function(){
    Route::get('/info','UserLoginRegisterController@details');
});

Route::group(['prefix' => 'admin' , 'middleware' => 'auth:admin-api'], function(){
    Route::get('/info','UserLoginRegisterController@details');
});

Route::group(['prefix' => 'medicalplace' , 'middleware' => 'auth:medicalplace-api'], function(){
    Route::get('/info','UserLoginRegisterController@details');
});

Route::group(['prefix' => 'ambulance' , 'middleware' => 'auth:ambulance-api'], function(){
    Route::get('/info','UserLoginRegisterController@details');
});

Route::group(['prefix' => 'doctor' , 'middleware' => 'auth:doctor-api'], function(){
    Route::get('/info','UserLoginRegisterController@details');
});
