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

// Route::get('/', function () {
//     return view('welcome');
// });
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
Route::prefix('/login')->middleware(['login'])->group(function(){
    Route::get('list','LoginController@list');
});
Route::get('/login/register','LoginController@register');
Route::post('/login/doregister','LoginController@doregister');
Route::get('/login/login','LoginController@login');
Route::any('/login/dologin','LoginController@dologin');
Route::get('/login/logout','LoginController@logout');

Route::prefix('/goods')->group(function(){
    Route::get('add','Admin\GoodsController@add');
    Route::post('do_add','Admin\GoodsController@do_add');
});
Route::get('/',function(){
    return view('index');
});
Route::get('index','IndexController@index');