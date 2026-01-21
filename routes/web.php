<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AdminUserPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard principal (todos los roles autenticados)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de asistencia (todos los roles)
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('checkin');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('checkout');
        Route::get('/history', [AttendanceController::class, 'history'])->name('history');
    });

    // Rutas para profesores y administradores
    Route::middleware(['role:profesor,administrador'])->group(function () {
        Route::get('/attendances/all', [AttendanceController::class, 'all'])->name('attendance.all');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    });

    // Rutas solo para administradores
    Route::middleware(['role:administrador'])->prefix('admin')->name('admin.')->group(function () {
        // Gestión de usuarios, etc. (para futuro)
         Route::get('/users', [AdminUserPanelController::class, 'index'])->name('userPanel');
         Route::get('/users/search', [AdminUserPanelController::class, 'search'])->name('userPanel.search');

    });
});

require __DIR__.'/auth.php';
