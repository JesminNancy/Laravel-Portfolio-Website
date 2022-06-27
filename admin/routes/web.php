<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@HomeIndex')->middleware('LoginCheck');
Route::get('/visitor', 'VisitorController@VisitorIndex')->middleware('LoginCheck');


//Admin Panel Service Management
Route::get('/service', 'ServiceController@ServiceIndex')->middleware('LoginCheck');
Route::get('/getServicesData', 'ServiceController@getServicesData')->middleware('LoginCheck');
Route::post('/serviceDelete', 'ServiceController@deleteService')->middleware('LoginCheck');
Route::post('/serviceDetails', 'ServiceController@getServicesDetails')->middleware('LoginCheck');
Route::post('/serviceUpdate', 'ServiceController@serviceUpdate')->middleware('LoginCheck');
Route::post('/serviceAdd', 'ServiceController@serviceAdd')->middleware('LoginCheck');

//Admin Panel Course Management
Route::get('/Courses', 'CoursesController@CoursesIndex')->middleware('LoginCheck');
Route::get('/getCoursesData', 'CoursesController@getCoursesData')->middleware('LoginCheck');
Route::post('/CoursesDelete', 'CoursesController@deleteCourses')->middleware('LoginCheck');
Route::post('/CoursesDetails', 'CoursesController@getCoursesDetails')->middleware('LoginCheck');
Route::post('/CoursesUpdate', 'CoursesController@CoursesUpdate')->middleware('LoginCheck');
Route::post('/CoursesAdd', 'CoursesController@CoursesAdd')->middleware('LoginCheck');

//Admin Panel Projects Management
Route::get('/Projects', 'ProjectController@ProjectsIndex')->middleware('LoginCheck');
Route::get('/getProjectsData', 'ProjectController@getProjectsData')->middleware('LoginCheck');
Route::post('/ProjectsDelete', 'ProjectController@deleteProjects')->middleware('LoginCheck');
Route::post('/ProjectsDetails', 'ProjectController@getProjectsDetails')->middleware('LoginCheck');
Route::post('/ProjectsUpdate', 'ProjectController@ProjectsUpdate')->middleware('LoginCheck');
Route::post('/ProjectsAdd', 'ProjectController@ProjectsAdd')->middleware('LoginCheck');


//Admin Panel HomeContact Management
Route::get('/contactHome', 'ContactController@ContactIndex')->middleware('LoginCheck');
Route::get('/getContactData', 'ContactController@getContactData')->middleware('LoginCheck');
Route::post('/deleteContact', 'ContactController@deleteContact')->middleware('LoginCheck');

//Admin Panel Review Management
Route::get('/Review', 'ReviewController@ReviewIndex')->middleware('LoginCheck');
Route::get('/getReviewData', 'ReviewController@getReviewData')->middleware('LoginCheck');
Route::post('/ReviewDetails', 'ReviewController@getReviewDetails')->middleware('LoginCheck');
Route::post('/deleteReview', 'ReviewController@ReviewDelete')->middleware('LoginCheck');
Route::post('/reviewUpdate', 'ReviewController@reviewUpdate')->middleware('LoginCheck');
Route::post('/reviewAdd', 'ReviewController@reviewAdd')->middleware('LoginCheck');

//Admin Login System
Route::get('/Login', 'LoginController@LoginIndex');
Route::post('/OnLogin', 'LoginController@OnLogin');
Route::get('/LogOut', 'LoginController@OnLogOut');


Route::get('/Photo', 'PhotoController@PhotoIndex');
Route::post('/PhotoUpload', 'PhotoController@PhotoUpload');