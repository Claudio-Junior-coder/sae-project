<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//students
Route::get('/students', function () {
    return Inertia::render('Students/StudentList');
})->middleware(['auth', 'verified'])->name('students');

Route::get('/students/details/{id?}', function ($id = null) {
    return Inertia::render('Students/StudentDetails', [
        'studentId' => $id
    ]);
})->middleware(['auth', 'verified'])->name('students.details');

//periods
Route::get('/periods', function () {
    return Inertia::render('Periods/PeriodList');
})->middleware(['auth', 'verified'])->name('periods');

Route::get('/periods/details/{id?}', function ($id = null) {
    return Inertia::render('Periods/PeriodDetails', [
        'periodId' => $id
    ]);
})->middleware(['auth', 'verified'])->name('periods.details');


require __DIR__.'/auth.php';
