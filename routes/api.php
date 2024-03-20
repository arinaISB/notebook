<?php

use App\Http\Controllers\NotebookController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/v1/notebook', [NotebookController::class, 'getAll']);
Route::get('/v1/notebook/create', [NotebookController::class, 'getCreateForm']);
Route::post('/v1/notebook', [NotebookController::class, 'create'])->name('notebook.create');

