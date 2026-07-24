<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Program;
use App\Models\Ambassador;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Learner;
use App\Models\User;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Message;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\News;
use App\Models\GalleryItem;
use App\Models\ContentPage;
use App\Models\Registration;
use App\Models\RegistrationDocument;
use App\Models\ContactMessage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== ANNÉE SCOLAIRE ====================
        $annee = AcademicYear::firstOrCreate(
            ['label' => '2025-2026'],
            ['start_date' => '2025-09-01', 'end_date' => '2026-07-15', 'is_current' => true]
        );
        AcademicYear::firstOrCreate(
            ['label' => '2024-2025'],
            ['start_date' => '2024-09-01', 'end_date' => '2025-07-15', 'is_current' => false]
        );

        // ==================== ADMIN ====================
        $admin = User::firstOrCreate(
            ['email' => 'admin@ambassador.com'],
            ['name' => 'Administrateur', 'password' => 'admin1234', 'role' => 'admin']
        );

        // ==================== ÉQUIPE (Ambassadors) ====================
        $staffData = [
            ['name' => 'Jean-Paul Etoundi', 'role' => 'director', 'email' => 'jp.etoundi@ambassadors.school', 'phone' => '+237 690 00 00 01', 'bio' => "Directeur général avec plus de 15 ans d'expérience dans l'éducation.", 'order' => 1],
            ['name' => 'Marie-Claire Ngo', 'role' => 'teacher', 'email' => 'mc.ngo@ambassadors.school', 'phone' => '+237 690 00 00 02', 'bio' => 'Enseignante de Mathématiques, 10 ans d\'expérience.', 'order' => 2],
            ['name' => 'Paul Biya Jr.', 'role' => 'teacher', 'email' => 'p.biya@ambassadors.school', 'phone' => '+237 690 00 00 03', 'bio' => 'Enseignant de Français et Littérature.', 'order' => 3],
            ['name' => 'Aïcha Moussa', 'role' => 'teacher', 'email' => 'a.moussa@ambassadors.school', 'phone' => '+237 690 00 00 04', 'bio' => "Enseignante d'Anglais, certifiée Cambridge.", 'order' => 4],
            ['name' => 'Serge Kamdem', 'role' => 'teacher', 'email' => 's.kamdem@ambassadors.school', 'phone' => '+237 690 00 00 05', 'bio' => 'Enseignant de Sciences de la Vie et de la Terre.', 'order' => 5],
            ['name' => 'Odette Fouda', 'role' => 'admin_staff', 'email' => 'o.fouda@ambassadors.school', 'phone' => '+237 690 00 00 06', 'bio' => 'Responsable des admissions.', 'order' => 6],
        ];
        $staff = [];
        foreach ($staffData as $data) {
            $staff[] = Ambassador::firstOrCreate(['email' => $data['email']], $data + ['active' => true]);
        }

        // ==================== CLASSES ====================
        $classesData = [
            ['name' => 'Grande Section', 'cycle' => 'maternelle', 'level' => 'Maternelle', 'fee' => 250000, 'order' => 1],
            ['name' => 'CM2', 'cycle' => 'primaire', 'level' => 'Primaire', 'fee' => 320000, 'order' => 2],
            ['name' => '3ème', 'cycle' => 'secondaire', 'level' => 'Collège', 'fee' => 380000, 'order' => 3],
            ['name' => 'Terminale D', 'cycle' => 'secondaire', 'level' => 'Lycée', 'fee' => 450000, 'order' => 4],
        ];
        $classes = [];
        foreach ($classesData as $data) {
            $classes[$data['name']] = SchoolClass::firstOrCreate(
                ['name' => $data['name']],
                $data + [
                    'academic_year_id' => $annee->id,
                    'capacity' => 30,
                    'description' => "Classe de {$data['name']}.",
                    'pedagogical_content' => "Programme pédagogique complet pour la classe de {$data['name']}, combinant rigueur académique et épanouissement personnel.",
                    'admission_conditions' => "Dossier scolaire, entretien d'admission et test de niveau requis pour intégrer la classe de {$data['name']}.",
                    'active' => true,
                ]
            );
        }
        $terminale = $classes['Terminale D'];

        // ==================== PROGRAMMES (vue d'ensemble Formations) ====================
        $programsData = [
            ['slug' => 'maternelle', 'cycle' => 'maternelle', 'title' => 'Maternelle', 'description' => 'Un environnement bienveillant pour les tout-petits (3-5 ans).', 'order' => 1],
            ['slug' => 'primaire', 'cycle' => 'primaire', 'title' => 'Primaire', 'description' => 'Des bases solides en français, mathématiques et sciences (6-11 ans).', 'order' => 2],
            ['slug' => 'secondaire', 'cycle' => 'secondaire', 'title' => 'Secondaire', 'description' => 'Un enseignement exigeant préparant aux examens nationaux (12-17 ans).', 'order' => 3],
            ['slug' => 'international', 'cycle' => 'international', 'title' => 'Programmes Internationaux', 'description' => "Cambridge Curriculum, IGCSE / A-Levels et échanges internationaux.", 'order' => 4],
        ];
        foreach ($programsData as $data) {
            Program::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // ==================== MATIÈRES (Courses) pour la Terminale D ====================
        $coursesData = [
            ['name' => 'Mathématiques', 'teacher' => 1, 'color' => '#0a2463', 'coefficient' => 4],
            ['name' => 'Français', 'teacher' => 2, 'color' => '#c9962c', 'coefficient' => 3],
            ['name' => 'Anglais', 'teacher' => 3, 'color' => '#2ecc71', 'coefficient' => 2],
            ['name' => 'Sciences de la Vie et de la Terre', 'teacher' => 4, 'color' => '#8e44ad', 'coefficient' => 3],
            ['name' => 'Histoire-Géographie', 'teacher' => null, 'color' => '#e67e22', 'coefficient' => 2],
            ['name' => 'Philosophie', 'teacher' => null, 'color' => '#16a085', 'coefficient' => 3],
        ];
        $courses = [];
        foreach ($coursesData as $data) {
            $courses[$data['name']] = Course::firstOrCreate(
                ['class_id' => $terminale->id, 'name' => $data['name']],
                [
                    'slug' => Str::slug($data['name']) . '-' . $terminale->id,
                    'teacher_id' => $data['teacher'] ? ($staff[$data['teacher']]->id ?? null) : null,
                    'teacher_name' => $data['teacher'] ? $staff[$data['teacher']]->name : null,
                    'description' => "Cours de {$data['name']} pour la classe de Terminale D.",
                    'color' => $data['color'],
                    'coefficient' => $data['coefficient'],
                ]
            );
        }

        // Quelques matières aussi pour la 3ème (pour la page Formations/Discipline)
        foreach (['Mathématiques', 'Français', 'Anglais', 'Éducation Physique et Sportive'] as $name) {
            Course::firstOrCreate(
                ['class_id' => $classes['3ème']->id, 'name' => $name],
                ['slug' => Str::slug($name) . '-' . $classes['3ème']->id, 'coefficient' => 2]
            );
        }

        // ==================== EMPLOI DU TEMPS (Terminale D) ====================
        $schedulesData = [
            ['jour' => 'Lundi', 'debut' => '07:30', 'fin' => '09:30', 'matiere' => 'Mathématiques', 'salle' => 'Salle 12'],
            ['jour' => 'Lundi', 'debut' => '09:45', 'fin' => '11:45', 'matiere' => 'Sciences de la Vie et de la Terre', 'salle' => 'Salle 08'],
            ['jour' => 'Mardi', 'debut' => '07:30', 'fin' => '09:30', 'matiere' => 'Français', 'salle' => 'Salle 11'],
            ['jour' => 'Mardi', 'debut' => '13:30', 'fin' => '15:30', 'matiere' => 'Anglais', 'salle' => 'Salle Info 1'],
            ['jour' => 'Mercredi', 'debut' => '07:30', 'fin' => '09:30', 'matiere' => 'Histoire-Géographie', 'salle' => 'Salle 09'],
            ['jour' => 'Jeudi', 'debut' => '08:00', 'fin' => '10:00', 'matiere' => 'Philosophie', 'salle' => 'Salle 05'],
        ];
        foreach ($schedulesData as $item) {
            if (isset($courses[$item['matiere']])) {
                Schedule::firstOrCreate([
                    'class_id' => $terminale->id,
                    'course_id' => $courses[$item['matiere']]->id,
                    'day_of_week' => $item['jour'],
                    'start_time' => $item['debut'],
                ], ['end_time' => $item['fin'], 'room' => $item['salle']]);
            }
        }

        // ==================== APPRENANTS DE DÉMO (5) ====================
        $learnersData = [
            ['first' => 'Joel', 'last' => 'Leukeu', 'gender' => 'M', 'parent' => ['name' => 'Marceline Leukeu', 'email' => 'marceline.leukeu@gmail.com', 'phone' => '+237 677 11 22 33']],
            ['first' => 'Sarah', 'last' => 'Mballa', 'gender' => 'F', 'parent' => ['name' => 'Bernard Mballa', 'email' => 'bernard.mballa@gmail.com', 'phone' => '+237 677 22 33 44']],
            ['first' => 'David', 'last' => 'Tchamba', 'gender' => 'M', 'parent' => ['name' => 'Christine Tchamba', 'email' => 'christine.tchamba@gmail.com', 'phone' => '+237 677 33 44 55']],
            ['first' => 'Grace', 'last' => 'Ondoa', 'gender' => 'F', 'parent' => ['name' => 'Marceline Leukeu', 'email' => 'marceline.leukeu@gmail.com', 'phone' => '+237 677 11 22 33']],
            ['first' => 'Kevin', 'last' => 'Njoya', 'gender' => 'M', 'parent' => ['name' => 'Alain Njoya', 'email' => 'alain.njoya@gmail.com', 'phone' => '+237 677 44 55 66']],
        ];

        $learners = [];
        $parentsCreated = [];
        foreach ($learnersData as $i => $data) {
            $matricule = 'AMB2025-' . str_pad((string) ($i + 1), 4, '0', STR_PAD_LEFT);
            $email = Str::slug($data['first'] . '.' . $data['last'], '.') . '@ambassadors.school';

            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $data['first'] . ' ' . $data['last'], 'password' => 'apprenant1234', 'role' => 'apprenant']
            );

            $learner = Learner::firstOrCreate(
                ['matricule' => $matricule],
                [
                    'user_id' => $user->id,
                    'first_name' => $data['first'],
                    'last_name' => $data['last'],
                    'birth_date' => now()->subYears(17)->subDays($i * 20),
                    'gender' => $data['gender'],
                    'class_id' => $terminale->id,
                    'status' => 'actif',
                    'annee_scolaire' => '2025-2026',
                ]
            );
            $learners[] = $learner;

            // Parent (réutilisé si même email pour plusieurs enfants, ex: fratrie)
            $parentEmail = $data['parent']['email'];
            if (!isset($parentsCreated[$parentEmail])) {
                $parentUser = User::firstOrCreate(
                    ['email' => $parentEmail],
                    ['name' => $data['parent']['name'], 'phone' => $data['parent']['phone'], 'password' => 'parent1234', 'role' => 'parent']
                );
                $parentsCreated[$parentEmail] = $parentUser;
            }
            $parentsCreated[$parentEmail]->children()->syncWithoutDetaching([$learner->id => ['relationship' => 'tuteur']]);
        }
        $joel = $learners[0];

        // ==================== NOTES (Grades) pour Joel ====================
        $gradesData = [
            ['matiere' => 'Mathématiques', 'titre' => 'Contrôle - Chapitre 3', 'score' => 18.5],
            ['matiere' => 'Mathématiques', 'titre' => 'Devoir surveillé', 'score' => 16],
            ['matiere' => 'Français', 'titre' => 'Dissertation trimestrielle', 'score' => 15.5],
            ['matiere' => 'Anglais', 'titre' => 'Test de compréhension', 'score' => 15.6],
            ['matiere' => 'Sciences de la Vie et de la Terre', 'titre' => 'TP noté', 'score' => 14.8],
            ['matiere' => 'Histoire-Géographie', 'titre' => 'Devoir sur table', 'score' => 17.4],
            ['matiere' => 'Philosophie', 'titre' => 'Dissertation', 'score' => 13.5],
        ];
        foreach ($gradesData as $item) {
            if (isset($courses[$item['matiere']])) {
                Grade::firstOrCreate([
                    'learner_id' => $joel->id,
                    'course_id' => $courses[$item['matiere']]->id,
                    'title' => $item['titre'],
                ], [
                    'term' => 'Trimestre 1',
                    'score' => $item['score'],
                    'max_score' => 20,
                    'coefficient' => $courses[$item['matiere']]->coefficient,
                ]);
            }
        }
        // Notes pour un 2ème apprenant (Sarah) pour tester le multi-enfants côté parent
        foreach (array_slice($gradesData, 0, 3) as $item) {
            if (isset($courses[$item['matiere']])) {
                Grade::firstOrCreate([
                    'learner_id' => $learners[1]->id,
                    'course_id' => $courses[$item['matiere']]->id,
                    'title' => $item['titre'],
                ], [
                    'term' => 'Trimestre 1',
                    'score' => $item['score'] - 1.5,
                    'max_score' => 20,
                    'coefficient' => $courses[$item['matiere']]->coefficient,
                ]);
            }
        }

        // ==================== ABSENCES (Attendances) ====================
        Attendance::firstOrCreate([
            'learner_id' => $joel->id, 'date' => now()->subDays(6),
        ], ['course_id' => $courses['Mathématiques']->id, 'status' => 'absent', 'justified' => true, 'motif' => 'Rendez-vous médical']);
        Attendance::firstOrCreate([
            'learner_id' => $joel->id, 'date' => now()->subDays(3),
        ], ['course_id' => $courses['Français']->id, 'status' => 'retard', 'justified' => false]);

        // ==================== DEVOIRS (Assignments) + SOUMISSIONS ====================
        $assignmentsData = [
            ['matiere' => 'Mathématiques', 'titre' => 'Devoir de Mathématiques', 'limite' => now()->addDays(6)],
            ['matiere' => 'Anglais', 'titre' => "Exercice d'Anglais", 'limite' => now()->addDays(4)],
            ['matiere' => 'Philosophie', 'titre' => 'Dissertation sur la liberté', 'limite' => now()->subDays(2)],
        ];
        foreach ($assignmentsData as $item) {
            if (isset($courses[$item['matiere']])) {
                $assignment = Assignment::firstOrCreate([
                    'course_id' => $courses[$item['matiere']]->id,
                    'title' => $item['titre'],
                ], [
                    'slug' => Str::slug($item['titre']) . '-' . Str::random(4),
                    'description' => 'À rendre pour la date indiquée.',
                    'due_date' => $item['limite'],
                ]);

                if ($item['titre'] === 'Dissertation sur la liberté') {
                    AssignmentSubmission::firstOrCreate([
                        'assignment_id' => $assignment->id,
                        'learner_id' => $joel->id,
                    ], [
                        'file_path' => 'submissions/demo-placeholder.pdf',
                        'submitted_at' => now()->subDays(3),
                        'status' => 'note',
                        'grade' => 14,
                    ]);
                }
            }
        }

        // ==================== FACTURES + PAIEMENTS (Invoices/Payments) ====================
        foreach ($learners as $i => $learner) {
            $invoice = Invoice::firstOrCreate(
                ['reference' => 'FAC-DEMO-' . str_pad((string) ($i + 1), 4, '0', STR_PAD_LEFT)],
                [
                    'learner_id' => $learner->id,
                    'academic_year_id' => $annee->id,
                    'label' => 'Frais de scolarité - Année 2025-2026',
                    'amount' => $terminale->fee,
                    'due_date' => now()->addMonths(3),
                    'status' => 'en_attente',
                ]
            );

            if ($i < 2) {
                // Les 2 premiers ont payé intégralement
                Payment::firstOrCreate(
                    ['invoice_id' => $invoice->id, 'reference' => 'DEMO-PAY-' . $i],
                    ['learner_id' => $learner->id, 'amount' => $terminale->fee, 'method' => 'mobile_money', 'paid_at' => now()->subMonths(1)]
                );
                $invoice->refreshStatus();
            } elseif ($i == 2) {
                // Le 3ème a payé partiellement
                Payment::firstOrCreate(
                    ['invoice_id' => $invoice->id, 'reference' => 'DEMO-PAY-PARTIAL'],
                    ['learner_id' => $learner->id, 'amount' => $terminale->fee / 2, 'method' => 'especes', 'paid_at' => now()->subDays(10)]
                );
                $invoice->refreshStatus();
            }
        }

        // ==================== DOCUMENTS APPRENANT ====================
        Document::firstOrCreate(
            ['learner_id' => $joel->id, 'title' => 'Bulletin Trimestre 1 - 2025-2026'],
            ['file_path' => 'documents/demo-bulletin.pdf', 'category' => 'bulletin', 'uploaded_by' => $admin->id]
        );

        // ==================== MESSAGES ====================
        Message::firstOrCreate(
            ['sender_id' => $admin->id, 'recipient_id' => $joel->user_id, 'subject' => 'Bienvenue sur votre Espace Apprenant'],
            ['body' => "Bonjour Joel, bienvenue sur votre espace personnel. N'hésitez pas à nous contacter en cas de besoin.", 'read_at' => null]
        );

        // ==================== ANNONCES (Announcements) ====================
        $announcementsData = [
            ['title' => 'Examen blanc de fin de trimestre', 'body' => 'Les examens blancs débuteront le 03 juin. Merci de consulter le planning affiché.', 'audience' => 'apprenants'],
            ['title' => 'Réunion parents-professeurs', 'body' => 'Une réunion parents-professeurs se tiendra le 30 mai à 16h00 dans l\'amphithéâtre.', 'audience' => 'parents'],
            ['title' => 'Journée portes ouvertes', 'body' => "Rejoignez-nous le 25 mai à partir de 09h00 pour découvrir le campus.", 'audience' => 'tous'],
            ['title' => 'Vacances scolaires', 'body' => 'Les vacances scolaires débutent le 12 juin.', 'audience' => 'tous'],
        ];
        foreach ($announcementsData as $item) {
            Announcement::firstOrCreate(
                ['title' => $item['title']],
                $item + ['slug' => Str::slug($item['title']), 'author_id' => $admin->id, 'published_at' => now()->subDays(rand(1, 10))]
            );
        }

        // ==================== ÉVÉNEMENTS (Events) ====================
        $eventsData = [
            ['title' => 'Journée Portes Ouvertes', 'category' => 'Événements', 'start' => now()->addDays(10), 'location' => 'Campus Ambassadors'],
            ['title' => 'Exposition Scientifique', 'category' => 'Académique', 'start' => now()->addDays(24), 'location' => 'Salle polyvalente'],
            ['title' => "Cérémonie de fin d'année", 'category' => 'Événements', 'start' => now()->addDays(60), 'location' => 'Amphithéâtre'],
            ['title' => "Camp d'été Ambassadors", 'category' => 'Loisirs', 'start' => now()->addDays(75), 'location' => 'Campus Ambassadors'],
        ];
        foreach ($eventsData as $item) {
            Event::firstOrCreate(
                ['title' => $item['title']],
                [
                    'slug' => Str::slug($item['title']) . '-' . Str::random(4),
                    'description' => "Détails à venir pour : {$item['title']}.",
                    'category' => $item['category'],
                    'start_date' => $item['start'],
                    'location' => $item['location'],
                    'active' => true,
                ]
            );
        }

        // ==================== ACTUALITÉS (News) ====================
        $newsData = [
            ['title' => 'Nos élèves brillent à la Compétition Nationale de Robotique', 'category' => 'Académique', 'excerpt' => "L'équipe Ambassadors s'est distinguée par son innovation et son esprit d'équipe."],
            ['title' => 'Visite éducative au Musée National', 'category' => 'Sorties', 'excerpt' => 'Une sortie pédagogique riche en découvertes pour nos classes de collège.'],
            ['title' => 'Tournoi Inter-scolaire : nos champions en action', 'category' => 'Sport', 'excerpt' => 'Retour sur un tournoi sportif disputé avec fair-play et détermination.'],
            ['title' => 'Conférence sur le Leadership des Jeunes', 'category' => 'Événements', 'excerpt' => 'Une conférence inspirante animée par des intervenants de renom.'],
        ];
        foreach ($newsData as $i => $item) {
            News::firstOrCreate(
                ['title' => $item['title']],
                [
                    'slug' => Str::slug($item['title']) . '-' . Str::random(4),
                    'excerpt' => $item['excerpt'],
                    'body' => $item['excerpt'] . " " . str_repeat("Plus de détails sur cet événement seront communiqués prochainement à la communauté Ambassadors. ", 3),
                    'category' => $item['category'],
                    'published_at' => now()->subDays($i * 5),
                    'active' => true,
                ]
            );
        }

        // ==================== GALERIE ====================
        GalleryItem::firstOrCreate(
            ['title' => 'Journée portes ouvertes 2025'],
            ['type' => 'video', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'album' => 'Événements', 'order' => 1, 'active' => true]
        );

        // ==================== PAGES DE CONTENU ====================
        $pagesData = [
            ['slug' => 'dossier-etablissement', 'title' => "Dossier de l'établissement", 'body' => "L'Ambassadors International School est un établissement d'enseignement privé laïc, agréé par le Ministère des Enseignements Secondaires du Cameroun."],
            ['slug' => 'historique', 'title' => 'Historique', 'body' => "Fondé en 2013, l'Ambassadors International School a vu le jour avec la volonté de proposer une éducation d'excellence à Yaoundé."],
            ['slug' => 'vision-mission', 'title' => 'Vision et Mission', 'body' => "Notre vision est de former les leaders de demain à travers une éducation d'excellence, ouverte sur le monde."],
            ['slug' => 'reglement-interieur', 'title' => 'Règlement Intérieur', 'body' => 'Le règlement intérieur définit les droits et obligations de chaque membre de la communauté éducative.'],
        ];
        foreach ($pagesData as $page) {
            ContentPage::firstOrCreate(['slug' => $page['slug']], $page);
        }

        // ==================== INSCRIPTIONS (statuts variés pour tester l'admin) ====================
        $registrationsData = [
            ['first' => 'Emma', 'last' => 'Fotso', 'status' => 'nouvelle'],
            ['first' => 'Lucas', 'last' => 'Ateba', 'status' => 'en_examen'],
            ['first' => 'Chloe', 'last' => 'Mendo', 'status' => 'validee'],
            ['first' => 'Nathan', 'last' => 'Owona', 'status' => 'liste_attente'],
            ['first' => 'Inès', 'last' => 'Belinga', 'status' => 'rejetee'],
        ];
        foreach ($registrationsData as $i => $item) {
            $registration = Registration::firstOrCreate(
                ['first_name' => $item['first'], 'last_name' => $item['last']],
                [
                    'birth_date' => now()->subYears(10)->subDays($i * 15),
                    'gender' => $i % 2 === 0 ? 'F' : 'M',
                    'cycle_souhaite' => 'secondaire',
                    'class_souhaitee_id' => $classes['3ème']->id,
                    'parent_name' => 'Parent de ' . $item['first'],
                    'parent_email' => Str::slug($item['first'] . '.parent', '.') . '@example.com',
                    'parent_phone' => '+237 690 10 20 3' . $i,
                    'address' => 'Yaoundé, Cameroun',
                    'status' => $item['status'],
                ]
            );

            RegistrationDocument::firstOrCreate([
                'registration_id' => $registration->id,
                'type' => 'photo',
            ], ['file_path' => 'registrations/demo-photo.jpg']);
        }

        // ==================== MESSAGES DE CONTACT ====================
        ContactMessage::firstOrCreate(
            ['email' => 'famille.essomba@example.com'],
            ['name' => 'Famille Essomba', 'phone' => '+237 690 55 66 77', 'subject' => 'Demande de renseignements', 'message' => 'Bonjour, pourriez-vous me communiquer les modalités d\'inscription pour la classe de CM2 ? Merci.', 'is_read' => false]
        );
    }
}
