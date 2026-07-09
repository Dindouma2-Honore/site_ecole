<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\CursusController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\DisciplineController;
use App\Http\Controllers\Admin\ContentPageController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\ContactMessageController;

Route::get('/', [SiteController::class, 'home'])->name('home');

// Présentation de l'établissement
Route::prefix('presentation')->name('presentation.')->group(function () {
    Route::get('/dossier', [PresentationController::class, 'dossier'])->name('dossier');
    Route::get('/histoire', [PresentationController::class, 'histoire'])->name('histoire');
    Route::get('/vision-mission', [PresentationController::class, 'visionMission'])->name('vision-mission');
    Route::get('/equipe', [PresentationController::class, 'equipe'])->name('equipe');
});

// Cursus scolaire
Route::prefix('cursus')->name('cursus.')->group(function () {
    Route::get('/classes', [CursusController::class, 'classes'])->name('classes');
    Route::get('/admission', [CursusController::class, 'admission'])->name('admission');
    Route::get('/frais', [CursusController::class, 'frais'])->name('frais');
    Route::get('/disciplines', [CursusController::class, 'disciplines'])->name('disciplines');
    Route::get('/reglement', [CursusController::class, 'reglement'])->name('reglement');
});

// Actualités & Événements
Route::prefix('actualites')->name('actualites.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{id}', [NewsController::class, 'show'])->name('show');
});

// Admissions
Route::get('/inscriptions', [SiteController::class, 'registrations'])->name('registrations');
Route::get('/documents', [SiteController::class, 'documents'])->name('documents');
Route::get('/validation-inscription', [SiteController::class, 'validation'])->name('validation');
Route::post('/inscription/soumettre', [SiteController::class, 'submitRegistration'])->name('registration.submit');
Route::post('/validation/verifier', [SiteController::class, 'checkValidation'])->name('validation.check');

// Galerie Photos / Vidéos
Route::get('/galerie', [GalleryController::class, 'index'])->name('galerie');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact/envoyer', [ContactController::class, 'submit'])->name('contact.submit');

// Espace Apprenant (placeholder)
Route::get('/espace-apprenant', [SiteController::class, 'espaceApprenant'])->name('espace-apprenant');

// Tableau de bord public (suivi d'inscription)
Route::get('/tableau-administration', [SiteController::class, 'dashboard'])->name('dashboard');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Inscriptions
        Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations');
        Route::put('/registration/{id}/validate', [AdminController::class, 'validateRegistration'])->name('validate');
        Route::put('/registration/{id}/reject', [AdminController::class, 'rejectRegistration'])->name('reject');
        Route::delete('/registration/{id}', [AdminController::class, 'deleteRegistration'])->name('delete');
        Route::post('/registration/{id}/resend-approval', [AdminController::class, 'resendApproval'])->name('resend.approval');

        // Équipe administrative (Ambassador)
        Route::resource('equipe', StaffController::class)->except(['show']);

        // Classes / Cursus scolaire (Course)
        Route::resource('classes', SchoolClassController::class)->except(['show']);

        // Disciplines
        Route::resource('disciplines', DisciplineController::class)->except(['show']);

        // Pages de contenu statique
        Route::resource('pages', ContentPageController::class)->except(['show', 'create', 'store', 'destroy']);

        // Actualités
        Route::resource('actualites', NewsAdminController::class)->except(['show']);

        // Galerie
        Route::resource('gallery', GalleryAdminController::class)->except(['show']);

        // Messages de contact
        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::put('/contact-messages/{id}/read', [ContactMessageController::class, 'markRead'])->name('contact-messages.read');
        Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    });
});
