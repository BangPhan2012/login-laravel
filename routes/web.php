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


Route::get('index',[
     'as'=>'trang-chu',
     'uses'=>'PageController@getIndex'
]);

Route::get('index/manager',[
    'as'=>'manager',
    'uses'=>'PageController@getManager'
]);

Route::get('index/Topnavigation',[
    'as'=>'Topnavigation',
    'uses'=>'PageController@getTopnavigation'
]);

Route::get('index/login',[
    'as'=>'login',
    'uses'=>'PageController@getLogin'
]);
Route::post('index/login',[
    'as'=>'login',
    'uses'=>'AuthController@postLogin'
]);




Route::get('index/register',[
    'as'=>'register',
    'uses'=>'PageController@getRegister'
]);

Route::post('index/register',[
    'as'=>'register',
    'uses'=>'AuthController@postRegister'
]);

Route::post('index/manager/delete/{id}',[
    'as'=>'deleteuser',
    'uses'=>'PageController@deleteuser'
]);


Route::get('index/edit/{id}','PageController@edituser')->name('edituser');

Route::post('index/edit/{id}','PageController@postedituser');

Route::get('index/add','PageController@adduser')->name('adduser');

Route::post('index/add','PageController@postadduser');



