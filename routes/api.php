<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PeriodController;


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{student}', [StudentController::class, 'show']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{student}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    Route::get('/periods', [PeriodController::class, 'index']);
    Route::get('/periods/{period}', [PeriodController::class, 'show']);
    Route::post('/periods', [PeriodController::class, 'store']);
    Route::put('/periods/{period}', [PeriodController::class, 'update']);
    Route::delete('/periods/{id}', [PeriodController::class, 'destroy']);
});