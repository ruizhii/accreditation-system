<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssessorController;
use App\Http\Controllers\AssessorProgrammeController;
use App\Http\Controllers\AssessorProgrammeSectionController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('assessors')->group(function () {
    Route::get('/login', [AssessorController::class, 'loginPage'])->name('assessors.login.page');
    Route::get('/register', [AssessorController::class, 'registerPage'])->name('assessors.register.page');

    Route::post('/login', [AssessorController::class, 'login'])->name('assessors.login');
    Route::post('/register', [AssessorController::class, 'register'])->name('assessors.register');

    Route::post('/logout', [AssessorController::class, 'logout'])->name('assessors.logout');
});

Route::middleware(['assessor'])->group(function () {
    Route::prefix('assessors')->group(function () {
        Route::get('/profile', [AssessorController::class, 'profile'])->name('assessors.profile');
        Route::post('/profile', [AssessorController::class, 'profileUpdate'])->name('assessors.profile.update');

        Route::get('/index', [AssessorController::class, 'index'])->name('assessors.index');

        Route::get('/reference', [AssessorController::class, 'reference'])->name('assessors.reference');

        Route::get('/programme/{id}', [AssessorProgrammeController::class, 'show'])->name('assessors.programme.show');
        Route::get('/programme/{id}/summary', [AssessorProgrammeController::class, 'summary'])->name('assessors.programme.summary');
        Route::post('/programme/{id}', [AssessorProgrammeController::class, 'updateStatus'])->name('assessors.programme.updateStatus');

        Route::get('/programme/{programme_id}/section/{id}', [AssessorProgrammeSectionController::class, 'show'])->name('assessors.programme.section.show');
        Route::post('/programme/{programme_id}/section/{id}', [AssessorProgrammeSectionController::class, 'store'])->name('assessors.programme.section.store');
    });
});


require __DIR__ . '/auth.php';
