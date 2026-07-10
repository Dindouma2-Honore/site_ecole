<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Espace Apprenant · Ambassadors International School</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* ---------- RESET & BASE ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Roboto, system-ui, sans-serif;
            background: #f4f6fa;
            color: #1e293b;
            line-height: 1.5;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* ============================================================
           SIDEBAR
           ============================================================ */
        .sidebar {
            width: 280px;
            background: #0b2a4a;
            color: #e8edf3;
            padding: 28px 20px;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        /* Brand */
        .sidebar-brand {
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar-brand h2 {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white;
            line-height: 1.2;
        }
        .sidebar-brand h2 span {
            color: #f5b042;
        }
        .sidebar-brand .sub {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        /* Navigation */
        .sidebar-nav {
            flex: 1;
        }
        .sidebar-nav .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
            letter-spacing: 1px;
            margin: 18px 0 8px 0;
            font-weight: 600;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 14px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.92rem;
            transition: 0.2s;
            margin-bottom: 2px;
        }
        .sidebar-nav a i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.4);
        }
        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.06);
            color: white;
        }
        .sidebar-nav a:hover i {
            color: #f5b042;
        }
        .sidebar-nav a.active {
            background: rgba(245, 176, 66, 0.15);
            color: white;
            font-weight: 600;
        }
        .sidebar-nav a.active i {
            color: #f5b042;
        }
        .sidebar-nav .submenu {
            padding-left: 28px;
            margin: 2px 0 6px 0;
        }
        .sidebar-nav .submenu a {
            font-size: 0.85rem;
            padding: 6px 14px;
            color: rgba(255, 255, 255, 0.5);
        }
        .sidebar-nav .submenu a i {
            font-size: 0.7rem;
            width: 16px;
        }

        /* ============================================================
           MAIN CONTENT
           ============================================================ */
        .main-content {
            flex: 1;
            padding: 28px 36px 40px 36px;
            max-width: calc(100% - 280px);
        }

        /* En-tête utilisateur */
        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }
        .user-header .greeting h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0b2a4a;
        }
        .user-header .greeting h1 span {
            color: #f5b042;
        }
        .user-header .greeting .role {
            color: #64748b;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .user-header .badge-info {
            background: white;
            border-radius: 16px;
            padding: 10px 22px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            border: 1px solid #eef2f6;
            display: flex;
            flex-wrap: wrap;
            gap: 18px 32px;
            font-size: 0.9rem;
        }
        .user-header .badge-info strong {
            color: #0b2a4a;
        }
        .user-header .badge-info span {
            color: #475569;
        }

        /* Citation */
        .quote-box {
            background: linear-gradient(135deg, #0b2a4a 0%, #1a3f62 100%);
            color: white;
            padding: 18px 28px;
            border-radius: 16px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .quote-box i {
            font-size: 2rem;
            color: #f5b042;
            opacity: 0.7;
        }
        .quote-box blockquote {
            font-size: 1.05rem;
            font-style: italic;
            font-weight: 300;
            letter-spacing: 0.3px;
        }
        .quote-box blockquote cite {
            font-style: normal;
            font-weight: 600;
            color: #f5b042;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* Cartes */
        .card {
            background: white;
            border-radius: 20px;
            padding: 22px 24px 26px 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
            border: 1px solid #eef2f6;
            transition: 0.2s;
        }
        .card:hover {
            border-color: #dce2ec;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0b2a4a;
        }
        .card-header a {
            font-size: 0.8rem;
            font-weight: 600;
            color: #f5b042;
            text-decoration: none;
        }
        .card-header a:hover {
            text-decoration: underline;
        }

        /* Emploi du temps */
        .timetable {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .timetable th {
            text-align: left;
            font-weight: 600;
            color: #64748b;
            padding: 6px 0;
            border-bottom: 2px solid #f1f5f9;
        }
        .timetable td {
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .timetable tr:last-child td {
            border-bottom: none;
        }
        .timetable .day-label {
            font-weight: 600;
            color: #0b2a4a;
        }
        .timetable .room {
            background: #f1f5f9;
            padding: 2px 10px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 500;
            color: #334155;
        }

        .voir-plus {
            display: inline-block;
            margin-top: 12px;
            font-weight: 600;
            color: #0b2a4a;
            text-decoration: none;
            border-bottom: 2px solid #f5b042;
            padding-bottom: 2px;
            font-size: 0.85rem;
        }
        .voir-plus:hover {
            color: #f5b042;
        }

        /* Performances */
        .perf-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 16px;
            margin: 6px 0 8px 0;
        }
        .perf-item {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.9rem;
        }
        .perf-item .label {
            color: #64748b;
        }
        .perf-item .value {
            font-weight: 700;
            color: #0b2a4a;
        }
        .perf-item .value.good {
            color: #16a34a;
        }

        /* Finances */
        .finance-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 16px 32px;
            margin: 8px 0;
        }
        .finance-summary .item {
            background: #f8fafc;
            padding: 10px 18px;
            border-radius: 12px;
            flex: 1 0 auto;
        }
        .finance-summary .item .label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.3px;
        }
        .finance-summary .item .amount {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0b2a4a;
        }
        .finance-summary .item .amount.green {
            color: #16a34a;
        }
        .finance-summary .item .amount.orange {
            color: #f59e0b;
        }
        .status-badge {
            display: inline-block;
            background: #dcfce7;
            color: #16a34a;
            padding: 4px 14px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Ressources */
        .ressource-list {
            list-style: none;
        }
        .ressource-list li {
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .ressource-list li:last-child {
            border-bottom: none;
        }
        .ressource-list .title {
            font-weight: 600;
            color: #0b2a4a;
        }
        .ressource-list .meta {
            font-size: 0.8rem;
            color: #64748b;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 2px;
        }
        .ressource-list .tag {
            background: #fef3c7;
            color: #b45309;
            padding: 0 10px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .ressource-list .tag.danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* Annonces */
        .annonce-item {
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .annonce-item:last-child {
            border-bottom: none;
        }
        .annonce-item .title {
            font-weight: 600;
            color: #0b2a4a;
        }
        .annonce-item .desc {
            font-size: 0.88rem;
            color: #475569;
            margin: 2px 0;
        }
        .annonce-item .date {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Actions rapides */
        .actions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 4px;
        }
        .actions-grid .action-btn {
            background: #f8fafc;
            border: 1px solid #eef2f6;
            border-radius: 12px;
            padding: 12px 14px;
            text-align: center;
            text-decoration: none;
            color: #0b2a4a;
            font-weight: 500;
            font-size: 0.85rem;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .actions-grid .action-btn i {
            color: #f5b042;
        }
        .actions-grid .action-btn:hover {
            background: #f1f5f9;
            border-color: #dce2ec;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer-app {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eef2f6;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #94a3b8;
        }
        .footer-app a {
            color: #64748b;
            text-decoration: none;
            margin-left: 20px;
        }
        .footer-app a:hover {
            color: #0b2a4a;
        }

        /* ============================================================
           RESPONSIVE
           ============================================================ */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .app-container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 16px 20px;
            }
            .main-content {
                max-width: 100%;
                padding: 20px;
            }
            .user-header {
                flex-direction: column;
            }
            .user-header .badge-info {
                width: 100%;
            }
            .finance-summary {
                flex-direction: column;
            }
            .actions-grid {
                grid-template-columns: 1fr 1fr;
            }
            .perf-grid {
                grid-template-columns: 1fr;
            }
            .quote-box blockquote {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }
            .user-header .greeting h1 {
                font-size: 1.4rem;
            }
            .user-header .badge-info {
                flex-direction: column;
                gap: 8px;
            }
            .actions-grid {
                grid-template-columns: 1fr;
            }
            .card {
                padding: 16px;
            }
            .sidebar-nav a {
                font-size: 0.85rem;
                padding: 8px 12px;
            }
            .sidebar-nav .submenu {
                padding-left: 16px;
            }
            .footer-app {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            .footer-app a {
                margin: 0 8px;
            }
        }
    </style>
</head>
<body>

<div class="app-container">

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h2>AMBASSADORS<br /><span>INTERNATIONAL</span> SCHOOL</h2>
            <div class="sub">Espace de l'apprenant</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Tableau de bord</div>
            <a href="#" class="active"><i class="fas fa-th-large"></i> Accueil</a>

            <div class="nav-label">Mon espace</div>
            <a href="#"><i class="fas fa-user-circle"></i> Mon Profil</a>
            <a href="#"><i class="fas fa-id-card"></i> Informations personnelles</a>
            <a href="#"><i class="fas fa-calendar-alt"></i> Emploi du temps</a>
            <a href="#"><i class="fas fa-book"></i> Mes cours</a>

            <div class="nav-label">Devoirs & Ressources</div>
            <a href="#"><i class="fas fa-notes-medical"></i> Notes & Performances</a>
            <a href="#"><i class="fas fa-clock"></i> Absences & Retards</a>

            <div class="nav-label">Finances</div>
            <a href="#"><i class="fas fa-credit-card"></i> Mes paiements</a>
            <a href="#"><i class="fas fa-file-invoice"></i> Historique des factures</a>
            <a href="#"><i class="fas fa-gift"></i> Bourses / Réductions</a>

            <div class="nav-label">Communication</div>
            <a href="#"><i class="fas fa-envelope"></i> Messages</a>
            <a href="#"><i class="fas fa-bullhorn"></i> Annonces</a>
            <a href="#"><i class="fas fa-calendar-check"></i> Événements</a>
        </nav>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">

        <!-- En-tête utilisateur -->
        <div class="user-header">
            <div class="greeting">
                <h1>Bienvenue, <span>Joel Leukeu</span></h1>
                <div class="role"><i class="fas fa-user-graduate" style="color:#f5b042;"></i> Apprenant</div>
            </div>
            <div class="badge-info">
                <div><strong>Matricule</strong> <span>AMB2024-0578</span></div>
                <div><strong>Classe</strong> <span>Terminale S</span></div>
                <div><strong>Année scolaire</strong> <span>2023 - 2024</span></div>
            </div>
        </div>

        <!-- Citation -->
        <div class="quote-box">
            <i class="fas fa-quote-left"></i>
            <blockquote>
                "L'excellence n'est pas un acte, mais une habitude."
                <cite>— Aristote</cite>
            </blockquote>
        </div>

        <!-- DASHBOARD GRID -->
        <div class="dashboard-grid">

            <!-- EMPLOI DU TEMPS -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="far fa-calendar-alt" style="color:#f5b042; margin-right:8px;"></i> Emploi du temps</h3>
                    <a href="#">Semaine en cours</a>
                </div>
                <table class="timetable">
                    <thead>
                        <tr><th>LUN</th><th>MAR</th><th>MER</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="day-label">07:30</span><br />Mathématiques <span class="room">Salle 12</span></td>
                            <td><span class="day-label">07:30</span><br />Philosophie <span class="room">Salle 11</span></td>
                            <td><span class="day-label">07:30</span><br />Anglais <span class="room">Salle 15</span></td>
                        </tr>
                        <tr>
                            <td><span class="day-label">09:45</span><br />Physique-Chimie <span class="room">Salle 08</span></td>
                            <td><span class="day-label">09:45</span><br />SVT <span class="room">Salle 09</span></td>
                            <td><span class="day-label">09:45</span><br />Informatique <span class="room">Salle Info 1</span></td>
                        </tr>
                        <tr>
                            <td><span class="day-label">13:30</span><br />Anglais <span class="room">Salle 15</span></td>
                            <td><span class="day-label">13:30</span><br />Informatique <span class="room">Salle Info 1</span></td>
                            <td><span class="day-label">13:30</span><br />Physique-Chimie <span class="room">Salle 08</span></td>
                        </tr>
                    </tbody>
                </table>
                <a href="#" class="voir-plus">Voir l'emploi du temps complet →</a>
            </div>

            <!-- PERFORMANCES -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line" style="color:#f5b042; margin-right:8px;"></i> Mes performances</h3>
                    <a href="#">Voir toutes</a>
                </div>
                <div class="perf-grid">
                    <div class="perf-item"><span class="label">Moyenne générale</span><span class="value good">85.6%</span></div>
                    <div class="perf-item"><span class="label">Mathématiques</span><span class="value good">88%</span></div>
                    <div class="perf-item"><span class="label">Physique-Chimie</span><span class="value good">82%</span></div>
                    <div class="perf-item"><span class="label">Anglais</span><span class="value good">91%</span></div>
                    <div class="perf-item"><span class="label">Philosophie</span><span class="value">76%</span></div>
                    <div class="perf-item"><span class="label">SVT</span><span class="value good">84%</span></div>
                </div>
                <a href="#" class="voir-plus">Voir toutes les notes et évaluations →</a>
            </div>

            <!-- SITUATION FINANCIÈRE -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-wallet" style="color:#f5b042; margin-right:8px;"></i> Ma situation financière</h3>
                    <a href="#">Voir l'historique</a>
                </div>
                <div style="margin-bottom:10px;">
                    <span class="status-badge"><i class="fas fa-check-circle"></i> Aucune somme due</span>
                    <p style="color:#475569; font-size:0.9rem; margin-top:6px;">Vos frais de scolarité sont à jour.</p>
                </div>
                <div class="finance-summary">
                    <div class="item">
                        <div class="label">Année scolaire 2023-2024</div>
                        <div class="amount green">2 450 000 FCFA</div>
                        <div style="font-size:0.8rem; color:#64748b;">Total payé</div>
                    </div>
                    <div class="item">
                        <div class="label">Solde</div>
                        <div class="amount orange">0 FCFA</div>
                        <div style="font-size:0.8rem; color:#64748b;">Total dû</div>
                    </div>
                </div>
                <a href="#" class="voir-plus">Voir le détail des paiements →</a>
            </div>

            <!-- DERNIÈRES RESSOURCES ET DEVOIRS -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-file-alt" style="color:#f5b042; margin-right:8px;"></i> Mes dernières ressources et devoirs</h3>
                    <a href="#">Voir tout</a>
                </div>
                <ul class="ressource-list">
                    <li>
                        <div class="title">Devoir de Mathématiques</div>
                        <div class="meta">
                            <span>Publié le 18 Mai 2024</span>
                            <span class="tag danger">À rendre</span>
                            <span>25 Mai 2024</span>
                        </div>
                    </li>
                    <li>
                        <div class="title">Cours de Physique : Les ondes</div>
                        <div class="meta">
                            <span>Publié le 17 Mai 2024</span>
                            <span class="tag">Consulté</span>
                        </div>
                    </li>
                    <li>
                        <div class="title">Exercice d'Anglais</div>
                        <div class="meta">
                            <span>Publié le 16 Mai 2024</span>
                            <span class="tag danger">À rendre</span>
                            <span>23 Mai 2024</span>
                        </div>
                    </li>
                </ul>
                <a href="#" class="voir-plus">Voir toutes les ressources →</a>
            </div>

            <!-- ANNONCES RÉCENTES -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-bullhorn" style="color:#f5b042; margin-right:8px;"></i> Annonces récentes</h3>
                    <a href="#">Voir toutes</a>
                </div>
                <div class="annonce-item">
                    <div class="title">Examen blanc de fin de trimestre</div>
                    <div class="desc">Les examens blancs débuteront le 03 Juin 2024.</div>
                    <div class="date">18 Mai 2024</div>
                </div>
                <div class="annonce-item">
                    <div class="title">Journée portes ouvertes</div>
                    <div class="desc">Rejoignez-nous le 25 Mai 2024 à partir de 09h00.</div>
                    <div class="date">15 Mai 2024</div>
                </div>
                <div class="annonce-item">
                    <div class="title">Vacances scolaires</div>
                    <div class="desc">Les vacances débuteront le 12 Juin 2024.</div>
                    <div class="date">10 Mai 2024</div>
                </div>
                <a href="#" class="voir-plus">Voir toutes les annonces →</a>
            </div>

            <!-- ACTIONS RAPIDES -->
            <div class="card" style="grid-column: 1 / -1;">
                <div class="card-header">
                    <h3><i class="fas fa-bolt" style="color:#f5b042; margin-right:8px;"></i> Actions rapides</h3>
                </div>
                <div class="actions-grid">
                    <a href="#" class="action-btn"><i class="fas fa-user-edit"></i> Mettre à jour mon profil</a>
                    <a href="#" class="action-btn"><i class="fas fa-file-pdf"></i> Consulter mes bulletins</a>
                    <a href="#" class="action-btn"><i class="fas fa-envelope-open-text"></i> Contacter / demander un document</a>
                    <a href="#" class="action-btn"><i class="fas fa-exclamation-triangle"></i> Signaler un problème</a>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer-app">
            <span>© 2024 Ambassadors International School. Tous droits réservés.</span>
            <div>
                <a href="#">Mentions légales</a>
                <a href="#">Confidentialité</a>
                <a href="#">Conditions d'utilisation</a>
            </div>
        </div>

    </main>
</div>

</body>
</html>