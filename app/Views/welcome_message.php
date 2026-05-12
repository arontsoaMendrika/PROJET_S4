<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Élégance - Nutrition & Bien-être Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Injection CSS pour le style Élégant -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap');

        :root {
            --el-gold: #C5A059;
            --el-gold-dark: #A58039;
            --el-black: #1A1A1A;
            --el-dark-grey: #2C2C2C;
            --el-white: #FAFAFA;
        }
        body { 
            background: var(--el-white);
            font-family: 'Montserrat', sans-serif;
            color: var(--el-black);
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4, h5, h6, .brand-logo {
            font-family: 'Playfair Display', serif;
        }

        /* Topbar / Navbar */
        .topbar {
            background-color: var(--el-black);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .topbar .logo {
            font-size: 2.2rem;
            color: var(--el-gold);
            text-decoration: none;
            letter-spacing: 2px;
        }
        .topbar .logo span {
            color: var(--el-white);
            font-size: 1.5rem;
            font-weight: 300;
        }
        .tel-action {
            color: var(--el-gold);
            border: 1px solid var(--el-gold);
            border-radius: 0;
            padding: 8px 25px;
            font-size: 1rem;
            display: inline-block;
            text-decoration: none;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .tel-action:hover {
            color: var(--el-black);
            background-color: var(--el-gold);
        }

        .nav-links-home a {
            color: var(--el-white);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border: 1px solid rgba(197,160,89,0.45);
            padding: 8px 16px;
            transition: all 0.3s;
        }
        .nav-links-home a:hover {
            color: var(--el-black);
            background-color: var(--el-gold);
            border-color: var(--el-gold);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(26,26,26,0.5), rgba(26,26,26,0.8)), url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=1920&q=80') center/cover;
            padding: 120px 0;
            text-align: center;
        }
        .hero h1 {
            font-weight: 700;
            font-size: 3.5rem;
            color: var(--el-white);
            margin-bottom: 20px;
        }
        .hero h1 span {
            color: var(--el-gold);
            font-style: italic;
        }
        .hero p {
            font-size: 1.3rem;
            color: #E0E0E0;
            margin-bottom: 40px;
            font-weight: 300;
            letter-spacing: 1px;
        }
        .btn-bilan {
            background-color: var(--el-gold);
            color: var(--el-black);
            font-size: 1.1rem;
            padding: 15px 40px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-bilan:hover {
            background-color: var(--el-white);
            color: var(--el-black);
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background-color: var(--el-white);
        }
        .feautre-box {
            text-align: center;
            padding: 40px 30px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            height: 100%;
            border-bottom: 3px solid transparent;
            transition: all 0.4s;
        }
        .feautre-box:hover {
            transform: translateY(-5px);
            border-bottom: 3px solid var(--el-gold);
        }
        .feautre-box i {
            font-size: 3rem;
            color: var(--el-gold);
            margin-bottom: 25px;
        }
        .feautre-box h3 {
            font-size: 1.6rem;
            color: var(--el-black);
            margin-bottom: 15px;
        }

        /* Program Section */
        .program-banner {
            background-color: var(--el-dark-grey);
            color: var(--el-gold);
            padding: 60px 0;
            text-align: center;
            letter-spacing: 2px;
        }

        /* Footer */
        .footer {
            background-color: var(--el-black);
            color: #999;
            padding: 60px 0 30px;
        }
        .footer .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--el-gold);
        }
        .footer a {
            color: var(--el-gold);
            text-decoration: none;
            transition: 0.3s;
        }
        .footer a:hover {
            color: var(--el-white);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="topbar sticky-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <a href="<?= base_url() ?>" class="logo">
                        L'ÉLÉGANCE <span>Nutrition</span>
                    </a>
                </div>
                <div class="col-md-8 text-center text-md-end mt-3 mt-md-0">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-md-end gap-3">
                        <div class="nav-links-home d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                            <a href="<?= base_url() ?>">Accueil</a>
                            <a href="<?= base_url('regimes') ?>">Régimes</a>
                            <a href="<?= base_url('recommandation') ?>">Recommandation</a>
                            <a href="<?= base_url('profiles') ?>">Profil</a>
                            <a href="<?= base_url('wallet') ?>">Portefeuille</a>
                        </div>
                        <p class="mb-0 text-light" style="font-weight: 300; letter-spacing: 1px;">L'excellence de votre bien-être</p>
                        <a href="#" class="tel-action">
                            <i class="fas fa-concierge-bell me-2"></i> Service VIP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1>Sculptez votre corps avec <span>Excellence</span></h1>
                    <p>Une approche scientifique et luxueuse pour atteindre votre idéal morphologique, alliant haute gastronomie diététique et suivi sur-mesure.</p>
                    
                    <div class="mt-5">
                        <a href="<?= base_url('/recommandation') ?>" class="btn-bilan">
                            Effectuer mon analyse morphologique
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bandeau Programme -->
    <section class="program-banner">
        <div class="container">
            <h2 class="mb-0 italic" style="font-style: italic;">L'équilibre parfait entre santé et raffinement.</h2>
        </div>
    </section>

    <!-- Fonctionnement -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="color: var(--el-black);">L'Expérience Premium</h2>
                <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 20px auto;"></div>
            </div>
            <div class="row g-4">
                <!-- 1 -->
                <div class="col-md-4">
                    <div class="feautre-box">
                        <i class="fas fa-microscope"></i>
                        <h3>Analyse Scientifique</h3>
                        <p class="text-muted mt-3">Calcul pointu de votre Indice de Masse Corporelle (IMC) et de vos besoins caloriques journaliers avec une précision clinique.</p>
                    </div>
                </div>
                <!-- 2 -->
                <div class="col-md-4">
                    <div class="feautre-box">
                        <i class="fas fa-leaf"></i>
                        <h3>Haute Nutrition</h3>
                        <p class="text-muted mt-3">Sélection de régimes conçus par des diététiciens étoilés, équilibrant parfaitement macronutriments et plaisirs gustatifs.</p>
                    </div>
                </div>
                <!-- 3 -->
                <div class="col-md-4">
                    <div class="feautre-box">
                        <i class="fas fa-dumbbell"></i>
                        <h3>Accompagnement Physique</h3>
                        <p class="text-muted mt-3">Un programme d'activités sportives adéquat afin de sublimer vos résultats, allant de la flexibilité douce à la prise de masse.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Zone Action Dev -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="card border-0" style="background: transparent;">
                <div class="card-body p-4 text-center">
                    <h5 class="text-muted mb-4" style="letter-spacing: 1px;"><i class="fas fa-code me-2"></i>Administration du Système</h5>
                    <a href="<?= base_url('/regimes') ?>" class="btn btn-outline-dark me-2" style="border-radius: 0; letter-spacing: 1px;">Base de données Régimes</a>
                    <a href="<?= base_url('/recommandation') ?>" class="btn btn-outline-dark" style="border-radius: 0; letter-spacing: 1px;">Outil de Recommandation</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="logo mb-3">L'ÉLÉGANCE</div>
                    <p class="small text-muted" style="max-width: 300px;">L'art de vivre et de s'alimenter, conçu pour votre santé absolue.<br>Developpé par Itokiana ETU004364</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-light mb-1">Assistance exclusive</p>
                    <p class="fs-5 mb-0" style="color: var(--el-gold); font-family: 'Playfair Display', serif;">contact@elegance-nutrition.com</p>
                </div>
            </div>
            <div class="mt-5 pt-4 text-center small" style="border-top: 1px solid #333;">
                &copy; <?= date('Y') ?> L'Élégance Nutrition (Projet Étudiant S4). Tous droits réservés.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
