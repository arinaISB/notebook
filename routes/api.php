<?php

use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\NotebookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/v1/notebooks', [NotebookController::class, 'getAll']);
Route::post('/v1/notebooks', [NotebookController::class, 'create']);
Route::get('/v1/notebooks/{id}', [NotebookController::class, 'getOneById']);
Route::post('/v1/notebooks/photo', [ImageUploadController::class, 'upload']);
Route::patch('/v1/notebooks/{id}', [NotebookController::class, 'update']);
Route::delete('/v1/notebooks/{id}', [NotebookController::class, 'delete']);
