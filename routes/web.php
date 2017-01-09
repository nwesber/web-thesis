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
Route::auth();

//Routine
Route::get('/', 'RoutineController@index');
Route::get('/routine/add-routine/', 'RoutineController@addRoutine');
Route::get('/routine/add-routine/', 'RoutineController@addRoutine');
Route::post('/routine/store-routine/', 'RoutineController@storeRoutine');
Route::get('/routine/{id}/edit', 'RoutineController@editRoutine');
Route::post('/routine/{id}/updateRoutine', 'RoutineController@updateRoutine');
Route::get('/routine/{id}/delete', 'RoutineController@deleteRoutine');


//Task
Route::get('routine/{id}/task', 'TaskController@task');
Route::get('routine/{id}/task/add-task/', 'TaskController@addTask');
Route::post('routine/{id}/task/store-task/', 'TaskController@storeTask');
Route::get('routine/{id}/task/task-details/{id2}', 'TaskController@taskDetails');
Route::get('routine/{id}/task/task-details/{id2}/edit', 'TaskController@taskEdit');
Route::post('routine/{id}/task/task-details/{id2}/updateTask', 'TaskController@updateTask');
Route::get('routine/{id}/task/task-details/{id2}/delete', 'TaskController@taskDelete');
Route::resource('routine', 'RoutineController');

Route::resource('event', 'CalendarController');

Route::post('/createEvent',['uses'=>'CalendarController@store','as'=>'createEvent']);

//Home
Route::get('/logout', 'HomeController@logout');

