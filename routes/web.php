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
    route::get('/admin/update-account/{userId}','Admin\UserController@myProfile')->name('admin.update-account');
    route::post('/admin/update-account-post/{userId}','Admin\UserController@myProfileUpdate')->name('admin.update-account-post');
    /// End My Profile
    /// ALL USERS
    route::get('/admin/all-users','Admin\UserController@allUsers')->name('admin.all-users');
    Route::get('/admin/user-activation/{userId}',  'Admin\UserController@changeUserStatus')->name('admin.change-user-status');
    Route::get('/admin/user-delete/{userId}', 'Admin\UserController@deleteUser')->name('admin.delete-user');
    route::get('/admin/add-user','Admin\UserController@addUser')->name('admin.add-user');
    route::post('/admin/add-user-post','Admin\UserController@addUserPost')->name('admin.add-user-post');
    /// END ALL USER
    /// ALL TAWK.TO USERS
    route::get('/admin/all-tawk-to-users','Admin\UserController@allTawkToUsers')->name('admin.all-tawk-to-users');
    route::post('/admin/add-tawk-to-user','Admin\UserController@addTawkToUserPost')->name('admin.add-tawk-to-user');
    route::post('/admin/edit-tawk-to-user/{userId}','Admin\UserController@editTawkToUserPost')->name('admin.edit-tawk-to-user');

    /// END TAWK.TO USERS
});


Route::group(['middleware' => 'CheckEmpolyee'], function (){


});


Route::group(['middleware' => 'CheckGuest'], function () {


});