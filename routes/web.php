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
Route::get('/updateEvent/{id}', 'CalendarController@edit' );
Route::get('/repeatEvent/{id}', 'CalendarController@showRepeatEvent' );
Route::get('/updateRepeatEvent/{id}', 'CalendarController@editRepeatEvent');
Route::patch('/repeatUpdate/{id}', 'CalendarController@updateRepeatEvent');
Route::get('/deleteEvent/{id}', 'CalendarController@destroy' );
Route::get('/deleteRepeatEvent/{id}', 'CalendarController@destroyRepeat' );


//Event
Route::get('/event', 'CalendarController@index');

//Group
Route::get('/group', 'GroupController@index');
Route::get('/group/add-group', 'GroupController@addGroup');

Route::get('/group/{id}', 'GroupController@groupCalendar');
Route::get('/group/{id}/shareEvent', 'GroupController@groupShareEvent');
Route::post('/group/store-group', 'GroupController@storeGroup');
Route::post('/group/{id}/shareEvent/performSharing', 'GroupController@performShare');
Route::get('/group/{id}/edit-group', 'GroupController@editGroup');
Route::post('/group/{id}/update-group', 'GroupController@updateGroup');
Route::get('/group/{id}/add-member', 'GroupController@addMember');
Route::post('/group/{id}/add-member/store', 'GroupController@storeMember');
Route::get('/group/{id}/view-member', 'GroupController@viewMember');
Route::post('/group/{id}/view-member/update', 'GroupController@updateMember');
Route::get('/group/{id}/leave-group', 'GroupController@leaveGroup');
Route::resource('group', 'GroupController');

//Home
Route::get('/home', 'CalendarController@home');
Route::get('/logout', 'HomeController@logout');
