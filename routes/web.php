<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
    return view('student-management');
});

Route::post('save-student', [StudentController::class, 'saveStudent'])->name('saveStudent');

Route::post('students-list', [StudentController::class, 'getStudents'])->name('getStudentsList');
