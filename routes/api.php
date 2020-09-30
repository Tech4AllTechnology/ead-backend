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
    Route::put('/user/logout', 'UserController@logout');
    Route::get('/user/info', 'UserController@details');
    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@store');
    Route::put('/user/{user}', 'UserController@update');
    Route::delete('/user/{user}', 'UserController@destroy');
    Route::get('/user/professor', 'UserController@listProfessor');

    Route::get('/state', 'StateController@index');
    Route::get('/country', 'CountryController@index');

    Route::get('/program', 'ProgramController@index');
    Route::get('/program/constant', 'ProgramController@listConstant');
    Route::get('/program/enable', 'ProgramController@index');
    Route::post('/program', 'ProgramController@store');
    Route::put('/program/{program}', 'ProgramController@update');
    Route::delete('/program/{program}', 'ProgramController@destroy');

    Route::get('/course', 'CourseController@index');
    Route::post('/course', 'CourseController@store');
    Route::put('/course/{course}', 'CourseController@update');
    Route::delete('/course/{course}', 'CourseController@destroy');

    Route::get('/campus', 'UniversityCampusController@index');
    Route::post('/campus', 'UniversityCampusController@store');
    Route::put('/campus/{universityCampus}', 'UniversityCampusController@update');
    Route::delete('/campus/{universityCampus}', 'UniversityCampusController@destroy');

    Route::get('/clazz', 'ClazzController@index');
    Route::post('/clazz', 'ClazzController@store');
    Route::put('/clazz/{clazz}', 'ClazzController@update');
    Route::delete('/clazz/{clazz}', 'ClazzController@destroy');

    Route::get('/roles', 'RoleController@index');


});