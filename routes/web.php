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

Auth::routes();

Route::get('/home', '@HomeControllerindex')->name('home');

Route::get('/user','HomeController@userindex');

Route::get('/show','HomeController@show');

Route::get('/datatables','HomeController@datatables');

