<?php

use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    // Rutas para ver el perfil del usuario
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/{id}', [PerfilController::class, 'edit'])->name('perfil.edit');

    //Rutas para el CRUD de las solicitudes
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitud.index');
    Route::get('/solicitud/create', [SolicitudController::class, 'create'])->name('solicitud.create');
    Route::post('/solicitud', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitud.show');
    Route::get('/solicitudes/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('solicitud.edit');
    Route::put('/solicitudes/{solicitud}', [SolicitudController::class, 'update'])->name('solicitud.update');

    Route::get('/notificaciones/', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::get('/notificaciones/{id}', [NotificacionController::class, 'show'])->name('notificaciones.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
