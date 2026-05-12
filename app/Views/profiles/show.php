<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - RégimeVIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --el-gold: #C5A059;
            --el-gold-dark: #A58039;
            --el-black: #1A1A1A;
            --el-dark-grey: #2C2C2C;
            --el-white: #FAFAFA;
        }
        body {
            background: var(--el-white);
            color: var(--el-black);
            font-family: 'Montserrat', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        .topbar {
            background-color: var(--el-black);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .topbar .logo {
            color: var(--el-gold);
            text-decoration: none;
            letter-spacing: 2px;
            font-size: 1.7rem;
        }
        .topbar .logo span {
            color: var(--el-white);
            font-size: 1.1rem;
            font-weight: 300;
        }
        .nav-links-home a {
            color: var(--el-white);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            border: 1px solid rgba(197,160,89,0.45);
            padding: 8px 14px;
            transition: all 0.3s;
        }
        .nav-links-home a:hover,
        .nav-links-home a.active {
            color: var(--el-black);
            background-color: var(--el-gold);
            border-color: var(--el-gold);
        }
        .page-shell {
            padding: 40px 0 60px;
        }
        .card {
            border-radius: 0;
            border: 1px solid #eaeaea;
            box-shadow: 0 5px 15px rgba(0,0,0,0.04);
            overflow: hidden;
            background: #fff;
        }
        .card-header {
            background-color: var(--el-dark-grey);
            color: var(--el-gold);
            border-bottom: none;
            letter-spacing: 1px;
            padding: 18px 24px;
        }
        .card-body {
            padding: 24px;
        }
        .btn-primary, .btn-secondary {
            border-radius: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 16px;
        }
        .btn-primary {
            background: var(--el-gold);
            border-color: var(--el-gold);
            color: var(--el-black);
        }
        .btn-primary:hover {
            background: var(--el-gold-dark);
            border-color: var(--el-gold-dark);
            color: var(--el-black);
        }
        .btn-secondary {
            background: transparent;
            color: var(--el-black);
            border: 1px solid #bbb;
        }
        .btn-secondary:hover {
            background: var(--el-black);
            color: var(--el-white);
            border-color: var(--el-black);
        }
        .badge-primary, .badge-secondary, .badge-success, .badge-warning {
            border-radius: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 12px;
        }
        .badge-primary {
            background: var(--el-gold);
            color: var(--el-black);
        }
        .badge-secondary {
            background: #f5f1ea;
            color: #4b4b4b;
        }
        .profile-muted {
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="topbar sticky-top">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">
                <a href="<?= base_url() ?>" class="logo brand-logo">
                    L'ÉLÉGANCE <span>Nutrition</span>
                </a>
                <div class="nav-links-home d-flex flex-wrap justify-content-center justify-content-lg-end gap-2">
                    <a href="<?= base_url() ?>">Accueil</a>
                    <a href="<?= base_url('regimes') ?>">Régimes</a>
                    <a href="<?= base_url('recommandation') ?>">Recommandations</a>
                    <a href="<?= base_url('profiles/form/' . $userId) ?>">Profil</a>
                    <a href="<?= base_url('admin') ?>">Dashboard</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container page-shell">
        <div class="mb-4">
            <a href="<?= base_url('profiles/form/' . $userId) ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour au formulaire
            </a>
        </div>

        <?php if (isset($profile)): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-2xl font-bold text-white">Profil Utilisateur #<?php echo $profile['user_id']; ?></h2>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Informations physiques -->
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-4">Informations Physiques</h3>
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-white text-opacity-60">Taille:</span>
                                            <span class="text-white font-medium"><?php echo $profile['height_cm']; ?> cm</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-white text-opacity-60">Poids:</span>
                                            <span class="text-white font-medium"><?php echo $profile['weight_kg']; ?> kg</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-white text-opacity-60">Âge:</span>
                                            <span class="text-white font-medium"><?php echo $profile['age']; ?> ans</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-white text-opacity-60">Genre:</span>
                                            <span class="text-white font-medium">
                                                <?php 
                                                $genders = ['male' => 'Homme', 'female' => 'Femme', 'other' => 'Autre'];
                                                echo $genders[$profile['gender']] ?? $profile['gender'];
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Calcul IMC -->
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-4">Indice de Masse Corporelle</h3>
                                    <?php 
                                    $bmi = calculateBMI($profile['weight_kg'], $profile['height_cm']);
                                    $category = getBMICategory($bmi);
                                    ?>
                                    <div class="text-center">
                                        <div class="text-4xl font-bold <?php 
                                        echo match($category) {
                                            'Insuffisance pondérale' => 'text-blue-400',
                                            'Poids normal' => 'text-green-400',
                                            'Surpoids' => 'text-yellow-400',
                                            'Obésité' => 'text-red-400',
                                            default => 'text-white'
                                        };
                                        ?>">
                                            <?php echo $bmi; ?>
                                        </div>
                                        <div class="text-white text-opacity-80 mt-2"><?php echo $category; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Objectifs et préférences -->
                    <div class="card mt-6">
                        <div class="card-header">
                            <h3 class="text-xl font-semibold text-white">Objectifs et Préférences</h3>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-lg font-medium text-white mb-3">Objectif Principal</h4>
                                    <div class="badge badge-primary">
                                        <?php 
                                        $objectives = [
                                            'weight_loss' => 'Perte de poids',
                                            'muscle_gain' => 'Prise de masse',
                                            'maintenance' => 'Maintien',
                                            'endurance' => 'Endurance'
                                        ];
                                        echo $objectives[$profile['objective']] ?? $profile['objective'];
                                        ?>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-white mb-3">Niveau d'Activité</h4>
                                    <div class="badge badge-secondary">
                                        <?php 
                                        $levels = [
                                            'sedentary' => 'Sédentaire',
                                            'lightly_active' => 'Légèrement actif',
                                            'moderately_active' => 'Modérément actif',
                                            'very_active' => 'Très actif',
                                            'extremely_active' => 'Extrêmement actif'
                                        ];
                                        echo $levels[$profile['activity_level']] ?? $profile['activity_level'];
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($profile['target_weight_kg'])): ?>
                                <div class="mt-6">
                                    <h4 class="text-lg font-medium text-white mb-3">Poids Cible</h4>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-2xl font-bold text-yellow-400"><?php echo $profile['target_weight_kg']; ?> kg</span>
                                        <?php 
                                        $weightDiff = $profile['target_weight_kg'] - $profile['weight_kg'];
                                        if (abs($weightDiff) > 0.1): ?>
                                            <span class="badge <?php echo $weightDiff > 0 ? 'badge-success' : 'badge-warning'; ?>">
                                                <?php echo $weightDiff > 0 ? '+' : ''; ?><?php echo number_format($weightDiff, 1); ?> kg
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($profile['medical_conditions']) || !empty($profile['allergies'])): ?>
                                <div class="mt-6">
                                    <h4 class="text-lg font-medium text-white mb-3">Informations Médicales</h4>
                                    <?php if (!empty($profile['medical_conditions'])): ?>
                                        <div class="mb-3">
                                            <span class="text-white text-opacity-60">Conditions médicales:</span>
                                            <p class="text-white"><?php echo nl2br(htmlspecialchars($profile['medical_conditions'])); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($profile['allergies'])): ?>
                                        <div>
                                            <span class="text-white text-opacity-60">Allergies:</span>
                                            <p class="text-white"><?php echo nl2br(htmlspecialchars($profile['allergies'])); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-lg font-semibold text-white">Actions</h3>
                        </div>
                        <div class="card-body space-y-3">
                            <a href="<?= base_url('profiles/form/' . $userId) ?>" class="btn btn-primary w-full">
                                <i class="fas fa-edit mr-2"></i>Modifier le profil
                            </a>
                            <a href="<?= base_url('recommandation') ?>" class="btn btn-secondary w-full">
                                <i class="fas fa-magic mr-2"></i>Générer des recommandations
                            </a>
                        </div>
                    </div>

                    <!-- Recommandations récentes -->
                    <div class="card mt-6">
                        <div class="card-header">
                            <h3 class="text-lg font-semibold text-white">Recommandations</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-white text-opacity-60 text-center mb-4">
                                Cliquez sur "Générer des recommandations" pour obtenir des suggestions personnalisées.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-user-slash text-yellow-400 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-white mb-2">Profil non trouvé</h3>
                    <p class="profile-muted mb-4">Le profil utilisateur n'existe pas.</p>
                    <a href="<?= base_url('profiles/form/' . $userId) ?>" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Créer le profil
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
