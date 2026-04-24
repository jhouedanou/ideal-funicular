<?php
/**
 * Template Name: E-Digital — Contact
 *
 * Template de page fidèle au HTML d'origine (contact.html).
 * Généré automatiquement par sql/build-theme.py — ne pas éditer directement.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<div class="ms-page-content">
            <!--================= Contact Form Area Start =================-->
        <section class="contact-multistep-section">
            <div class="container">
                <div class="contact-layout">

                    <!-- Colonne formulaire -->
                    <div class="contact-form-col">

                        <!-- Barre de progression -->
                        <div class="ms-step-progress" id="msStepProgress">
                            <div class="ms-step-item active" data-step="1">
                                <div class="ms-step-bubble">1</div>
                                <div class="ms-step-label">Qui êtes-vous&nbsp;?</div>
                            </div>
                            <div class="ms-step-item" data-step="2">
                                <div class="ms-step-bubble">2</div>
                                <div class="ms-step-label">Votre projet</div>
                            </div>
                            <div class="ms-step-item" data-step="3">
                                <div class="ms-step-bubble">3</div>
                                <div class="ms-step-label">Budget &amp; Validation</div>
                            </div>
                        </div>

                        <form id="msContactForm" novalidate>

                            <!-- ===== ÉTAPE 1 : Identité & Contact ===== -->
                            <div class="ms-step-panel" id="msStep1">
                                <h2 class="ms-step-title">Identité &amp; Contact</h2>
                                <p class="ms-step-subtitle">Parlez-nous de vous pour que nous puissions vous identifier.</p>

                                <div class="ms-row-2">
                                    <div class="ms-field-group">
                                        <label for="ms-firstname">Prénom <span class="req">*</span></label>
                                        <input type="text" id="ms-firstname" name="firstname" class="ms-input" placeholder="Jean" required>
                                        <div class="ms-field-error" id="err-firstname">Veuillez saisir votre prénom.</div>
                                    </div>
                                    <div class="ms-field-group">
                                        <label for="ms-lastname">Nom <span class="req">*</span></label>
                                        <input type="text" id="ms-lastname" name="lastname" class="ms-input" placeholder="Dupont" required>
                                        <div class="ms-field-error" id="err-lastname">Veuillez saisir votre nom.</div>
                                    </div>
                                </div>

                                <div class="ms-row-2">
                                    <div class="ms-field-group">
                                        <label for="ms-email">Adresse e-mail professionnelle <span class="req">*</span></label>
                                        <input type="email" id="ms-email" name="email" class="ms-input" placeholder="jean@société.fr" required>
                                        <div class="ms-field-error" id="err-email">Veuillez entrer une adresse e-mail valide.</div>
                                    </div>
                                    <div class="ms-field-group">
                                        <label for="ms-phone">Numéro de téléphone <span class="req">*</span></label>
                                        <input type="tel" id="ms-phone" name="phone" class="ms-input" placeholder="01 84 25 16 81" required>
                                        <div class="ms-field-error" id="err-phone">Veuillez entrer un numéro de téléphone valide.</div>
                                    </div>
                                </div>

                                <div class="ms-row-2">
                                    <div class="ms-field-group">
                                        <label for="ms-company">Nom de l'entreprise <span class="req">*</span></label>
                                        <input type="text" id="ms-company" name="company" class="ms-input" placeholder="Votre entreprise" required>
                                        <div class="ms-field-error" id="err-company">Le nom de l'entreprise est requis.</div>
                                    </div>
                                    <div class="ms-field-group">
                                        <label for="ms-url">URL du site actuel <span style="color:#aaa;font-weight:400;font-size:0.75rem;">(optionnel)</span></label>
                                        <input type="url" id="ms-url" name="url" class="ms-input" placeholder="https://www.votre-site.fr">
                                    </div>
                                </div>

                                <div class="ms-form-nav">
                                    <span></span>
                                    <button type="button" class="ms-btn-next" onclick="msGoTo(2)">Continuer →</button>
                                </div>
                            </div>

                            <!-- ===== ÉTAPE 2 : Votre Projet ===== -->
                            <div class="ms-step-panel" id="msStep2" style="display:none;">
                                <h2 class="ms-step-title">Votre Projet</h2>
                                <p class="ms-step-subtitle">C'est ici que vous pourrez décrire votre projet pour nous permettre de préparer une étude personnalisée.</p>

                                <div class="ms-field-group">
                                    <label for="ms-service">Type de prestation <span class="req">*</span></label>
                                    <select id="ms-service" name="service" class="ms-select" required>
                                        <option value="">-- Sélectionnez une prestation --</option>
                                        <option value="creation">Création solution numérique</option>
                                        <option value="audit_visibilite">Audit visibilité</option>
                                        <option value="publicite">Publicité Google et Meta</option>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="autres">Autres</option>
                                    </select>
                                    <div class="ms-field-error" id="err-service">Veuillez sélectionner un type de prestation.</div>
                                </div>

                                <div class="ms-field-group">
                                    <label for="ms-description">Description du projet <span class="req">*</span></label>
                                    <textarea id="ms-description" name="description" class="ms-textarea" placeholder="Décrivez votre projet ici..." required></textarea>
                                    <div class="ms-field-error" id="err-description">Veuillez décrire brièvement votre projet.</div>
                                </div>

                                <div class="ms-field-group">
                                    <label>Ajouter un PDF <span style="color:#aaa;font-weight:400;font-size:0.75rem;">(Cahier des charges - Optionnel)</span></label>
                                    <label class="ms-upload-label" for="ms-file">
                                        <input type="file" id="ms-file" name="cahier_charges" accept=".pdf" onchange="msUpdateFileName(this)">
                                        <span class="ms-upload-icon"><i class="fas fa-file-upload"></i></span>
                                        <span class="ms-upload-text">Déposez votre fichier PDF ou cliquez pour parcourir</span>
                                    </label>
                                    <div class="ms-upload-name" id="ms-file-name" style="display:none;"></div>
                                </div>

                                <div class="ms-form-nav">
                                    <button type="button" class="ms-btn-prev" onclick="msGoTo(1)">← Retour</button>
                                    <button type="button" class="ms-btn-next" onclick="msGoTo(3)">Continuer →</button>
                                </div>
                            </div>

                            <!-- ===== ÉTAPE 3 : Budget & Validation ===== -->
                            <div class="ms-step-panel" id="msStep3" style="display:none;">
                                <h2 class="ms-step-title">Budget &amp; Validation</h2>
                                <p class="ms-step-subtitle">Ces informations nous aident à personnaliser notre proposition commerciale.</p>

                                <div class="ms-row-2">
                                    <div class="ms-field-group">
                                        <label for="ms-budget">Budget estimé <span class="req">*</span></label>
                                        <select id="ms-budget" name="budget" class="ms-select" required>
                                            <option value="">-- Budget estimé --</option>
                                            <option value="lt2k">&lt; 2000€</option>
                                            <option value="2k-5k">2000€ - 5000€</option>
                                            <option value="5k-10k">5000€ - 10000€</option>
                                            <option value="gt10k">&gt; 10000€</option>
                                        </select>
                                        <div class="ms-field-error" id="err-budget">Veuillez indiquer une enveloppe budgétaire.</div>
                                    </div>
                                    <div class="ms-field-group">
                                        <label for="ms-delay">Délai de réalisation souhaité</label>
                                        <select id="ms-delay" name="delay" class="ms-select">
                                            <option value="">-- Délai souhaité --</option>
                                            <option value="asap">ASAP (Dès que possible)</option>
                                            <option value="3m">Sous 3 mois</option>
                                            <option value="6m">Sous 6 mois</option>
                                            <option value="veille">Veille technologique / Pas de date fixée</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="ms-field-group">
                                    <label for="ms-source">Comment nous avez-vous connus ?</label>
                                    <select id="ms-source" name="source" class="ms-select">
                                        <option value="">-- Sélectionnez --</option>
                                        <option value="google">Recherche Google</option>
                                        <option value="social">Réseaux Sociaux</option>
                                        <option value="bouche">Bouche-à-oreille / Recommandation</option>
                                        <option value="pub">Publicité</option>
                                    </select>
                                </div>

                                <div class="ms-rgpd">
                                    <input type="checkbox" id="ms-rgpd" name="rgpd" required>
                                    <div class="ms-rgpd-text">
                                        <label for="ms-rgpd">J'accepte que mes données soient traitées pour répondre à ma demande de devis conformément à la <a href="#">Politique de Confidentialité</a>. <span class="req">*</span></label>
                                    </div>
                                </div>
                                <div class="ms-field-error" id="err-rgpd">Vous devez accepter notre politique de confidentialité pour continuer.</div>

                                <div class="ms-form-nav">
                                    <button type="button" class="ms-btn-prev" onclick="msGoTo(2)">← Retour</button>
                                    <button type="submit" class="ms-btn-submit">Envoyer ma demande ✓</button>
                                </div>
                            </div>

                        </form>

                        <!-- Message de confirmation -->
                        <div class="ms-form-success" id="msFormSuccess">
                            <div class="ms-success-icon"><i class="fas fa-check"></i></div>
                            <h3>Merci pour votre confiance !</h3>
                            <p>Ces éléments nous permettent de préparer une étude personnalisée avant même notre premier échange.<br><br>
                            Nous revenons vers vous <strong>très rapidement</strong> pour fixer un créneau de consultation de 15 minutes.</p>
                        </div>

                    </div>

                    <!-- Colonne infos contact -->
                    <aside class="contact-info-col">
                        <div class="contact-info-card">
                            <h3>Parlons de votre projet</h3>

                            <div class="contact-info-item">
                                <div class="cii-icon"><i class="fas fa-phone-alt"></i></div>
                                <div class="cii-text">
                                    <p>Appelez-nous</p>
                                    <span><a href="tel:0184251681" style="color:#fff;text-decoration:none;">01 84 25 16 81</a></span>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="cii-icon"><i class="fas fa-envelope"></i></div>
                                <div class="cii-text">
                                    <p>Écrivez-nous</p>
                                    <span><a href="mailto:com1@e-digital.fr" style="color:#fff;text-decoration:none;">com1@e-digital.fr</a></span>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="cii-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="cii-text">
                                    <p>Paris — Siège social</p>
                                    <span>23 rue du départ, 75014 Paris</span>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="cii-icon"><i class="fas fa-building"></i></div>
                                <div class="cii-text">
                                    <p>Agence Yvelines</p>
                                    <span>Guyancourt (78280)</span>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="cii-icon"><i class="fas fa-clock"></i></div>
                                <div class="cii-text">
                                    <p>Horaires</p>
                                    <span>Lun – Ven : 8H à 17H30</span>
                                </div>
                            </div>

                            <div class="contact-social-row">
                                <a href="https://www.facebook.com/profile.php?id=100068093956984" target="_blank" class="contact-social-btn">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://www.linkedin.com/company/e-digital-fr/?viewAsMember=true" target="_blank" class="contact-social-btn">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </section>
        <!--================= Contact Form Area End =================-->
        </div>
    </main>

    <!--================= Footer Area Start =================-->
<?php
get_footer();
