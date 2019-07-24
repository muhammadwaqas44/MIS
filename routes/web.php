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
    route::get('/admin/my-profile/{userId}', 'Admin\UserController@myProfile')->name('admin.my-profile');
    route::post('/admin/update-my-profile-post/{userId}', 'Admin\UserController@myProfileUpdate')->name('admin.update-my-profile-post');
    /// End My Profile

    /// ALL USERS
    route::get('/admin/all-users', 'Admin\UserController@allUsers')->name('admin.all-users');
    Route::get('/admin/user-activation/{userId}', 'Admin\UserController@changeUserStatus')->name('admin.change-user-status');
    Route::get('/admin/user-delete/{userId}', 'Admin\UserController@deleteUser')->name('admin.delete-user');
    route::get('/admin/add-user', 'Admin\UserController@addUser')->name('admin.add-user');
    route::post('/admin/add-user-post', 'Admin\UserController@addUserPost')->name('admin.add-user-post');
    route::get('/admin/update-account/{userId}', 'Admin\UserController@editUser')->name('admin.update-account');
    route::post('/admin/update-account-post/{userId}', 'Admin\UserController@editUserUpdate')->name('admin.update-account-post');
    /// END ALL USER

    /// ALL TAWK.TO USERS
    route::get('/admin/all-tawk-to-users', 'Admin\UserController@allTawkToUsers')->name('admin.all-tawk-to-users');
    route::post('/admin/add-tawk-to-user', 'Admin\UserController@addTawkToUserPost')->name('admin.add-tawk-to-user');
    route::post('/admin/edit-tawk-to-user/', 'Admin\UserController@editTawkToUserPost')->name('admin.edit-tawk-to-user');
    route::get('/admin/export-tawk-to-user', 'Admin\UserController@exportTawkToUser')->name('admin.export-tawk-to-user');
    route::post('/admin/import-tawk-to-user', 'Admin\UserController@importTawkToUser')->name('admin.import-tawk-to-user');
    //// FOR SMS ROUTE ON TAWK.TO USERS
    route::get('/admin/sms-tawk-to-users', 'Admin\UserController@smsTawkToUsers')->name('admin.sms-tawk-to-users');
    route::get('/admin/sms-tawk-to-all-users/{massegeId}', 'Admin\UserController@smsTawkToAllUsers')->name('admin.sms-tawk-to-all-users');
    route::get('/admin/massege-data/{massegeId}', 'Admin\UserController@massegeData')->name('admin.massege-data');
    route::get('/admin/user-data/{userId}', 'Admin\UserController@userData')->name('admin.user-data');
    /// END TAWK.TO USERS

    /// WINNER ROUTES
    route::get('/admin/all-winners', 'Admin\WinnerController@allWinners')->name('admin.all-winners');
    route::post('/admin/add-data-winner', 'Admin\WinnerController@addWinnerPost')->name('admin.add-data-winner');
    route::post('/admin/edit-data-winner/{winnerId}', 'Admin\WinnerController@editWinnerPost')->name('admin.edit-data-winner');
    /// END WINNER ROUTES

    /// JOB APPLICATION FOR HIRING PROCESS
    route::get('/admin/all-job-application', 'Admin\JobApplicationController@allJobApplications')->name('admin.all-job-application');
    route::post('/admin/post-job-application', 'Admin\JobApplicationController@jobApplicationsPost')->name('admin.post-job-application');
    route::get('/admin/download-resume/{jobApplicantId}', 'Admin\JobApplicationController@downloadResumeApplicant')->name('admin.download-resume');
    Route::get('/admin/delete-job-application/{jobApplicantId}', 'Admin\JobApplicationController@deleteJobApplication')->name('admin.delete-job-application');
    route::post('/admin/update-job-application/{jobApplicantId}', 'Admin\JobApplicationController@jobApplicationsUpdate')->name('admin.update-job-application');
    /// END JOB APPLICATION FOR HIRING PROCESS

    /// SCHEDULE ROUTES
    route::get('/admin/all-schedules', 'Admin\EmpHistoryController@allSchedules')->name('admin.all-schedules');
    route::get('/admin/all-schedules-not-available', 'Admin\EmpHistoryController@allSchedulesNOtAvailable')->name('admin.all-schedules-not-available');
    Route::get('/admin/schedule-activation/{scheduleId}', 'Admin\EmpHistoryController@changeScheduleStatus')->name('admin.change-schedule-status');
    Route::get('/admin/user-schedule/{scheduleId}', 'Admin\EmpHistoryController@deleteSchedule')->name('admin.delete-schedule');
    route::post('/admin/post-interview-schedule', 'Admin\EmpHistoryController@interviewSchedulePost')->name('admin.post-interview-schedule');
    route::post('/admin/update-interview-schedule/{scheduleId}', 'Admin\EmpHistoryController@interviewScheduleUpdate')->name('admin.update-interview-schedule');
    /// ADD INITIAL INTERVIEW
    route::get('/admin/all-interviews', 'Admin\EmpHistoryController@allInterviews')->name('admin.all-interviews');
    route::post('/admin/post-update-interview-data/{interviewId}', 'Admin\EmpHistoryController@interviewDataUpdate')->name('admin.post-update-interview-data');
    route::post('/admin/post-add-interview-data', 'Admin\EmpHistoryController@interviewDataPost')->name('admin.post-add-interview-data');
    //// ADD  INITIAL INTERVIEW FOR OTHER DETAILS
    route::post('/admin/post-add-interview-data/{scheduleId}', 'Admin\EmpHistoryController@interviewDataPost')->name('admin.post-add-interview-data');
    //// SHORTLISTED ROUTES
    route::get('/admin/shortlisted', 'Admin\EmpHistoryController@allShortlisted')->name('admin.shortlisted');
    /////   TECHNICAL INTERVIEWS ROUTES
    route::get('/admin/tech-interview', 'Admin\EmpHistoryController@allTechInterviews')->name('admin.tech-interview');
    ///// HR INTERVIEWS ROUTES
    route::get('/admin/hr-interview', 'Admin\EmpHistoryController@allHRInterviews')->name('admin.hr-interview');
    ///// HR INTERVIEWS ROUTES
    route::get('/admin/offer-given', 'Admin\EmpHistoryController@allOfferGiven')->name('admin.offer-given');
    /// END SCHEDULE ROUTES
    /// All Applicants Routes
    route::get('/admin/all-applicants', 'Admin\EmpHistoryController@allApplicants')->name('admin.all-applicants');
    route::get('/admin/export-job-applicant', 'Admin\EmpHistoryController@exportJobApplicant')->name('admin.export-job-applicant');

    ///End All Applicants Routes

    //// Schedule mail
