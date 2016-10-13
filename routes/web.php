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

Route::get('/', 'HomeController@index');
Auth::routes();
Route::resource('home', 'HomeController');
Route::resource('settings', 'SettingsController');
Route::resource('routine', 'RoutineController');
Route::resource('event', 'EventsController');
Route::resource('group', 'GroupController');
Route::get('/home/settings', 'HomeController@settings');
