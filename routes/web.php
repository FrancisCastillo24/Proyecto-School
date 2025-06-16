<?php

use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Ruta pública para Home (sin autenticación)
Route::get('/', function () {
    return view('homeUser');  // Vista pública de inicio
})->name('home');

// Rutas públicas
Route::resource('course', CourseController::class)->only(['index', 'show']);
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
Route::resource('event', EventController::class);
Route::view('/blog', 'user.blog.index')->name('blog.index');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    Route::resource('booking', BookingController::class);

    Route::get('/homeUser', [HomeController::class, 'index'])->name('homeUser');
    Route::get('/admin', [HomeController::class, 'homeAdmin'])->name('homeAdmin');

    Route::resource('student', StudentController::class);

    // Rutas de review protegidas (excepto index y create que son públicas)
    Route::resource('review', ReviewController::class)->except(['index', 'create']);

    // Rutas de administración protegidas y agrupadas bajo el prefijo admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('student', StudentController::class);
        Route::resource('review', ReviewController::class);
        Route::resource('event', EventController::class);
        Route::resource('booking', BookingController::class);
        Route::resource('transaction', TransactionController::class);
        Route::get('users/pending', [UserApprovalController::class, 'pending'])->name('users.pending');
        Route::post('users/{user}/approve', [UserApprovalController::class, 'approve'])->name('users.approve');
        Route::delete('users/{user}', [UserApprovalController::class, 'destroy'])->name('users.destroy');

    });
});

Auth::routes();
