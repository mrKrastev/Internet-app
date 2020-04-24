<?php

use Illuminate\Support\Facades\Route;

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
//declaring resources
Route::resource('items','ItemController');
Route::resource('itemrequests','ItemRequestController');
//get methods for some of the screens
Route::get('/create', 'ItemController@create')->name('create');
Route::get('itemrequests/createrequest/{id}', 'ItemRequestController@create')->name('itemrequests.create');
//instead of looking for index, I specify the home view
Route::get('/', function(){
  return view('home');
});
//laravel/ui routes
Auth::routes();
//just naming the home view home :D
Route::get('/home', 'HomeController@index')->name('home');
