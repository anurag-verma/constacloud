<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
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
Route::post('/login', [APIController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    // Protected routes

    Route::get('/getStudents{class?}{data?}', [APIController::class, 'getStudents']);
    Route::post('/users', [APIController::class, 'store']);
    // ...
});
