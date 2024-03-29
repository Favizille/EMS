<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;

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

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// Exam Routes
Route::post('/exam/create', [ExamController::class, 'createExam']);
Route::get('exam/{examId}', [ExamController::class, 'getExam']);
Route::put('/exam/update/{examId}', [ExamController::class, 'updateExam']);
Route::delete('/exam/delete/{examId}', [ExamController::class, 'deleteExam']);

// Result Route
Route::post('/result/create', [ResultController::class, 'createResult']);
Route::get('result/{examId}', [ResultController::class, 'getResult']);
Route::put('/result/{examId}', [ResultController::class, 'updateResult']);
Route::delete('result/delete/{examId}', [ResultController::class, 'deleteResult']);