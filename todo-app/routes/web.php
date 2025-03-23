<?php
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/tasks');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index')->name('tasks.index');
    Route::post('/tasks', 'store')->name('tasks.store');
    Route::put('/tasks/{task}', 'update')->name('tasks.update');
    Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    Route::post('/tasks/{task}/toggle', 'toggle')->name('tasks.toggle');
    Route::post('/tasks/clear-completed', 'clearCompleted')->name('tasks.clear-completed');
});
