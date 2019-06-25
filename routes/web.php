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
Route::get('get-call-status-list', 'DropdownController@getCallStatusList');
////End Dropdown

Route::group(['middleware' => 'CheckAdmin'], function () {

    //// ADMIN DASHBOARD
    Route::get('/admin-dashboard', 'Admin\DashboardController@dashboardView')->name('admin-dashboard');
    /// END DASHBOARD

    /// My Profile
    route::get('/admin/my-profile/{userId}','Admin\UserController@myProfile')->name('admin.my-profile');
    route::post('/admin/update-my-profile-post/{userId}','Admin\UserController@myProfileUpdate')->name('admin.update-my-profile-post');
     /// End My Profile

    /// ALL USERS
    route::get('/admin/all-users','Admin\UserController@allUsers')->name('admin.all-users');
    Route::get('/admin/user-activation/{userId}','Admin\UserController@changeUserStatus')->name('admin.change-user-status');
    Route::get('/admin/user-delete/{userId}', 'Admin\UserController@deleteUser')->name('admin.delete-user');
    route::get('/admin/add-user','Admin\UserController@addUser')->name('admin.add-user');
    route::post('/admin/add-user-post','Admin\UserController@addUserPost')->name('admin.add-user-post');
    route::get('/admin/update-account/{userId}','Admin\UserController@editUser')->name('admin.update-account');
    route::post('/admin/update-account-post/{userId}','Admin\UserController@editUserUpdate')->name('admin.update-account-post');
    /// END ALL USER

    /// ALL TAWK.TO USERS
    route::get('/admin/all-tawk-to-users','Admin\UserController@allTawkToUsers')->name('admin.all-tawk-to-users');
    route::post('/admin/add-tawk-to-user','Admin\UserController@addTawkToUserPost')->name('admin.add-tawk-to-user');
    route::post('/admin/edit-tawk-to-user/{userId}','Admin\UserController@editTawkToUserPost')->name('admin.edit-tawk-to-user');
    route::get('/admin/export-tawk-to-user','Admin\UserController@exportTawkToUser')->name('admin.export-tawk-to-user');
    route::post('/admin/import-tawk-to-user','Admin\UserController@importTawkToUser')->name('admin.import-tawk-to-user');
    //// FOR SMS ROUTE ON TAWK.TO USERS
    route::get('/admin/sms-tawk-to-users','Admin\UserController@smsTawkToUsers')->name('admin.sms-tawk-to-users');
    route::get('/admin/sms-tawk-to-all-users/{massegeId}','Admin\UserController@smsTawkToAllUsers')->name('admin.sms-tawk-to-all-users');
    route::get('/admin/massege-data/{massegeId}','Admin\UserController@massegeData')->name('admin.massege-data');
    /// END TAWK.TO USERS

    /// JOB APPLICATION FOR HIRING PROCESS
    route::get('/admin/all-job-application','Admin\JobApplicationController@allJobApplications')->name('admin.all-job-application');
    route::post('/admin/post-job-application','Admin\JobApplicationController@jobApplicationsPost')->name('admin.post-job-application');
    route::get('/admin/download-resume/{jobApplicantId}','Admin\JobApplicationController@downloadResumeApplicant')->name('admin.download-resume');
    Route::get('/admin/delete-job-application/{jobApplicantId}', 'Admin\JobApplicationController@deleteJobApplication')->name('admin.delete-job-application');
    route::post('/admin/update-job-application/{jobApplicantId}','Admin\JobApplicationController@jobApplicationsUpdate')->name('admin.update-job-application');
    /// END JOB APPLICATION FOR HIRING PROCESS

    /// SCHEDULE ROUTES
    route::get('/admin/all-schedules','Admin\ScheduleController@allSchedules')->name('admin.all-schedules');
    Route::get('/admin/schedule-activation/{scheduleId}','Admin\ScheduleController@changeScheduleStatus')->name('admin.change-schedule-status');
    Route::get('/admin/user-schedule/{scheduleId}', 'Admin\ScheduleController@deleteSchedule')->name('admin.delete-schedule');
    route::post('/admin/post-interview-schedule','Admin\ScheduleController@interviewSchedulePost')->name('admin.post-interview-schedule');
    route::post('/admin/update-interview-schedule/{scheduleId}','Admin\ScheduleController@interviewScheduleUpdate')->name('admin.update-interview-schedule');
    route::get('/admin/edit-schedule-data/{scheduleId}','Admin\ScheduleController@editScheduleData')->name('admin.edit-schedule-data');
    /// END SCHEDULE ROUTES

    /// MESSAGEGS RESPONSE
    route::get('/admin/all-message-responses','Admin\SMSResponseController@allMessageResponse')->name('admin.all-message-responses');
    /// END MESSAGEGS RESPONSE
});


Route::group(['middleware' => 'CheckEmpolyee'], function (){


});


Route::group(['middleware' => 'CheckGuest'], function () {


});