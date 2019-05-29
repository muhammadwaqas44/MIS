<?php


Route::get('/', function () {

    return view('welcome');
})->name('welcome');


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login-user', 'Auth\LoginController@loginPost')->name('login-user');
Route::get('/register-user', 'Auth\Registration2Controller@registrationView')->name('register2');
Route::post('/post-register-user', 'Auth\Registration2Controller@registrationPost')->name('registrationPost');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//// Dropdown Dependent Country city state
Route::get('get-state-list', 'DropdownController@getStateList');
Route::get('get-city-list', 'DropdownController@getCityList');
////End Dropdown

Route::group(['middleware' => 'CheckAdmin'], function () {

    //// ADMIN DASHBOARD
    Route::get('/admin-dashboard', 'Admin\DashboardController@dashboardView')->name('admin-dashboard');

    /// END DASHBOARD
    /// My Profile
    route::get('/Admin/my-profile/{userId}','Admin\UserController@myProfile')->name('admin.my-profile');
    route::post('/Admin/my-profile-update//{userId}','Admin\UserController@myProfileUpdate')->name('admin.my-profile-update');
    /// End My Profile
});