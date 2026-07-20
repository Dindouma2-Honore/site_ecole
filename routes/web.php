<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ProgramController;
use App\Http\Controllers\Public\NewsController as PublicNewsController;
use App\Http\Controllers\Public\GalleryController as PublicGalleryController;
use App\Http\Controllers\Public\ContactController as PublicContactController;
use App\Http\Controllers\Public\RegistrationController as PublicRegistrationController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Learner\DashboardController as LearnerDashboardController;
use App\Http\Controllers\Learner\ProfileController as LearnerProfileController;
use App\Http\Controllers\Learner\ScheduleController as LearnerScheduleController;
use App\Http\Controllers\Learner\AssignmentController as LearnerAssignmentController;
use App\Http\Controllers\Learner\ResourceController as LearnerResourceController;
use App\Http\Controllers\Learner\GradeController as LearnerGradeController;
use App\Http\Controllers\Learner\AttendanceController as LearnerAttendanceController;
use App\Http\Controllers\Learner\DocumentController as LearnerDocumentController;
use App\Http\Controllers\Learner\MessageController as LearnerMessageController;
use App\Http\Controllers\Learner\AnnouncementController as LearnerAnnouncementController;
use App\Http\Controllers\Learner\EventController as LearnerEventController;
use App\Http\Controllers\Learner\AccountController as LearnerAccountController;

use App\Http\Controllers\ParentSpace\DashboardController as ParentDashboardController;
use App\Http\Controllers\ParentSpace\ChildController as ParentChildController;
use App\Http\Controllers\ParentSpace\FinanceController as ParentFinanceController;
use App\Http\Controllers\ParentSpace\DocumentController as ParentDocumentController;
use App\Http\Controllers\ParentSpace\MessageController as ParentMessageController;
use App\Http\Controllers\ParentSpace\AnnouncementController as ParentAnnouncementController;
use App\Http\Controllers\ParentSpace\EventController as ParentEventController;
use App\Http\Controllers\ParentSpace\RequestController as ParentRequestController;
use App\Http\Controllers\ParentSpace\AccountController as ParentAccountController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\LearnerController;
use App\Http\Controllers\Admin\ParentUserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\ContentPageController;
use App\Http\Controllers\Admin\ContactMessageController;

