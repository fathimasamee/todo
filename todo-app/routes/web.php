<?php
Route::get('/', function () {
    return redirect('/tasks');
});

Route::get('/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
Route::post('/tasks', 'App\Http\Controllers\TaskController@store')->name('tasks.store');
Route::put('/tasks/{task}', 'App\Http\Controllers\TaskController@update')->name('tasks.update');
Route::delete('/tasks/{task}', 'App\Http\Controllers\TaskController@destroy')->name('tasks.destroy');
// Added new routes for the new features
Route::post('/tasks/{task}/toggle', 'App\Http\Controllers\TaskController@toggle')->name('tasks.toggle');
Route::post('/tasks/clear-completed', 'App\Http\Controllers\TaskController@clearCompleted')->name('tasks.clear-completed');

