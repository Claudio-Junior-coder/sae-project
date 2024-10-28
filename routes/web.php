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


//activities
Route::get('/activities', function () {
    return Inertia::render('Activities/ActivityList');
})->middleware(['auth', 'verified'])->name('activities');

Route::get('/activities/details/{id?}', function ($id = null) {
    return Inertia::render('Activities/ActivityDetails', [
        'activityId' => $id
    ]);
})->middleware(['auth', 'verified'])->name('activities.details');


//behaviors
Route::get('/behaviors', function () {
    return Inertia::render('Behaviors/BehaviorList');
})->middleware(['auth', 'verified'])->name('behaviors');

Route::get('/behaviors/details/{id?}', function ($id = null) {
    return Inertia::render('Behaviors/BehaviorDetails', [
        'behaviorId' => $id
    ]);
})->middleware(['auth', 'verified'])->name('behaviors.details');

//classes
Route::get('/classes', function () {
    return Inertia::render('Classes/ClassList');
})->middleware(['auth', 'verified'])->name('classes');

Route::get('/classes/details/{id?}', function ($id = null) {
    return Inertia::render('Classes/ClassDetails', [
        'classId' => $id
    ]);
})->middleware(['auth', 'verified'])->name('classes.details');


//grades
Route::get('/grades', function () {
    return Inertia::render('Grades/GradeList');
})->middleware(['auth', 'verified'])->name('grades');

Route::get('/grades/details/{id?}', function ($id = null) {
    return Inertia::render('Grades/GradeDetails', [
        'gradeId' => $id
    ]);
})->middleware(['auth', 'verified'])->name('grades.details');


require __DIR__.'/auth.php';