/*
|--------------------------------------------------------------------------
| Routes publiques (visiteur)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('public.home');

Route::prefix('a-propos')->name('public.about.')->group(function () {
    Route::get('/dossier', [AboutController::class, 'dossier'])->name('dossier');
    Route::get('/histoire', [AboutController::class, 'histoire'])->name('histoire');
    Route::get('/vision-mission', [AboutController::class, 'visionMission'])->name('vision-mission');
    Route::get('/equipe', [AboutController::class, 'equipe'])->name('equipe');
});

Route::prefix('formations')->name('public.programs.')->group(function () {
    Route::get('/classes', [ProgramController::class, 'classes'])->name('classes');
    Route::get('/admission', [ProgramController::class, 'admission'])->name('admission');
    Route::get('/frais', [ProgramController::class, 'frais'])->name('frais');
    Route::get('/disciplines', [ProgramController::class, 'disciplines'])->name('disciplines');
    Route::get('/reglement', [ProgramController::class, 'reglement'])->name('reglement');
});

Route::prefix('actualites')->name('public.news.')->group(function () {
    Route::get('/', [PublicNewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicNewsController::class, 'show'])->name('show');
});

Route::get('/galerie', [PublicGalleryController::class, 'index'])->name('public.gallery.index');

Route::prefix('contact')->name('public.contact.')->group(function () {
    Route::get('/', [PublicContactController::class, 'index'])->name('index');
    Route::post('/', [PublicContactController::class, 'store'])->name('store');
});

Route::prefix('inscription')->name('public.registration.')->group(function () {
    Route::get('/', [PublicRegistrationController::class, 'create'])->name('create');
    Route::post('/', [PublicRegistrationController::class, 'store'])->name('store');
    Route::get('/documents', [PublicRegistrationController::class, 'documents'])->name('documents');
    Route::get('/statut', [PublicRegistrationController::class, 'status'])->name('status');
    Route::post('/statut', [PublicRegistrationController::class, 'checkStatus'])->name('check');
});

/*
|--------------------------------------------------------------------------
| Authentification unifiée (apprenant, parent, admin)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'create'])->name('auth.login');
    Route::post('/connexion', [AuthController::class, 'store'])->name('auth.login.post');
});
Route::post('/deconnexion', [AuthController::class, 'destroy'])->middleware('auth')->name('auth.logout');

/*
|--------------------------------------------------------------------------
| Espace Apprenant
|--------------------------------------------------------------------------
*/
Route::prefix('apprenant')->name('learner.')->middleware(['auth', 'role:apprenant'])->group(function () {
    Route::get('/', [LearnerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [LearnerProfileController::class, 'index'])->name('profile.index');
    Route::put('/profil', [LearnerProfileController::class, 'update'])->name('profile.update');

    Route::get('/emploi-du-temps', [LearnerScheduleController::class, 'index'])->name('schedule.index');

    Route::get('/devoirs', [LearnerAssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/devoirs/{id}/soumettre', [LearnerAssignmentController::class, 'submit'])->name('assignments.submit');

    Route::get('/ressources', [LearnerResourceController::class, 'index'])->name('resources.index');

    Route::get('/notes', [LearnerGradeController::class, 'index'])->name('grades.index');
    Route::get('/performances', [LearnerGradeController::class, 'performance'])->name('performance.index');

    Route::get('/absences', [LearnerAttendanceController::class, 'index'])->name('attendance.index');

    Route::get('/documents', [LearnerDocumentController::class, 'index'])->name('documents.index');

    Route::get('/messages', [LearnerMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [LearnerMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [LearnerMessageController::class, 'store'])->name('messages.store');

    Route::get('/annonces', [LearnerAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/calendrier', [LearnerEventController::class, 'index'])->name('events.index');

    Route::get('/compte', [LearnerAccountController::class, 'index'])->name('account.index');
    Route::put('/compte/securite', [LearnerAccountController::class, 'updateSecurity'])->name('account.security');
});

/*
|--------------------------------------------------------------------------
| Espace Parent
|--------------------------------------------------------------------------
*/
Route::prefix('parent')->name('parent.')->middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/', [ParentDashboardController::class, 'index'])->name('dashboard');

    Route::get('/enfants', [ParentChildController::class, 'index'])->name('children.index');
    Route::get('/enfants/{id}', [ParentChildController::class, 'show'])->name('children.show');
    Route::get('/enfants/{id}/scolarite', [ParentChildController::class, 'academics'])->name('children.academics');

    Route::get('/finances', [ParentFinanceController::class, 'index'])->name('finances.index');
    Route::get('/documents', [ParentDocumentController::class, 'index'])->name('documents.index');

    Route::get('/messages', [ParentMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [ParentMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [ParentMessageController::class, 'store'])->name('messages.store');

    Route::get('/annonces', [ParentAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/calendrier', [ParentEventController::class, 'index'])->name('events.index');

    Route::get('/demandes', [ParentRequestController::class, 'index'])->name('requests.index');
    Route::post('/demandes', [ParentRequestController::class, 'store'])->name('requests.store');

    Route::get('/compte', [ParentAccountController::class, 'index'])->name('account.index');
    Route::put('/compte/securite', [ParentAccountController::class, 'updateSecurity'])->name('account.security');
});

/*
|--------------------------------------------------------------------------
| Espace Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Inscriptions (processus métier central)
    Route::get('/inscriptions', [AdminRegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/inscriptions/{id}', [AdminRegistrationController::class, 'show'])->name('registrations.show');
    Route::put('/inscriptions/{id}/statut', [AdminRegistrationController::class, 'updateStatus'])->name('registrations.status');
    Route::delete('/inscriptions/{id}', [AdminRegistrationController::class, 'destroy'])->name('registrations.destroy');

    // Structure pédagogique
    Route::resource('classes', SchoolClassController::class)->except(['show']);
    Route::resource('courses', CourseController::class)->except(['show']);
    Route::resource('schedules', ScheduleController::class)->except(['show']);

    // Devoirs / Ressources
    Route::resource('assignments', AssignmentController::class)->except(['show']);
    Route::get('/assignments/{id}/soumissions', [AssignmentController::class, 'submissions'])->name('assignments.submissions');
    Route::put('/assignment-submissions/{id}/noter', [AssignmentController::class, 'gradeSubmission'])->name('assignment-submissions.grade');
    Route::resource('resources', ResourceController::class)->except(['show']);

    // Notes / Absences
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/saisie', [GradeController::class, 'entry'])->name('grades.entry');
    Route::post('/grades/saisie', [GradeController::class, 'storeEntry'])->name('grades.entry.store');
    Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');

    // Finances
    Route::resource('invoices', InvoiceController::class);
    Route::post('/invoices/{id}/paiement', [InvoiceController::class, 'addPayment'])->name('invoices.payment');

    // Documents apprenants
    Route::get('/documents', [AdminDocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents', [AdminDocumentController::class, 'store'])->name('documents.store');
    Route::delete('/documents/{id}', [AdminDocumentController::class, 'destroy'])->name('documents.destroy');

    // Utilisateurs
    Route::resource('learners', LearnerController::class);
    Route::resource('parents', ParentUserController::class)->except(['show']);
    Route::resource('equipe', StaffController::class)->except(['show']);

    // Communication & vie scolaire
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::resource('news', AdminNewsController::class)->except(['show']);
    Route::resource('events', AdminEventController::class)->except(['show']);
    Route::get('/announcements', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{id}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');

    Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::put('/contact-messages/{id}/read', [ContactMessageController::class, 'markRead'])->name('contact-messages.read');
    Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    // Paramétrage
    Route::get('/academic-years', [AcademicYearController::class, 'index'])->name('academic-years.index');
    Route::post('/academic-years', [AcademicYearController::class, 'store'])->name('academic-years.store');
    Route::put('/academic-years/{id}/courante', [AcademicYearController::class, 'setCurrent'])->name('academic-years.current');
    Route::delete('/academic-years/{id}', [AcademicYearController::class, 'destroy'])->name('academic-years.destroy');

    Route::resource('pages', ContentPageController::class)->except(['show', 'create', 'store', 'destroy']);
});
