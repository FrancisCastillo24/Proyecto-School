<?php

use App\Http\Controllers\Admin\UserApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('homeUser');
})->name('homeUser');

Route::middleware('auth')->group(function () {

    Route::get('/homeUser', function () {
        return view('homeUser');
    })->name('homeUser.auth');

    Route::get('/admin', function () {
        $user = auth()->user();
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Acceso no autorizado');
        }
        return view('homeAdmin');
    })->name('homeAdmin');

    // Rutas para estudiante sin validación de rol en rutas
    Route::resource('student', StudentController::class);

    // Rutas admin prefix
    Route::prefix('admin')->name('admin.')->group(function () {
        // Resource estudiantes admin
        Route::resource('student', StudentController::class);

        // Rutas para usuarios pendientes y aprobar
        Route::get('users/pending', [UserApprovalController::class, 'pending'])->name('users.pending');
        Route::post('users/{user}/approve', [UserApprovalController::class, 'approve'])->name('users.approve');
    });
});

Auth::routes();
