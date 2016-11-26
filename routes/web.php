<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('', 'HomeController@index');

Route::get('/settings', 'SettingsController@index');
Route::post('/settings/save', 'SettingsController@save');

Route::get('/projects', 'ProjectsController@index');

Route::get('/issues', 'ProjectController@index');

Route::get('/issue', 'IsueController@index');

Route::get('/tracker', 'TrackerController@index');
