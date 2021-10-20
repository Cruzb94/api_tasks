<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('signup', [App\Http\Controllers\AuthController::class, 'signUp'])->name('signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::get('/user', [App\Http\Controllers\AuthController::class, 'user'])->name('user');
        Route::post('save-task',[App\Http\Controllers\TaskController::class, 'saveTask'])->name('save-task');
        Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'getTasks'])->name('tasks');
        Route::get('/tasks-completed', [App\Http\Controllers\TaskController::class, 'getTasksCompleted'])->name('tasks-completed');
        Route::post('/update-task', [App\Http\Controllers\TaskController::class, 'updateTask'])->name('update-task');
        Route::post('/delete', [App\Http\Controllers\TaskController::class, 'deleteTask'])->name('delete');
    });
});
