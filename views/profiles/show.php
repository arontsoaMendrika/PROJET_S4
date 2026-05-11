<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - RégimeVIP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav container">
            <div class="logo">
                <i class="fas fa-crown text-yellow-400"></i>
                <span>RégimeVIP</span>
                <span class="vip-badge">ADMIN</span>
            </div>
            <ul class="nav-links">
                <li><a href="../home.php">Accueil</a></li>
                <li><a href="../regimes/list.php">Régimes</a></li>
                <li><a href="../recommendations/form.php">Recommandations</a></li>
                <li><a href="form.php?user_id=<?php echo $userId; ?>" class="text-yellow-400">Profils</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-8">
        <div class="mb-6">
            <a href="form.php?user_id=<?php echo $userId; ?>" class="btn btn-secondary">
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
                            <a href="form.php?user_id=<?php echo $userId; ?>" class="btn btn-primary w-full">
                                <i class="fas fa-edit mr-2"></i>Modifier le profil
                            </a>
                            <a href="../recommendations/form.php?user_id=<?php echo $userId; ?>" class="btn btn-secondary w-full">
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
                    <p class="text-white text-opacity-60 mb-4">Le profil utilisateur n'existe pas.</p>
                    <a href="form.php?user_id=<?php echo $userId; ?>" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Créer le profil
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
