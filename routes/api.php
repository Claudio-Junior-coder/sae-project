<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BehaviorController;

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

    Route::get('/activities', [ActivityController::class, 'index']);
    Route::get('/activities/{activity}', [ActivityController::class, 'show']);
    Route::post('/activities', [ActivityController::class, 'store']);
    Route::put('/activities/{activity}', [ActivityController::class, 'update']);
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy']);

    Route::get('/behaviors', [BehaviorController::class, 'index']);
    Route::get('/behaviors/{behavior}', [BehaviorController::class, 'show']);
    Route::post('/behaviors', [BehaviorController::class, 'store']);
    Route::put('/behaviors/{behavior}', [BehaviorController::class, 'update']);
    Route::delete('/behaviors/{id}', [BehaviorController::class, 'destroy']);
});