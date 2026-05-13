<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center py-4" style="background-color: var(--el-black);">
                    <h2 class="h3 mb-0" style="color: var(--el-gold); font-family: 'Playfair Display', serif;">Connexion</h2>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form id="login-form" action="/login" method="post" novalidate>
                        <div class="mb-4">
                            <label for="email" class="form-label text-uppercase text-muted" style="font-size: 0.85rem; letter-spacing: 1px; font-weight: 600;">Email ou Identifiant</label>
                            <input type="text" class="form-control form-control-lg rounded-0" id="email" name="email" autocomplete="email" required style="border-color: #ddd;">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-uppercase text-muted" style="font-size: 0.85rem; letter-spacing: 1px; font-weight: 600;">Mot de passe</label>
                            <input type="password" class="form-control form-control-lg rounded-0" id="password" name="password" autocomplete="current-password" required style="border-color: #ddd;">
                        </div>

                        <div class="d-grid pt-3">
                            <button type="submit" class="btn btn-elegant btn-lg py-3">SE CONNECTER</button>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/forgot-password" class="text-decoration-none" style="color: var(--el-dark-grey); font-size: 0.9rem;">Mot de passe oublié ?</a>
                            <a href="/register" class="text-decoration-none" style="color: var(--el-gold-dark); font-weight: 600; font-size: 0.9rem; letter-spacing: 1px; text-transform: uppercase;">Créer un compte</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="/assets/js/auth.js"></script>
<?= $this->endSection() ?>