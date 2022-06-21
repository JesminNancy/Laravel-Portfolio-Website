<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@HomeIndex');
Route::get('/visitor', 'VisitorController@VisitorIndex');


//Admin Panel Service Management
Route::get('/service', 'ServiceController@ServiceIndex');
Route::get('/getServicesData', 'ServiceController@getServicesData');
Route::post('/serviceDelete', 'ServiceController@deleteService');
Route::post('/serviceDetails', 'ServiceController@getServicesDetails');
Route::post('/serviceUpdate', 'ServiceController@serviceUpdate');
Route::post('/serviceAdd', 'ServiceController@serviceAdd');

//Admin Panel Course Management
Route::get('/Courses', 'CoursesController@CoursesIndex');
Route::get('/getCoursesData', 'CoursesController@getCoursesData');
Route::post('/CoursesDelete', 'CoursesController@deleteCourses');
Route::post('/CoursesDetails', 'CoursesController@getCoursesDetails');
Route::post('/CoursesUpdate', 'CoursesController@CoursesUpdate');
Route::post('/CoursesAdd', 'CoursesController@CoursesAdd');