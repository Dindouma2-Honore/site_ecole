<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Compte administrateur par défaut pour se connecter au tableau de bord.
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@ambassador.com'],
            [
                'name' => 'Administrateur',
                'password' => 'admin1234', // hashé automatiquement grâce au cast 'hashed' du modèle User
            ]
        );

        // Pages de contenu statique (éditables depuis l'admin)
        $pages = [
            [
                'slug' => 'dossier-etablissement',
                'title' => "Dossier de l'établissement",
                'body' => "L'Ambassadors Educational Complex est un établissement d'enseignement privé laïc, agréé par le Ministère des Enseignements Secondaires du Cameroun. Cette section présente les informations administratives et légales de l'établissement : agrément, statut juridique, adresse, contacts et infrastructures.",
            ],
            [
                'slug' => 'historique',
                'title' => 'Historique',
                'body' => "Fondé en 2010, l'Ambassadors Educational Complex a vu le jour avec la volonté de proposer une éducation d'excellence à Yaoundé. Depuis, l'établissement n'a cessé de grandir, accueillant chaque année de nouveaux élèves et développant ses infrastructures pédagogiques.",
            ],
            [
                'slug' => 'vision-mission',
                'title' => 'Vision et Mission',
                'body' => "Notre vision est de former les leaders de demain à travers une éducation d'excellence, ouverte sur le monde. Notre mission est d'accompagner chaque élève dans son épanouissement académique, humain et citoyen.",
            ],
            [
                'slug' => 'reglement-interieur',
                'title' => 'Règlement Intérieur',
                'body' => "Le règlement intérieur définit les droits et obligations de chaque membre de la communauté éducative : ponctualité, tenue, respect mutuel, discipline, et modalités d'évaluation. Il est remis à chaque famille lors de l'inscription.",
            ],
        ];

        foreach ($pages as $page) {
            \App\Models\ContentPage::firstOrCreate(['slug' => $page['slug']], $page);
        }

        // Disciplines enseignées
        $disciplines = [
            ['name' => 'Mathématiques', 'description' => 'Logique, algèbre, géométrie et analyse.', 'icon' => 'bi-calculator', 'order' => 1],
            ['name' => 'Français', 'description' => 'Lecture, grammaire, expression écrite et orale.', 'icon' => 'bi-book', 'order' => 2],
            ['name' => 'Anglais', 'description' => 'Communication et culture anglophone.', 'icon' => 'bi-globe-americas', 'order' => 3],
            ['name' => 'Sciences de la Vie et de la Terre', 'description' => 'Biologie, écologie et sciences naturelles.', 'icon' => 'bi-flask', 'order' => 4],
            ['name' => 'Histoire-Géographie', 'description' => 'Histoire du Cameroun, du monde et géographie.', 'icon' => 'bi-map', 'order' => 5],
            ['name' => 'Éducation Physique et Sportive', 'description' => "Développement moteur et esprit d'équipe.", 'icon' => 'bi-trophy', 'order' => 6],
        ];

        foreach ($disciplines as $discipline) {
            \App\Models\Discipline::firstOrCreate(['name' => $discipline['name']], $discipline);
        }

        // Éléments de galerie de démonstration (vidéo uniquement, sans upload requis)
        \App\Models\GalleryItem::firstOrCreate(
            ['title' => "Journée portes ouvertes"],
            [
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'category' => 'Événements',
                'order' => 1,
                'active' => true,
            ]
        );

        // Compte apprenant de démonstration pour tester l'Espace Apprenant
        $classeDemo = \App\Models\Course::firstOrCreate(
            ['name' => 'Terminale D'],
            [
                'level' => 'Lycée',
                'description' => 'Classe de terminale scientifique.',
                'fee' => 450000,
                'active' => true,
                'order' => 1,
            ]
        );

        $apprenantDemo = \App\Models\Apprenant::firstOrCreate(
            ['matricule' => 'ET20230515'],
            [
                'first_name' => 'DINDOUMA',
                'last_name' => 'HONORE',
                'email' => 'dindoumahonore@gmail.com',
                'password' => '1234',
                'course_id' => $classeDemo->id,
                'annee_scolaire' => '2025-2026',
            ]
        );

        // Emploi du temps de démonstration
        $creneaux = [
            ['jour' => 'Lundi', 'heure_debut' => '07:30', 'heure_fin' => '09:30', 'salle' => 'Salle 12', 'discipline' => 'Mathématiques'],
            ['jour' => 'Lundi', 'heure_debut' => '09:45', 'heure_fin' => '11:45', 'salle' => 'Salle 08', 'discipline' => 'Sciences de la Vie et de la Terre'],
            ['jour' => 'Mardi', 'heure_debut' => '07:30', 'heure_fin' => '09:30', 'salle' => 'Salle 11', 'discipline' => 'Français'],
            ['jour' => 'Mardi', 'heure_debut' => '13:30', 'heure_fin' => '15:30', 'salle' => 'Salle Info 1', 'discipline' => 'Anglais'],
            ['jour' => 'Mercredi', 'heure_debut' => '07:30', 'heure_fin' => '09:30', 'salle' => 'Salle 09', 'discipline' => 'Histoire-Géographie'],
            ['jour' => 'Jeudi', 'heure_debut' => '08:00', 'heure_fin' => '10:00', 'salle' => 'Terrain', 'discipline' => 'Éducation Physique et Sportive'],
        ];

        foreach ($creneaux as $creneau) {
            $discipline = \App\Models\Discipline::where('name', $creneau['discipline'])->first();
            if ($discipline) {
                \App\Models\EmploiTemps::firstOrCreate([
                    'course_id' => $classeDemo->id,
                    'discipline_id' => $discipline->id,
                    'jour' => $creneau['jour'],
                    'heure_debut' => $creneau['heure_debut'],
                ], [
                    'heure_fin' => $creneau['heure_fin'],
                    'salle' => $creneau['salle'],
                ]);
            }
        }

        // Évaluations + notes de démonstration
        $evaluationsDemo = [
            ['discipline' => 'Mathématiques', 'titre' => 'Contrôle - Chapitre 3', 'note' => 18.5],
            ['discipline' => 'Français', 'titre' => 'Dissertation trimestrielle', 'note' => 15.5],
            ['discipline' => 'Anglais', 'titre' => 'Test de compréhension', 'note' => 15.6],
            ['discipline' => 'Histoire-Géographie', 'titre' => 'Devoir sur table', 'note' => 17.4],
        ];

        foreach ($evaluationsDemo as $item) {
            $discipline = \App\Models\Discipline::where('name', $item['discipline'])->first();
            if ($discipline) {
                $evaluation = \App\Models\Evaluation::firstOrCreate([
                    'discipline_id' => $discipline->id,
                    'course_id' => $classeDemo->id,
                    'titre' => $item['titre'],
                ], [
                    'type' => 'controle',
                    'date_evaluation' => now()->subDays(rand(5, 30)),
                    'coefficient' => 2,
                    'bareme' => 20,
                ]);

                \App\Models\Note::firstOrCreate([
                    'evaluation_id' => $evaluation->id,
                    'apprenant_id' => $apprenantDemo->id,
                ], [
                    'valeur' => $item['note'],
                    'appreciation' => 'Bon travail',
                ]);
            }
        }

        // Devoirs de démonstration
        $devoirsDemo = [
            ['discipline' => 'Mathématiques', 'titre' => 'Devoir de Mathématiques', 'limite' => now()->addDays(6)],
            ['discipline' => 'Anglais', 'titre' => "Exercice d'Anglais", 'limite' => now()->addDays(4)],
        ];

        foreach ($devoirsDemo as $item) {
            $discipline = \App\Models\Discipline::where('name', $item['discipline'])->first();
            if ($discipline) {
                \App\Models\Devoir::firstOrCreate([
                    'discipline_id' => $discipline->id,
                    'course_id' => $classeDemo->id,
                    'titre' => $item['titre'],
                ], [
                    'description' => 'À rendre pour la date indiquée.',
                    'date_publication' => now()->subDays(2),
                    'date_limite' => $item['limite'],
                ]);
            }
        }

        // Facture + paiement de démonstration
        $factureDemo = \App\Models\Facture::firstOrCreate(
            ['reference' => 'FAC-DEMO-0001'],
            [
                'apprenant_id' => $apprenantDemo->id,
                'libelle' => 'Frais de scolarité - Année 2025-2026',
                'montant_total' => 450000,
                'date_emission' => now()->subMonths(2),
                'echeance' => now()->addMonths(4),
                'statut' => 'payee',
            ]
        );

        \App\Models\Paiement::firstOrCreate(
            ['facture_id' => $factureDemo->id, 'reference_transaction' => 'DEMO-PAIEMENT-1'],
            [
                'montant' => 450000,
                'date_paiement' => now()->subMonths(2),
                'mode_paiement' => 'mobile_money',
            ]
        );

        // Notifications de démonstration
        $notificationsDemo = [
            ['titre' => 'Examen blanc de fin de trimestre', 'message' => 'Les examens débuteront le 03 juin.', 'type' => 'alerte'],
            ['titre' => 'Journée portes ouvertes', 'message' => 'Rejoignez-nous le 25 mai à partir de 09h00.', 'type' => 'annonce'],
            ['titre' => 'Vacances scolaires', 'message' => 'Les vacances débutent le 12 juin.', 'type' => 'info'],
        ];

        foreach ($notificationsDemo as $item) {
            \App\Models\NotificationApprenant::firstOrCreate(['titre' => $item['titre']], $item);
        }

        // Événements de démonstration (sidebar Actualités)
        $evenements = [
            ['title' => 'Journée Portes Ouvertes', 'event_date' => now()->addDays(10), 'event_time' => '09:00', 'icon' => '🎓', 'location' => 'Campus Ambassadors'],
            ['title' => 'Exposition Scientifique', 'event_date' => now()->addDays(24), 'event_time' => '10:00', 'icon' => '🔬', 'location' => 'Salle polyvalente'],
            ['title' => "Cérémonie de fin d'année", 'event_date' => now()->addDays(60), 'event_time' => '16:00', 'icon' => '🏆', 'location' => 'Amphithéâtre'],
            ['title' => "Camp d'été Ambassadors", 'event_date' => now()->addDays(75), 'event_time' => '08:00', 'icon' => '☀️', 'location' => 'Campus Ambassadors'],
        ];

        foreach ($evenements as $evenement) {
            \App\Models\Evenement::firstOrCreate(['title' => $evenement['title']], $evenement);
        }
    }
}
