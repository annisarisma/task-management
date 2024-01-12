<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'register_index');
    Route::post('/register/store', 'register_store');
    Route::get('/login', 'login_index')->name('login');
    Route::post('/login/store', 'login_store');
    Route::post('/logout', 'logout');
});
Route::controller(ProjectController::class)->group(function () {
    Route::get('/project', 'index');
    Route::get('/project/project-create', 'create');
    Route::post('/project/project-store', 'store');
    Route::get('/project/project-detail/{id}', 'show');
});
Route::controller(TaskController::class)->group(function () {
    Route::get('/task', 'index');
    Route::get('/task/task_project/{id}', 'filter');
});
