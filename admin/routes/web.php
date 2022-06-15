<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@HomeIndex');
Route::get('/visitor', 'VisitorController@VisitorIndex');
Route::get('/service', 'ServiceController@ServiceIndex');
Route::get('/getServicesData', 'ServiceController@getServicesData');
Route::post('/serviceDelete', 'ServiceController@deleteService');