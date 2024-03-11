<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/create-application', [ApplicationController::class, 'create']);
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/applications/{id}', [ApplicationController::class, 'update']);
});

Route::get('/applications/filter', [AdminController::class, 'sortApplications']);
Route::get('/applications', [AdminController::class, 'getAll']);
