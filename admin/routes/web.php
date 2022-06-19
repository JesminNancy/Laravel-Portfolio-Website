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