<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\UserApprovalController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('homeUser'))->name('home');

Route::resource('course', CourseController::class)->only(['index', 'show']);
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
Route::resource('event', EventController::class);
Route::view('/blog', 'user.blog.index')->name('blog.index');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Panel de usuario
    Route::get('/homeUser', [HomeController::class, 'index'])->name('homeUser');

    // Panel de administrador (control de acceso se debe hacer en el controlador)
    Route::get('/admin', [HomeController::class, 'homeAdmin'])->name('homeAdmin');

    // Recursos generales accesibles para usuarios autenticados
    Route::resource('booking', BookingController::class);
    Route::resource('student', StudentController::class);
    Route::resource('review', ReviewController::class)->except(['index', 'create']);

    /*
    |--------------------------------------------------------------------------
    | Rutas de Administración (Prefijo: /admin, Nombre: admin.*)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('student', StudentController::class);
        Route::resource('review', ReviewController::class);
        Route::resource('event', EventController::class);
        Route::resource('booking', BookingController::class);
        Route::resource('transaction', TransactionController::class);

        // Gestión de aprobación de usuarios
        Route::get('users/pending', [UserApprovalController::class, 'pending'])->name('users.pending');
        Route::post('users/{user}/approve', [UserApprovalController::class, 'approve'])->name('users.approve');
        Route::delete('users/{user}', [UserApprovalController::class, 'destroy'])->name('users.destroy');
    });
});
