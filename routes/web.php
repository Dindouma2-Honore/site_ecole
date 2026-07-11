<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\CursusController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ApprenantAuthController;
use App\Http\Controllers\EspaceApprenantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\DisciplineController;
use App\Http\Controllers\Admin\ContentPageController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\EvenementController;
use App\Http\Controllers\Admin\EmploiTempsController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\DevoirController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Admin\NotificationApprenantController;

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

// Espace Apprenant (portail élève - accès protégé par login)
Route::prefix('espace-apprenant')->name('espace-apprenant.')->group(function () {
    Route::middleware('guest:apprenant')->group(function () {
        Route::get('/login', [ApprenantAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [ApprenantAuthController::class, 'login'])->name('login.post');
    });
    Route::post('/logout', [ApprenantAuthController::class, 'logout'])->middleware('auth:apprenant')->name('logout');

    Route::middleware('auth:apprenant')->group(function () {
        Route::get('/', [EspaceApprenantController::class, 'dashboard'])->name('dashboard');
        Route::get('/emploi-du-temps', [EspaceApprenantController::class, 'emploiTemps'])->name('emploi-temps');
        Route::get('/notes', [EspaceApprenantController::class, 'notes'])->name('notes');
        Route::get('/devoirs', [EspaceApprenantController::class, 'devoirs'])->name('devoirs');
        Route::post('/devoirs/{id}/soumettre', [EspaceApprenantController::class, 'soumettreDevoir'])->name('devoirs.soumettre');
        Route::get('/finances', [EspaceApprenantController::class, 'finances'])->name('finances');
        Route::get('/notifications', [EspaceApprenantController::class, 'notifications'])->name('notifications');
        Route::put('/notifications/{id}/lu', [EspaceApprenantController::class, 'markNotificationRead'])->name('notifications.read');
        Route::get('/profil', [EspaceApprenantController::class, 'profil'])->name('profil');
        Route::put('/profil', [EspaceApprenantController::class, 'updateProfil'])->name('profil.update');
    });
});

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

        // Événements (sidebar Actualités)
        Route::resource('evenements', EvenementController::class)->except(['show']);

        // Backend Espace Apprenant
        Route::resource('emploi-temps', EmploiTempsController::class)->except(['show']);

        Route::resource('evaluations', EvaluationController::class)->except(['show']);
        Route::get('/evaluations/{id}/notes', [EvaluationController::class, 'notes'])->name('evaluations.notes');
        Route::post('/evaluations/{id}/notes', [EvaluationController::class, 'saveNotes'])->name('evaluations.notes.save');

        Route::resource('devoirs', DevoirController::class)->except(['show']);
        Route::get('/devoirs/{id}/soumissions', [DevoirController::class, 'soumissions'])->name('devoirs.soumissions');
        Route::put('/soumissions/{id}/noter', [DevoirController::class, 'noterSoumission'])->name('soumissions.noter');

        Route::resource('factures', FactureController::class);
        Route::post('/factures/{id}/paiement', [FactureController::class, 'addPaiement'])->name('factures.paiement');

        Route::get('/notifications', [NotificationApprenantController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/create', [NotificationApprenantController::class, 'create'])->name('notifications.create');
        Route::post('/notifications', [NotificationApprenantController::class, 'store'])->name('notifications.store');
        Route::delete('/notifications/{id}', [NotificationApprenantController::class, 'destroy'])->name('notifications.destroy');

        // Messages de contact
        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::put('/contact-messages/{id}/read', [ContactMessageController::class, 'markRead'])->name('contact-messages.read');
        Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    });
});
