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

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login-user', 'Auth\LoginController@loginPost')->name('login-user');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dropdownlist', 'DropdownController@index');
Route::get('get-state-list', 'DropdownController@getStateList');
Route::get('get-city-list', 'DropdownController@getCityList');


Route::group(['middleware' => 'CheckAdmin'], function () {

});