<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Élégance - Nutrition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap");

        :root {
            --el-gold: #C5A059;
            --el-gold-dark: #A58039;
            --el-black: #1A1A1A;
            --el-dark-grey: #2C2C2C;
            --el-white: #FAFAFA;
        }
        body { 
            background: var(--el-white);
            font-family: "Montserrat", sans-serif;
            color: var(--el-black);
        }
        h1, h2, h3, h4, h5, h6, .brand-logo {
            font-family: "Playfair Display", serif;
        }

        .topbar {
            background-color: var(--el-black);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .topbar .logo {
            font-size: 1.8rem;
            color: var(--el-gold);
            text-decoration: none;
            letter-spacing: 2px;
        }
        .topbar .logo span {
            color: var(--el-white);
            font-size: 1.2rem;
            font-weight: 300;
        }
        .nav-link.elegant-link {
            color: #ccc;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            margin-right: 15px;
            transition: color 0.3s;
        }
        .nav-link.elegant-link:hover, .nav-link.elegant-link.active {
            color: var(--el-gold);
        }
        
        .btn-elegant {
            background-color: var(--el-gold);
            color: var(--el-black);
            border: none;
            border-radius: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-elegant:hover {
            background-color: var(--el-white);
            color: var(--el-black);
            border: 1px solid var(--el-gold);
        }
        
        .btn-outline-elegant {
            color: var(--el-gold);
            border: 1px solid var(--el-gold);
            border-radius: 0;
            background: transparent;
            transition: all 0.3s;
        }
        .btn-outline-elegant:hover {
            background-color: var(--el-gold);
            color: var(--el-black);
        }

        .card {
            border-radius: 0;
            border: 1px solid #eaeaea;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }
        .card-header {
            background-color: var(--el-dark-grey);
            color: var(--el-gold);
            border-radius: 0;
            border-bottom: none;
            letter-spacing: 1px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-top: 3px solid var(--el-gold);
            text-align: center;
        }
        .stat-card h3 { color: var(--el-black); font-size: 2rem; margin-bottom: 5px; }
        .stat-card p { color: #888; margin-bottom: 0; font-size: 0.9rem; text-transform: uppercase; }

        .table th { border-bottom: 2px solid var(--el-dark-grey); color: var(--el-dark-grey); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; }
        .table td { vertical-align: middle; }
    </style>
</head>
<body>
    <header class="topbar mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="<?= base_url() ?>" class="logo brand-logo">
                L'ÉLÉGANCE <span>Nutrition</span>
            </a>
            <nav class="d-none d-md-flex">
                <a href="<?= base_url() ?>" class="nav-link elegant-link">Accueil</a>
                <a href="<?= base_url('regimes') ?>" class="nav-link elegant-link">Programmes</a>
                <a href="<?= base_url('recommandation') ?>" class="nav-link elegant-link">Recommandations</a>
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
