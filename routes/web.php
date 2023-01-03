<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProjectController::class, 'index']);

Route::get('/project', [ProjectController::class, 'index']);
Route::get('/project/{id}/edit', [ProjectController::class, 'edit']);
Route::put('/project/{id}', [ProjectController::class, 'update']);
Route::post('/project', [ProjectController::class, 'store']);
Route::post('/project/delete/{id}', [ProjectController::class, 'destroy']);


Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'store']);
