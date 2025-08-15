<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;



Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/about', fn() => view('about'))->name('about');

Route::get('/archivo/{propietario}/{tipo_archivo}', [FileController::class, 'show'])
    ->middleware('auth')
    ->name('archivo.show');


Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
    // Grupo de rutas para el perfil
    Route::prefix('perfil')->name('perfil.')->group(function () {
        Route::get('/', [PerfilController::class, 'show'])->name('show');
        Route::get('/{id}', [PerfilController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PerfilController::class, 'update'])->name('update');
    });

    // Grupo de rutas para solicitudes
    Route::prefix('solicitudes')->name('solicitud.')->group(function () {
        Route::get('/', [SolicitudController::class, 'index'])->name('index');
        Route::get('/create', [SolicitudController::class, 'create'])->name('create');
        Route::post('/', [SolicitudController::class, 'store'])->name('store');
        Route::get('/{solicitud}', [SolicitudController::class, 'show'])->name('show');
        Route::get('/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('edit');
        Route::put('/{solicitud}', [SolicitudController::class, 'update'])->name('update');
    });

    // Grupo de rutas para notificaciones
    Route::prefix('notificaciones')->name('notificaciones.')->group(function () {
        Route::get('/', [NotificacionController::class, 'index'])->name('index');
        Route::get('/{id}', [NotificacionController::class, 'show'])->name('show');
    });

    // Grupo de rutas para el profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    // Rutas específicas para el rol de administrador
        Route::prefix('usuarios')->name('usuarios.')->group(function () {
            Route::get('/', [PerfilController::class, 'index'])->name('index');
            Route::get('/{id}', [PerfilController::class, 'show'])->name('show');
        });
});

require __DIR__ . '/auth.php';
