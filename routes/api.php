<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/task', [TasksController::class, 'addTask'])->middleware('api');
    Route::put('/task/{id}', [TasksController::class, 'updateTask'])->middleware('api');
    Route::delete('/task/{id}', [TasksController::class, 'deleteTask'])->middleware('api');
    Route::get('/tasks', [TasksController::class, 'getAllTasks'])->middleware('api');
    Route::get('/tasks/{id}', [TasksController::class, 'getTasksByUserId'])->middleware('api');
});


