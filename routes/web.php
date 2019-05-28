<?php



Route::get('/', function () {
    return view('welcome');
});

//Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//Route::post('/login-user', 'Auth\LoginController@loginPost')->name('login-user');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dropdownlist', 'DropdownController@index');
Route::get('get-state-list', 'DropdownController@getStateList');
Route::get('get-city-list', 'DropdownController@getCityList');


Route::group(['middleware' => 'CheckAdmin'], function () {

});