<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BehaviorController;
use App\Http\Controllers\ClassromController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\Auth\ResponsibleAuthController;

Route::prefix('responsibles')->group(function () {
    Route::post('login', [ResponsibleAuthController::class, 'login']);
    Route::post('logout', [ResponsibleAuthController::class, 'logout'])->middleware('auth:sanctum');
});

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

    Route::get('/classes', [ClassromController::class, 'index']);
    Route::get('/classes/{classroom}', [ClassromController::class, 'show']);
    Route::post('/classes', [ClassromController::class, 'store']);
    Route::put('/classes/{classroom}', [ClassromController::class, 'update']);
    Route::delete('/classes/{id}', [ClassromController::class, 'destroy']);

    Route::get('/grades', [GradeController::class, 'index']);
    Route::get('/grades/{grade}', [GradeController::class, 'show']);
    Route::post('/grades', [GradeController::class, 'store']);
    Route::put('/grades/{grade}', [GradeController::class, 'update']);
    Route::delete('/grades/{id}', [GradeController::class, 'destroy']);

    Route::get('/responsibles', [ResponsibleController::class, 'index']);
    Route::get('/responsibles/{responsible}', [ResponsibleController::class, 'show']);
    Route::post('/responsibles', [ResponsibleController::class, 'store']);
    Route::put('/responsibles/{responsible}', [ResponsibleController::class, 'update']);
    Route::delete('/responsibles/{id}', [ResponsibleController::class, 'destroy']);
});