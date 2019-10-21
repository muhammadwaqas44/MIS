<?php


Route::get('/', function () {
    return redirect()->route('login');
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
Route::get('get-designation-list', 'DropdownController@getDesignationList');
Route::get('category-list', 'DropdownController@getCategoryList');
////End Dropdown

Route::group(['middleware' => ['CheckAdmin', 'auth']], function () {

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
    route::get('/admin/export-winner', 'Admin\WinnerController@exportWinner')->name('admin.export-winner');
    /// END WINNER ROUTES

    /// JOB APPLICATION FOR HIRING PROCESS
    route::get('/admin/all-job-application', 'Admin\JobApplicationController@allJobApplications')->name('admin.all-job-application');
    route::get('/admin/add-job-application', 'Admin\JobApplicationController@addJobApplications')->name('admin.add-job-application');
    route::get('/admin/edit-job-application/{jobApplicantId}', 'Admin\JobApplicationController@editJobApplications')->name('admin.edit-job-application');
    route::get('/admin/add-status-application/{jobApplicantId}', 'Admin\JobApplicationController@addStatusApplication')->name('admin.add-status-application');


    route::post('/admin/post-job-application', 'Admin\JobApplicationController@jobApplicationsPost')->name('admin.post-job-application');
    route::get('/admin/download-resume/{jobApplicantId}', 'Admin\JobApplicationController@downloadResumeApplicant')->name('admin.download-resume');
    Route::get('/admin/delete-job-application/{jobApplicantId}', 'Admin\JobApplicationController@deleteJobApplication')->name('admin.delete-job-application');
    route::post('/admin/update-job-application/{jobApplicantId}', 'Admin\JobApplicationController@jobApplicationsUpdate')->name('admin.update-job-application');
    /// END JOB APPLICATION FOR HIRING PROCESS

    /// SCHEDULE ROUTES
    route::get('/admin/all-schedules', 'Admin\EmpHistoryController@allSchedules')->name('admin.all-schedules');
    route::get('/admin/all-schedules-not-available', 'Admin\EmpHistoryController@allSchedulesNOtAvailable')->name('admin.all-schedules-not-available');
    Route::get('/admin/schedule-activation/{scheduleId}', 'Admin\EmpHistoryController@changeScheduleStatus')->name('admin.change-schedule-status');
    route::get('/admin/view-status-interview/{scheduleId}', 'Admin\EmpHistoryController@viewStatusInterview')->name('admin.view-status-interview');
    route::get('/admin/add-status-interview/{scheduleId}', 'Admin\EmpHistoryController@addStatusInterview')->name('admin.add-status-interview');
    route::get('/admin//view-status-not-interview/{scheduleId}', 'Admin\EmpHistoryController@viewStatusNotInterview')->name('admin.view-status-not-interview');
    Route::get('/admin/user-schedule/{scheduleId}', 'Admin\EmpHistoryController@deleteSchedule')->name('admin.delete-schedule');
    route::post('/admin/post-interview-schedule', 'Admin\EmpHistoryController@interviewSchedulePost')->name('admin.post-interview-schedule');
    route::post('/admin/update-interview-schedule/{scheduleId}', 'Admin\EmpHistoryController@interviewScheduleUpdate')->name('admin.update-interview-schedule');
    route::post('/admin/update-interview-not-schedule/{scheduleId}', 'Admin\EmpHistoryController@interviewNotScheduleUpdate')->name('admin.update-interview-not-schedule');
    /// ADD INITIAL INTERVIEW
    route::get('/admin/all-interviews', 'Admin\EmpHistoryController@allInterviews')->name('admin.all-interviews');
    route::post('/admin/post-update-interview-data/{interviewId}', 'Admin\EmpHistoryController@interviewDataUpdate')->name('admin.post-update-interview-data');
    route::post('/admin/post-add-interview-data', 'Admin\EmpHistoryController@interviewDataPost')->name('admin.post-add-interview-data');

    route::get('/admin/view-initial-interview-status/{interviewId}', 'Admin\EmpHistoryController@viewInitialInterviewStatus')->name('admin.view-initial-interview-status');
    route::get('/admin/add-initial-interview-status/{interviewId}', 'Admin\EmpHistoryController@addInitialInterviewStatus')->name('admin.add-initial-interview-status');
    route::post('/admin/post-add-interview-data/{scheduleId}', 'Admin\EmpHistoryController@interviewDataPost')->name('admin.post-add-interview-data');


    /// offer latter compose
    route::post('/admin/offer-latter-compose', 'Admin\EmpHistoryController@offerLatterCompose')->name('admin.offer-latter-compose');
    route::get('/admin/download-offer-latter/{interviewId}', 'Admin\EmpHistoryController@downloadOfferLatter')->name('admin.download-offer-latter');

    //// SHORTLISTED ROUTES
    route::get('/admin/shortlisted', 'Admin\EmpHistoryController@allShortlisted')->name('admin.shortlisted');
    route::get('/admin/add-shortlisted-status/{interviewId}', 'Admin\EmpHistoryController@addShortlistedStatus')->name('admin.add-shortlisted-status');
    route::get('/admin/view-shortlisted-status/{interviewId}', 'Admin\EmpHistoryController@viewShortlistedStatus')->name('admin.view-shortlisted-status');
    route::post('/admin/post-add-shortlist-data/{scheduleId}', 'Admin\EmpHistoryController@shortlistDataPost')->name('admin.post-add-shortlist-data');

    /////   TECHNICAL INTERVIEWS ROUTES
    route::get('/admin/tech-interview', 'Admin\EmpHistoryController@allTechInterviews')->name('admin.tech-interview');
    route::get('/admin/add-tech-status/{interviewId}', 'Admin\EmpHistoryController@addTechStatus')->name('admin.add-tech-status');
    route::get('/admin/view-tech-status/{interviewId}', 'Admin\EmpHistoryController@viewTechStatus')->name('admin.view-tech-status');
    route::post('/admin/post-add-tech-data/{scheduleId}', 'Admin\EmpHistoryController@techDataPost')->name('admin.post-add-tech-data');
    ///// HR INTERVIEWS ROUTES
    route::get('/admin/hr-interview', 'Admin\EmpHistoryController@allHRInterviews')->name('admin.hr-interview');
    route::get('/admin/add-hr-status/{interviewId}', 'Admin\EmpHistoryController@addHRStatus')->name('admin.add-hr-status');
    route::get('/admin/view-hr-status/{interviewId}', 'Admin\EmpHistoryController@viewHRStatus')->name('admin.view-hr-status');
    route::post('/admin/post-add-hr-data/{scheduleId}', 'Admin\EmpHistoryController@hrDataPost')->name('admin.post-add-hr-data');
    ///// HR INTERVIEWS ROUTES
    route::get('/admin/offer-given', 'Admin\EmpHistoryController@allOfferGiven')->name('admin.offer-given');
    route::get('/admin/add-offer-status/{interviewId}', 'Admin\EmpHistoryController@addOfferStatus')->name('admin.add-offer-status');
    route::get('/admin/view-offer-status/{interviewId}', 'Admin\EmpHistoryController@viewOfferStatus')->name('admin.view-offer-status');
    route::post('/admin/post-add-offer-data/{scheduleId}', 'Admin\EmpHistoryController@offerDataPost')->name('admin.post-add-offer-data');
    /// END SCHEDULE ROUTES
    /// All Applicants Routes
    route::get('/admin/all-applicants', 'Admin\EmpHistoryController@allApplicants')->name('admin.all-applicants');
    route::post('/admin/update-interview-schedule-all/{scheduleId}', 'Admin\EmpHistoryController@interviewScheduleUpdateAll')->name('admin.update-interview-schedule-all');
    route::get('/admin/add-all-app-status/{interviewId}', 'Admin\EmpHistoryController@addAllAppStatus')->name('admin.add-all-app-status');
    route::post('/admin/post-all-applicants-data/{scheduleId}', 'Admin\EmpHistoryController@applicantsDataPost')->name('admin.post-all-applicants-data');
    ///End All Applicants Routes


    //////All exports on Hiring
    route::get('/admin/export-all-added-applicants', 'Admin\EmpHistoryController@exportAllAddedApplicants')->name('admin.export-all-added-applicants');
    route::get('/admin/export-all-schedules', 'Admin\EmpHistoryController@exportAllSchedules')->name('admin.export-all-schedules');
    route::get('/admin/export-all-ini-interviews', 'Admin\EmpHistoryController@exportAllIniInterviews')->name('admin.export-all-ini-interviews');
    route::get('/admin/export-all-hr-interviews', 'Admin\EmpHistoryController@exportAllHRInterviews')->name('admin.export-all-hr-interviews');
    route::get('/admin/export-all-offer-given', 'Admin\EmpHistoryController@exportAllOfferGiven')->name('admin.export-all-offer-given');
    route::get('/admin/export-all-shortlisted', 'Admin\EmpHistoryController@exportAllShortlisted')->name('admin.export-all-shortlisted');
    route::get('/admin/export-all-tech-interviews', 'Admin\EmpHistoryController@exportAllTechInterviews')->name('admin.export-all-tech-interviews');
    route::get('/admin/export-job-applicant', 'Admin\EmpHistoryController@exportJobApplicant')->name('admin.export-job-applicant');
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

    /// ALL EMPLOYEES ROUTES
    route::get('/admin/all-employees', 'Admin\JoinEmployeeController@allEmployees')->name('admin.all-employees');
    route::get('/admin/all-active-inActive-employees', 'Admin\JoinEmployeeController@allActiveInActiveEmployees')->name('admin.all-active-inActive-employees');
    route::get('/admin/add-employee', 'Admin\JoinEmployeeController@addEmployee')->name('admin.add-employee');
    route::post('/admin/add-employee-post', 'Admin\JoinEmployeeController@addEmployeePost')->name('admin.add-employee-post');
    route::get('/admin/join-employee/{jobApplicantId}', 'Admin\JoinEmployeeController@joinEmployee')->name('admin.join-employee');
    route::post('/admin/post-join-employee', 'Admin\JoinEmployeeController@postJoinEmployee')->name('admin.post-join-employee');
    route::get('/admin/update-employee-view/{employeeId}', 'Admin\JoinEmployeeController@updateEmployeeView')->name('admin.update-employee-view');
    route::post('/admin/update-employee/{employeeId}', 'Admin\JoinEmployeeController@updateEmployee')->name('admin.update-employee');
    route::get('/admin/status-employee-view/{employeeId}', 'Admin\JoinEmployeeController@statusEmployeeView')->name('admin.status-employee-view');
    route::post('/admin/add-status-employee/{employeeId}', 'Admin\JoinEmployeeController@addStatusEmployee')->name('admin.add-status-employee');
    route::post('/admin/next-review-employee-post/{employeeId}', 'Admin\JoinEmployeeController@nextReviewEmployee')->name('admin.next-review-employee-post');
    route::get('/admin/change-employee-active/{employeeId}', 'Admin\JoinEmployeeController@changeEmployeeStatus')->name('admin.change-employee-active');

    /// FOR SHOWING FILES FOR EMPLOYMENT
    route::get('/admin/download-resume-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadResumeEmployee')->name('admin.download-resume-employee');
    route::get('/admin/download-id-proof-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadIDProofEmployee')->name('admin.download-id-proof-employee');
    route::get('/admin/download-other-doc-personal-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadOtherDocPersonalEmployee')->name('admin.download-other-doc-personal-employee');
    route::get('/admin/download-official-latter-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadOfficialLatterEmployee')->name('admin.download-official-latter-employee');
    route::get('/admin/download-joining-latter-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadJoiningLatterEmployee')->name('admin.download-joining-latter-employee');
    route::get('/admin/download-contract-paper-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadContractPaperEmployee')->name('admin.download-contract-paper-employee');
    route::get('/admin/download-other-doc-official-employee/{employeeId}', 'Admin\JoinEmployeeController@downloadOtherDocOfficialEmployee')->name('admin.download-other-doc-official-employee');

    //////// ALL UPCOMING REVIEWS FOR EMPLOYMENT
    route::get('/admin/all-upcoming-reviews-employment', 'Admin\JoinEmployeeController@allUpcomingReviews')->name('admin.all-upcoming-reviews-employment');
    route::get('/admin/status-employee-review/{employeeId}', 'Admin\JoinEmployeeController@statusEmployeeReview')->name('admin.status-employee-review');
    route::post('/admin/add-status-employee-review/{employeeId}', 'Admin\JoinEmployeeController@addStatusEmployeeReview')->name('admin.add-status-employee-review');
    route::get('/admin/next-review-employee/{employeeId}', 'Admin\JoinEmployeeController@nextReviewEmployeeView')->name('admin.next-review-employee');
    route::post('/admin/next-review-employee-out-post/{employeeId}', 'Admin\JoinEmployeeController@nextReviewUpcomingEmployee')->name('admin.next-review-upcoming-employee-post');

    //// ALL EMPLOYMENT CHECK LIST ROUTES
    route::get('/admin/all-employment-check-list', 'Admin\EmploymentCheckController@allEmploymentCheck')->name('admin.all-employment-check-list');
    route::get('/admin/view-employment-check-list-page/{employeeId}', 'Admin\EmploymentCheckController@viewEmploymentCheck')->name('admin.view-employment-check-list-page');
    route::post('/admin/post-employment-check-list-page/{employeeId}', 'Admin\EmploymentCheckController@postEmploymentCheck')->name('admin.post-employment-check-list-page');

    ////Export Employees
    route::get('/admin/export-employees', 'Admin\JoinEmployeeController@exportEmployees')->name('admin.export-employees');


    /// END EMPLOYMENT CHECK LIST ROUTE

    /// VENDORS ROUTES
    route::get('/admin/all-vendors', 'Admin\VendorController@allVendor')->name('admin.all-vendors');
    route::get('/admin/add-vendor', 'Admin\VendorController@addVendor')->name('admin.add-vendor');
    route::post('/admin/add-vendor-post', 'Admin\VendorController@addVendorPost')->name('admin.add-vendor-post');
    route::get('/admin/update-vendor-view/{vendorId}', 'Admin\VendorController@updateVendor')->name('admin.update-vendor-view');
    route::post('/admin/update-vendor-post/{vendorId}', 'Admin\VendorController@updateVendorPost')->name('admin.update-vendor-post');
    route::get('/admin/download-attach-file/{vendorId}', 'Admin\VendorController@downloadAttachFile')->name('admin.download-attach-file');
    route::get('/admin/export-vendor', 'Admin\VendorController@exportVendor')->name('admin.export-vendor');
    /// END VENDORS ROUTES

    /// inventory management
    route::get('/admin/all-inventories', 'Admin\InventoryController@allInventories')->name('admin.all-inventories');
    route::get('/admin/add-inventory', 'Admin\InventoryController@createInventory')->name('admin.add-inventory');
    route::get('/admin/add-inventory/{inventoryId}', 'Admin\InventoryController@editInventory')->name('admin.edit-inventory');
    route::post('/admin/post-inventory', 'Admin\InventoryController@addInventroyPost')->name('admin.post-inventory-add');
    route::post('/admin/post-inventory/{inventoryId}', 'Admin\InventoryController@updateInventroyPost')->name('admin.post-inventory-update');
    route::get('/admin/assign-inventory/{inventoryId}', 'Admin\InventoryController@viewInventroyAssign')->name('admin.view-inventory');
    route::post('/admin/assign-inventory-post', 'Admin\InventoryController@assignInventroyPost')->name('admin.assign-inventory-post');

    ///
    /// inventory management
    route::get('/admin/all-expenses', 'Admin\ExpenseController@allExpenses')->name('admin.all-expenses');
    route::get('/admin/add-expense', 'Admin\ExpenseController@addExpense')->name('admin.add-expense');
    route::get('/admin/view-expense/{expId}', 'Admin\ExpenseController@editExpenseView')->name('admin.view-expense');
    route::get('/admin/delete-expense/{expId}', 'Admin\ExpenseController@deleteExpense')->name('admin.delete-expense');
    route::post('/admin/post-expense-add', 'Admin\ExpenseController@postExpense')->name('admin.post-expense-add');
    route::post('/admin/post-edit-expense-add/{expId}', 'Admin\ExpenseController@postEditExpense')->name('admin.post-edit-expense-add');
    route::get('/admin/download--file/{expId}', 'Admin\ExpenseController@downloadFile')->name('admin.download-exp-file');
    route::get('/admin/export-expenses', 'Admin\ExpenseController@exportExpenses')->name('admin.export-expenses');
    route::get('/admin/search-expenses', 'Admin\ExpenseController@searchExpenses')->name('admin.search-expenses');
    route::get('/admin/exp-emp', 'Admin\ExpenseController@empExpenses')->name('admin.exp-emp');
    route::get('/admin/exp-cat/{typeID}', 'Admin\ExpenseController@catExpenses')->name('admin.exp-cat');
    route::get('/admin/exp-type', 'Admin\ExpenseController@typeExpenses')->name('admin.exp-type');

    /// CONTENT MANAGEMENT ROUTES
    /// NEW CONTENT ROUTES
    route::get('/admin/all-ideas', 'Admin\ContentController@allIdeas')->name('admin.all-ideas');
    route::get('/admin/add-idea', 'Admin\ContentController@addIdea')->name('admin.add-idea');
    route::post('/admin/post-idea', 'Admin\ContentController@postIdea')->name('admin.post-idea');
    route::get('/admin/edit-idea/{ideaId}', 'Admin\ContentController@editIdea')->name('admin.edit-idea');
    route::post('/admin/post-update-idea/{ideaId}', 'Admin\ContentController@updateIdea')->name('admin.post-update-idea');

    route::get('/admin/all-plans', 'Admin\ContentController@allPlans')->name('admin.all-plans');
    route::get('/admin/create-plan', 'Admin\ContentController@createPlan')->name('admin.create-plan');
    route::post('/admin/add-content-cat', 'Admin\ContentController@addContentCat')->name('admin.add-content-cat');
    route::post('/admin/post-content-plan', 'Admin\ContentController@postContentPlan')->name('admin.post-content-plan');
    route::get('/admin/edit-plan/{planId}', 'Admin\ContentController@editPlan')->name('admin.edit-plan');
    route::post('/admin/edit-plan-post/{planId}', 'Admin\ContentController@editPlanPost')->name('admin.edit-plan-post-update');
    route::post('/admin/produce-plan-post/{planId}', 'Admin\ContentController@producePlanPost')->name('admin.produce-plan-post-update');

    route::get('/admin/download-source-file/{mediaId}', 'Admin\ContentController@downloadFile')->name('admin.download-source-file');

    route::get('/admin/produce-plan/{planId}', 'Admin\ContentController@producePlan')->name('admin.produce-plan');
    route::get('/admin/platform-page/{platFormId}/{planId}', 'Admin\ContentController@producePlanPlatform')->name('admin.platform-page');
    route::post('/admin/produce-plan-history/{planId}', 'Admin\ContentController@producePlanHistory')->name('admin.produce-plan-history');
//    route::post('/admin/produce-plan-history/{hisId}', 'Admin\ContentController@planHistory')->name('admin.produce-plan-history');

    // allProcess
    route::get('/admin/all-process', 'Admin\ContentController@allContentGeneration')->name('admin.all-content-generation');
    route::get('/admin/all-process-view/{planId}', 'Admin\ContentController@allContentGenerationView')->name('admin.all-content-generation-view');
    route::post('/admin/process-post/{planId}', 'Admin\ContentController@editProcessPost')->name('admin.process-post');

    //SEO Content
    route::get('/admin/all-seo', 'Admin\ContentController@allSEOList')->name('admin.all-seo');
    route::get('/admin/seo-view/{planId}', 'Admin\ContentController@seoView')->name('admin.seo-view');
    route::post('/admin/seo-post/{planId}', 'Admin\ContentController@editSeoPost')->name('admin.seo-post');

    //SEO Content
    route::get('/admin/all-review', 'Admin\ContentController@allReview')->name('admin.all-review');
    route::get('/admin/all-review-view/{planId}', 'Admin\ContentController@allReviewView')->name('admin.all-review-view');
    route::post('/admin/review-post/{planId}', 'Admin\ContentController@editReviewPost')->name('admin.review-post');

    //Publish Content
    route::get('/admin/all-ready-to-publish', 'Admin\ContentController@allPublish')->name('admin.all-publish');
    route::get('/admin/all-publish-view/{planId}', 'Admin\ContentController@allPublishView')->name('admin.all-publish-view');
    route::post('/admin/publish-post/{planId}', 'Admin\ContentController@editPublishPost')->name('admin.content-publish-post');

    ///ALL PUBLISHED
    route::get('/admin/all-published', 'Admin\ContentController@allPublished')->name('admin.all-published');
    route::get('/admin/all-published-view/{planId}', 'Admin\ContentController@allPublishedView')->name('admin.all-published-view');
    route::post('/admin/published-post/{planId}', 'Admin\ContentController@editPublishedPost')->name('admin.content-published-post');


    ///ALL CONTENT
    route::get('/admin/all-contents', 'Admin\ContentController@allContents')->name('admin.all-contents');


    // Platforms
    route::get('/admin/platform-seo/{platFormId}/{planId}/{platUsedId}', 'Admin\ContentController@seoPlanPlatform')->name('admin.platform-seo');
    route::get('/admin/platform-process/{platFormId}/{planId}/{platUsedId}', 'Admin\ContentController@processPlanPlatform')->name('admin.platform-process');
    route::get('/admin/platform-review/{platFormId}/{planId}/{platUsedId}', 'Admin\ContentController@reviewPlanPlatform')->name('admin.platform-review');
    route::get('/admin/platform-publish/{platFormId}/{planId}/{platUsedId}', 'Admin\ContentController@publishPlanPlatform')->name('admin.platform-publish');


    ///YouTube
    route::post('/admin/post-youtube-add-process', 'Admin\PlatFormController@youTubePlatformProcess')->name('admin.post-youtube-add-process');
    route::post('/admin/post-youtube-review-process', 'Admin\PlatFormController@youTubePlatformReviewProcess')->name('admin.post-youtube-review-process');
    route::post('/admin/post-youtube-add-seo', 'Admin\PlatFormController@youTubePlatformSEO')->name('admin.post-youtube-add-seo');
    route::post('/admin/post-youtube-review-seo', 'Admin\PlatFormController@youTubePlatformReviewSEO')->name('admin.post-youtube-review-seo');
    route::post('/admin/post-youtube-add-publish', 'Admin\PlatFormController@youTubePlatformPublish')->name('admin.post-youtube-add-publish');
    route::post('/admin/post-youtube-status-seo', 'Admin\PlatFormController@hisStatusSEO')->name('admin.post-youtube-status-seo');
    route::post('/admin/post-youtube-status-process', 'Admin\PlatFormController@hisStatusProcess')->name('admin.post-youtube-status-process');


    Route::get('/admin/update-emp-to-user', 'Admin\JoinEmployeeController@createUsers')->name('admin.update-emp-to-user');
});


//Route::group(['middleware' => 'CheckEmpolyee'], function () {
//
//
//});
//
//
//Route::group(['middleware' => 'CheckGuest'], function () {
//
//
//});
