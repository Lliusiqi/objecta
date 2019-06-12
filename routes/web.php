<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::get('user',function(){
//    return view('welcome');
//});
Route::get('user','UserController@index');

Route::prefix('/student')->middleware(['stu'])->group(function(){
    Route::get('add','StudentController@create');
    Route::post('do_add','StudentController@store');
    Route::get('list','StudentController@index');
    Route::post('delete','StudentController@del');
    Route::get('edit','StudentController@edit');
    Route::post('update/','StudentController@update');
});
Route::prefix('/login')->group(function(){
    Route::get('register','LoginController@register');
    Route::post('doregister','LoginController@doregister');
    Route::get('login','LoginController@login');
    Route::any('dologin','LoginController@dologin');
    Route::get('list','LoginController@list');

});