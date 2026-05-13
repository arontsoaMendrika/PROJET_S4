<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-header text-center py-4" style="background-color: var(--el-black);">
                    <h1 class="h3 mb-0" style="color: var(--el-gold); font-family: 'Playfair Display', serif;">Créer un compte</h1>
                </div>
                <div class="card-body p-4 p-md-5">
                    <p class="text-muted text-center mb-4 pb-2" style="font-size: 0.9rem;">Tous les champs marqués d'un * sont obligatoires.</p>

                    <form id="signup-form" action="/register" method="post" novalidate>
                        
                        <h4 class="mb-4 pb-2 border-bottom" style="font-size: 1.2rem; color: var(--el-dark-grey);">Informations personnelles</h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Nom *</label>
                                <input type="text" class="form-control rounded-0" id="nom" name="nom" autocomplete="family-name" required style="border-color: #ddd; padding: 0.75rem;">
                                <div class="invalid-feedback" id="error-nom" aria-live="polite"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Prénom *</label>
                                <input type="text" class="form-control rounded-0" id="prenom" name="prenom" autocomplete="given-name" required style="border-color: #ddd; padding: 0.75rem;">
                                <div class="invalid-feedback" id="error-prenom" aria-live="polite"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="naissance" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Date de naissance *</label>
                                <input type="date" class="form-control rounded-0" id="naissance" name="naissance" required style="border-color: #ddd; padding: 0.75rem;">
                                <div class="invalid-feedback" id="error-naissance" aria-live="polite"></div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="genre" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Genre</label>
                                <select class="form-select rounded-0" id="genre" name="genre" style="border-color: #ddd; padding: 0.75rem;">
                                    <option value="">Sélectionnez votre genre</option>
                                    <option value="homme">Homme</option>
                                    <option value="femme">Femme</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>

                        <h4 class="mb-4 pb-2 border-bottom mt-2" style="font-size: 1.2rem; color: var(--el-dark-grey);">Coordonnées</h4>

                        <div class="mb-3">
                            <label for="email" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Adresse Email *</label>
                            <input type="email" class="form-control rounded-0" id="email" name="email" autocomplete="email" required style="border-color: #ddd; padding: 0.75rem;">
                            <div class="invalid-feedback" id="error-email" aria-live="polite"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="telephone" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Téléphone *</label>
                                <input type="tel" class="form-control rounded-0" id="telephone" name="telephone" placeholder="032 12 345 67" required style="border-color: #ddd; padding: 0.75rem;">
                                <small class="form-text text-muted">Format accepté: chiffres, espaces, +, -</small>
                                <div class="invalid-feedback" id="error-telephone" aria-live="polite"></div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="pays" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Pays *</label>
                                <select class="form-select rounded-0" id="pays" name="pays" required style="border-color: #ddd; padding: 0.75rem;">
                                    <option value="">Sélectionnez votre pays</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="France">France</option>
                                    <option value="Maurice">Maurice</option>
                                    <option value="Reunion">La Réunion</option>
                                </select>
                                <div class="invalid-feedback" id="error-pays" aria-live="polite"></div>
                            </div>
                        </div>

                        <h4 class="mb-4 pb-2 border-bottom mt-2" style="font-size: 1.2rem; color: var(--el-dark-grey);">Sécurité du compte</h4>

                        <div class="mb-4">
                            <label for="password" class="form-label text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Mot de passe *</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded-0" id="password" name="password" autocomplete="new-password" required style="border-color: #ddd; padding: 0.75rem;">
                                <button class="btn btn-outline-secondary rounded-0" type="button" id="toggle-password" style="border-color: #ddd;">Afficher</button>
                            </div>
                            <small class="form-text text-muted mt-2 d-block">Minimum 8 caractères, dont 1 majuscule et 1 chiffre.</small>
                            <div class="invalid-feedback" id="error-password" aria-live="polite"></div>
                        </div>

                        <div class="form-check mb-5 mt-4">
                            <input class="form-check-input rounded-0" type="checkbox" id="conditions" name="conditions" required style="margin-top: 0.3rem;">
                            <label class="form-check-label" for="conditions" style="font-size: 0.95rem;">
                                J'accepte les <a href="#" style="color: var(--el-gold-dark);">conditions d'utilisation</a> *
                            </label>
                            <div class="invalid-feedback" id="error-conditions" aria-live="polite"></div>
                        </div>

                        <div class="d-grid gap-3 pt-2">
                            <button type="submit" class="btn btn-elegant btn-lg py-3">S'INSCRIRE</button>
                            <button type="reset" class="btn btn-outline-secondary btn-lg py-3 rounded-0 text-uppercase" style="font-size: 0.9rem; letter-spacing: 1px;">Réinitialiser</button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="mb-0" style="font-size: 0.95rem;">Vous avez déjà un compte ? <a href="/login" style="color: var(--el-gold-dark); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Connectez-vous</a></p>
                        </div>

                        <div id="global-message" class="mt-3 text-center" aria-live="polite"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="/assets/js/auth.js"></script>
<?= $this->endSection() ?>