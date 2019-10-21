<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


route::post('post-job-application', 'Admin\JobApplicationController@jobApplicationsPostApi')->name('api.post-job-application');


Route::prefix('portal')->namespace('ApiJobPortal')->group(function () {
    Route::post('/sign-up', 'AuthApplicantController@signUpApplicant');
    Route::post('/forget-password', 'AuthApplicantController@forgetEmailPassword');
    Route::delete('/get-user/{userId}', 'AuthApplicantController@getUserForPasswordReset')->name('portal.get-user');

});