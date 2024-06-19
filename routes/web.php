<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PDFController;


Route::get('/', function () {
    return view('task.index');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/roles', [RoleController::class, 'index'])->name('roles');
Route::put('/roles/{id}', [RoleController::class, 'updateRole'])->name('updateRole');

Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

Route::middleware(['auth'])->group(function () {
    Route::get('/reportes/crear', [ReportController::class, 'create'])->name('reportes.create');
    Route::post('/reportes', [ReportController::class, 'store'])->name('reportes.store');
    Route::get('/reportes/{id}/editar', [ReportController::class, 'edit'])->name('reportes.edit');
    Route::put('/reportes/{id}', [ReportController::class, 'update'])->name('reportes.update');
    Route::delete('/reportes/{id}', [ReportController::class, 'destroy'])->name('reportes.destroy');
    Route::get('/reportes', [ReportController::class, 'index'])->name('reportes.index');
    Route::put('/reportes/{id}/estatus', [ReportController::class, 'updateStatus'])->name('reportes.updateStatus');
Route::get('/reportes/pdf/{id}', [PDFController::class, 'verPDF'])->name('reportes.pdf');

Route::get('/reportes/pdf/{id}', [PDFController::class, 'verPDF'])->name('reportes.pdf');
});
