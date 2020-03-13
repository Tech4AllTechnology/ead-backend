<?php

use Illuminate\Http\Request;

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


Route::post('/user/login', 'UserController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user/info', 'UserController@details');
    Route::get('/user', 'UserController@index');
    Route::post('/user/register', 'UserController@register');


    Route::get('/state', 'StateController@index');

    Route::get('/program', 'ProgramController@index');
    Route::post('/program', 'ProgramController@store');
    Route::put('/program/{program}', 'ProgramController@update');
    Route::delete('/program/{program}', 'ProgramController@destroy');

    Route::get('/course', 'CourseController@index');

});