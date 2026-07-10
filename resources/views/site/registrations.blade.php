@extends('layouts.app')

@section('title', 'Inscriptions')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<section class="page-header">
    <div class="container">
        <h1>Inscription en ligne</h1>
        <p>Inscrivez-vous en quelques étapes et rejoignez la communauté Ambassadors</p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<div class="container">
    <div class="breadcrumb">
        <a href="#">Accueil</a>
        <span>/</span>
        <span style="color:#0b2a4a; font-weight:600;">Inscription en ligne</span>
    </div>
</div>

<!-- ===== CONTENU PRINCIPAL ===== -->
<main class="container">
    <div class="inscription-grid">

        <!-- ===== FORMULAIRE ===== -->
        <div class="form-card">
            <div class="step-indicator">
                <span class="step-number">Étape 1 / 5</span>
                <span class="step-text">Informations de l'élève</span>
                <span class="step-total">Année scolaire 2024 - 2025</span>
            </div>

            <form>
                <!-- Identité -->
                <div class="form-section">
                    <h3>Identité de l'élève</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom <span class="required">*</span></label>
                            <input type="text" placeholder="Entrez le nom de l'élève" />
                        </div>
                        <div class="form-group">
                            <label>Prénoms <span class="required">*</span></label>
                            <input type="text" placeholder="Entrez les prénoms de l'élève" />
                        </div>
                    </div>
                    <div class="form-row three">
                        <div class="form-group">
                            <label>Date de naissance <span class="required">*</span></label>
                            <input type="date" />
                        </div>
                        <div class="form-group">
                            <label>Lieu de naissance <span class="required">*</span></label>
                            <input type="text" placeholder="Entrez le lieu de naissance" />
                        </div>
                        <div class="form-group">
                            <label>Genre <span class="required">*</span></label>
                            <select>
                                <option value="">Sélectionnez le genre</option>
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Féminin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nationalité <span class="required">*</span></label>
                            <select>
                                <option value="">Sélectionnez la nationalité</option>
                                <option value="camerounaise">Camerounaise</option>
                                <option value="française">Française</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="form-section">
                    <h3>Contact de l'élève</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="exemple@email.com" />
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="tel" placeholder="+237 6 12 34 56 78" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full">
                            <label>Adresse</label>
                            <input type="text" placeholder="Entrez l'adresse complète" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Ville <span class="required">*</span></label>
                            <select>
                                <option value="">Sélectionnez la ville</option>
                                <option value="yaounde">Yaoundé</option>
                                <option value="douala">Douala</option>
                                <option value="bafoussam">Bafoussam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quartier</label>
                            <input type="text" placeholder="Entrez le quartier" />
                        </div>
                    </div>
                </div>

                <!-- Informations scolaires -->
                <div class="form-section">
                    <h3>Informations scolaires actuelles</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Établissement actuel</label>
                            <input type="text" placeholder="Nom de l'établissement actuel" />
                        </div>
                        <div class="form-group">
                            <label>Classe actuelle <span class="required">*</span></label>
                            <select>
                                <option value="">Sélectionnez la classe actuelle</option>
                                <option value="6eme">6ème</option>
                                <option value="5eme">5ème</option>
                                <option value="4eme">4ème</option>
                                <option value="3eme">3ème</option>
                                <option value="seconde">Seconde</option>
                                <option value="premiere">Première</option>
                                <option value="terminale">Terminale</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Année scolaire en cours</label>
                            <select>
                                <option value="2023-2024" selected>2023 - 2024</option>
                                <option value="2024-2025">2024 - 2025</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Note importante -->
                <div class="note-obligatoire">
                    <strong><i class="fas fa-info-circle" style="color:#f5b042;"></i> Note importante</strong><br />
                    Les champs marqués d'un astérisque (<span style="color:#dc2626;">*</span>) sont obligatoires.<br />
                    Assurez-vous que toutes les informations fournies sont exactes.
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-arrow-right"></i> Suivant</button>
                    <button type="reset" class="btn-secondary">Réinitialiser</button>
                </div>
            </form>
        </div>

        <!-- ===== SIDEBAR ===== -->
        <div class="sidebar-right">

            <!-- Pourquoi Ambassadors -->
            <div class="info-card">
                <h3><i class="fas fa-star"></i> Pourquoi Ambassadors ?</h3>
                <ul>
                    <li><i class="fas fa-graduation-cap"></i> <strong>Excellence académique</strong><br />Un enseignement de qualité pour préparer les leaders de demain.</li>
                    <li><i class="fas fa-seedling"></i> <strong>Développement global</strong><br />Nous cultivons le potentiel intellectuel, social et émotionnel de chaque élève.</li>
                    <li><i class="fas fa-user-check"></i> <strong>Encadrement personnalisé</strong><br />Des classes à effectifs réduits et un suivi individualisé.</li>
                    <li><i class="fas fa-shield-alt"></i> <strong>Environnement sécurisé</strong><br />Un cadre moderne, sûr et stimulant propice à l'apprentissage.</li>
                </ul>
            </div>

            <!-- Documents à préparer -->
            <div class="info-card">
                <h3><i class="fas fa-file-alt"></i> Documents à préparer</h3>
                <ul>
                    <li><i class="fas fa-check check"></i> Acte de naissance de l'élève</li>
                    <li><i class="fas fa-check check"></i> Bulletins scolaires des 2 dernières années</li>
                    <li><i class="fas fa-check check"></i> Certificat de scolarité / Attestation</li>
                    <li><i class="fas fa-check check"></i> Photocopie de la pièce d'identité du parent / tuteur</li>
                    <li><i class="fas fa-check check"></i> Photo d'identité de l'élève</li>
                </ul>
            </div>

            <!-- Besoin d'aide -->
            <div class="info-card">
                <h3><i class="fas fa-headset"></i> Besoin d'aide ?</h3>
                <p style="color:#475569; font-size:0.92rem; margin-bottom:12px;">Notre équipe admission est à votre disposition pour vous accompagner.</p>
                <div class="contact-item"><i class="fas fa-phone-alt"></i> <strong>+237 6 12 34 56 78</strong></div>
                <div class="contact-item"><i class="fas fa-envelope"></i> admissions@ambassadors-school.com</div>
                <div class="contact-item"><i class="fas fa-clock"></i> Lun - Ven : 08h00 - 16h00</div>
                <div class="contact-item"><i class="fas fa-clock"></i> Sam : 08h00 - 12h00</div>
                <a href="#" class="btn-contact-side"><i class="fas fa-paper-plane"></i> Nous contacter</a>
            </div>

            <!-- Protection & Sécurité -->
            <div class="badge-protection">
                <i class="fas fa-shield-alt"></i>
                <h4>Vos données sont protégées</h4>
                <p>Nous assurons la confidentialité et la sécurité de toutes les informations que vous partagez avec nous.</p>
            </div>

            <!-- 100% en ligne -->
            <div class="badge-online">
                <i class="fas fa-laptop"></i>
                <h4>Inscription 100% en ligne</h4>
                <p>Simple, rapide et sécurisée.</p>
            </div>

        </div>

    </div>
</main>
@endsection