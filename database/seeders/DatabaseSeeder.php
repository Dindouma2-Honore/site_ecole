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
            ['name' => 'Mathématiques', 'description' => 'Logique, algèbre, géométrie et analyse.', 'icon' => '📐', 'order' => 1],
            ['name' => 'Français', 'description' => 'Lecture, grammaire, expression écrite et orale.', 'icon' => '📖', 'order' => 2],
            ['name' => 'Anglais', 'description' => 'Communication et culture anglophone.', 'icon' => '🌍', 'order' => 3],
            ['name' => 'Sciences de la Vie et de la Terre', 'description' => 'Biologie, écologie et sciences naturelles.', 'icon' => '🔬', 'order' => 4],
            ['name' => 'Histoire-Géographie', 'description' => 'Histoire du Cameroun, du monde et géographie.', 'icon' => '🗺️', 'order' => 5],
            ['name' => 'Éducation Physique et Sportive', 'description' => "Développement moteur et esprit d'équipe.", 'icon' => '⚽', 'order' => 6],
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
    }
}
