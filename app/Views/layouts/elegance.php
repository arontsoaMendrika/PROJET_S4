<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Élégance - Nutrition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='<?= base_url("assets/css/style.css") ?>'>
</head>

<body>
    <header class="topbar mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="<?= base_url() ?>" class="logo brand-logo">
                L'ÉLÉGANCE <span>Nutrition</span>
            </a>
            <nav class="d-none d-md-flex align-items-center">
                <a href="<?= base_url() ?>" class="nav-link elegant-link">Accueil</a>
                <a href="<?= base_url('regimes') ?>" class="nav-link elegant-link">Programmes</a>
                <a href="<?= base_url('recommandation') ?>" class="nav-link elegant-link">Recommandations</a>
                <?php if (session()->get('user_id')): ?>
                    <a href="<?= base_url('profile') ?>" class="nav-link elegant-link">Mon Profil</a>
                    <a href="<?= base_url('logout') ?>" class="btn btn-outline-elegant btn-sm ms-3">Déconnexion</a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="nav-link elegant-link">Connexion</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <?= $this->renderSection('content') ?>

    <footer class="mt-5 py-4 text-center" style="background-color: var(--el-black); color: #888; font-size: 0.9rem;">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> L'Élégance Nutrition. Développé pour votre excellence.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>