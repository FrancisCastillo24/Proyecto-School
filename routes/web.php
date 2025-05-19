<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {

    // Vista principal usuario
    Route::get('/homeUser', function () {
        return view('homeUser');
    })->name('homeUser');

    // Vista principal administrador
    Route::get('/admin', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acceso no autorizado');
        }
        return view('homeAdmin');
    })->name('homeAdmin');
});

    // Vista principal usuario
    Route::get('/', function () {
        return view('homeUser');
    })->name('homeUser');


// Rutas para estudiante (acceso general)
Route::resource('student', StudentController::class);

// Prefijo para rutas de administrador (esto puede requerir control adicional)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('student', StudentController::class);
});

Auth::routes();