//    Route::get('/send/mailSchedule/{applicantId}/{scheduleId}', 'Admin\EmpHistoryController@mailSchedule')->name('send.mailSchedule');
    /// end mail
    /// MESSAGEGS RESPONSE
    route::get('/admin/all-message-responses', 'Admin\SMSResponseController@allMessageResponse')->name('admin.all-message-responses');
    route::get('/admin/all-messages', 'Admin\SMSResponseController@allMessages')->name('admin.all-messages');
    route::post('/admin/add-message', 'Admin\SMSResponseController@addMessage')->name('admin.add-message');
    Route::get('/admin/massage-activation/{messageId}', 'Admin\SMSResponseController@changeMessageStatus')->name('admin.change-message-status');
    Route::post('/admin/update-massage/{messageId}', 'Admin\SMSResponseController@updateMessage')->name('admin.update-message');
    /// END MESSAGEGS RESPONSE
    ///
    /// ALL EMPLOYEES ROUTES
    route::get('/admin/all-employees', 'Admin\JoinEmployeeController@allEmployees')->name('admin.all-employees');
    route::get('/admin/add-employee', 'Admin\JoinEmployeeController@addEmployee')->name('admin.add-employee');
    route::get('/admin/join-employee/{jobApplicantId}', 'Admin\JoinEmployeeController@joinEmployee')->name('admin.join-employee');
    route::post('/admin/post-join-employee', 'Admin\JoinEmployeeController@postJoinEmployee')->name('admin.post-join-employee');
    route::get('/admin/update-employee-view/{employeeId}', 'Admin\JoinEmployeeController@updateEmployeeView')->name('admin.update-employee-view');
    route::post('/admin/update-employee/{employeeId}', 'Admin\JoinEmployeeController@updateEmployee')->name('admin.update-employee');
    route::get('/admin/download-resume-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadResumeEmployee')->name('admin.download-resume-employee');
    route::get('/admin/download-id-proof-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadIDProofEmployee')->name('admin.download-id-proof-employee');
    route::get('/admin/download-other-doc-personal-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadOtherDocPersonalEmployee')->name('admin.download-other-doc-personal-employee');
    route::get('/admin/download-official-latter-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadOfficialLatterEmployee')->name('admin.download-official-latter-employee');
    route::get('/admin/download-joining-latter-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadJoiningLatterEmployee')->name('admin.download-joining-latter-employee');
    route::get('/admin/download-contract-paper-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadContractPaperEmployee')->name('admin.download-contract-paper-employee');
    route::get('/admin/download-other-doc-official-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadOtherDocOfficialEmployee')->name('admin.download-other-doc-official-employee');
});


Route::group(['middleware' => 'CheckEmpolyee'], function () {


});


Route::group(['middleware' => 'CheckGuest'], function () {


});


