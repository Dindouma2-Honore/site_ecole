<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/ambassadeur', [SiteController::class, 'ambassador'])->name('ambassador');
Route::get('/visite-mission', [SiteController::class, 'visitMission'])->name('visit.mission');
Route::get('/equipe-administrative', [SiteController::class, 'adminTeam'])->name('admin.team');
Route::get('/conditions-adhesion', [SiteController::class, 'conditions'])->name('conditions');
Route::get('/frais-scolarite', [SiteController::class, 'fees'])->name('fees');
Route::get('/inscriptions', [SiteController::class, 'registrations'])->name('registrations');
Route::get('/formations', [SiteController::class, 'courses'])->name('courses');
Route::get('/documents', [SiteController::class, 'documents'])->name('documents');
Route::get('/validation-inscription', [SiteController::class, 'validation'])->name('validation');
Route::get('/tableau-administration', [SiteController::class, 'dashboard'])->name('dashboard');

Route::post('/inscription/soumettre', [SiteController::class, 'submitRegistration'])->name('registration.submit');
Route::post('/validation/verifier', [SiteController::class, 'checkValidation'])->name('validation.check');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations');
        Route::put('/registration/{id}/validate', [AdminController::class, 'validateRegistration'])->name('validate');
        Route::delete('/registration/{id}', [AdminController::class, 'deleteRegistration'])->name('delete');
        Route::post('/registration/{id}/resend-approval', [AdminController::class, 'resendApproval'])->name('resend.approval');
    });
});