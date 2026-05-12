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
        .form-label {
            color: var(--el-black);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            border: 1px solid #cfcfcf;
            padding: 12px 14px;
            border-radius: 0;
            background: #fff;
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
            <a href="<?= base_url() ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="text-2xl font-bold text-white">
                    <?php if (isset($profile)): ?>
                        Modifier le profil Utilisateur #<?php echo $userId; ?>
                    <?php else: ?>
                        Créer le profil Utilisateur #<?php echo $userId; ?>
                    <?php endif; ?>
                </h2>
            </div>
            <div class="card-body">
                <!-- Messages d'erreur -->
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="alert alert-error mb-6">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <?php foreach ($_SESSION['errors'] as $field => $error): ?>
                                <div><?php echo htmlspecialchars($error); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <form method="POST" action="<?= base_url('profiles/save') ?>" class="space-y-8">
                    <input type="hidden" name="user_id" value="<?php echo $userId; ?>">

                    <!-- Informations physiques -->
                    <h3 class="text-xl font-semibold text-white mb-6">Informations Physiques</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label class="form-label">Taille (cm) *</label>
                            <input type="number" name="height_cm" class="form-input" min="100" max="250" step="0.1" required
                                   value="<?php echo htmlspecialchars($_SESSION['old']['height_cm'] ?? ($profile['height_cm'] ?? '')); ?>"
                                   onchange="calculateBMI()">
                        </div>
                        <div>
                            <label class="form-label">Poids (kg) *</label>
                            <input type="number" name="weight_kg" class="form-input" min="30" max="300" step="0.1" required
                                   value="<?php echo htmlspecialchars($_SESSION['old']['weight_kg'] ?? ($profile['weight_kg'] ?? '')); ?>"
                                   onchange="calculateBMI()">
                        </div>
                        <div>
                            <label class="form-label">Âge *</label>
                            <input type="number" name="age" class="form-input" min="1" max="120" required
                                   value="<?php echo htmlspecialchars($_SESSION['old']['age'] ?? ($profile['age'] ?? '')); ?>">
                        </div>
                        <div>
                            <label class="form-label">Genre *</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Sélectionner</option>
                                <option value="male" <?php echo (($_SESSION['old']['gender'] ?? $profile['gender'] ?? '') == 'male') ? 'selected' : ''; ?>>Homme</option>
                                <option value="female" <?php echo (($_SESSION['old']['gender'] ?? $profile['gender'] ?? '') == 'female') ? 'selected' : ''; ?>>Femme</option>
                                <option value="other" <?php echo (($_SESSION['old']['gender'] ?? $profile['gender'] ?? '') == 'other') ? 'selected' : ''; ?>>Autre</option>
                            </select>
                        </div>
                    </div>

                    <!-- Objectifs et activité -->
                    <h3 class="text-xl font-semibold text-white mb-6">Objectifs et Niveau d'Activité</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Objectif Principal *</label>
                            <select name="objective" class="form-select" required>
                                <option value="">Sélectionner un objectif</option>
                                <option value="weight_loss" <?php echo (($_SESSION['old']['objective'] ?? $profile['objective'] ?? '') == 'weight_loss') ? 'selected' : ''; ?>>Perte de poids</option>
                                <option value="muscle_gain" <?php echo (($_SESSION['old']['objective'] ?? $profile['objective'] ?? '') == 'muscle_gain') ? 'selected' : ''; ?>>Prise de masse musculaire</option>
                                <option value="maintenance" <?php echo (($_SESSION['old']['objective'] ?? $profile['objective'] ?? '') == 'maintenance') ? 'selected' : ''; ?>>Maintien de poids</option>
                                <option value="endurance" <?php echo (($_SESSION['old']['objective'] ?? $profile['objective'] ?? '') == 'endurance') ? 'selected' : ''; ?>>Amélioration de l'endurance</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Niveau d'Activité *</label>
                            <select name="activity_level" class="form-select" required>
                                <option value="">Sélectionner un niveau</option>
                                <option value="sedentary" <?php echo (($_SESSION['old']['activity_level'] ?? $profile['activity_level'] ?? '') == 'sedentary') ? 'selected' : ''; ?>>Sédentaire (peu ou pas d'exercice)</option>
                                <option value="lightly_active" <?php echo (($_SESSION['old']['activity_level'] ?? $profile['activity_level'] ?? '') == 'lightly_active') ? 'selected' : ''; ?>>Légèrement actif (exercice léger 1-3j/semaine)</option>
                                <option value="moderately_active" <?php echo (($_SESSION['old']['activity_level'] ?? $profile['activity_level'] ?? '') == 'moderately_active') ? 'selected' : ''; ?>>Modérément actif (exercice modéré 3-5j/semaine)</option>
                                <option value="very_active" <?php echo (($_SESSION['old']['activity_level'] ?? $profile['activity_level'] ?? '') == 'very_active') ? 'selected' : ''; ?>>Très actif (exercice intense 6-7j/semaine)</option>
                                <option value="extremely_active" <?php echo (($_SESSION['old']['activity_level'] ?? $profile['activity_level'] ?? '') == 'extremely_active') ? 'selected' : ''; ?>>Extrêmement actif (travail physique très intense)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Objectifs de poids -->
                    <h3 class="text-xl font-semibold text-white mb-6">Objectifs de Poids</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Poids Cible (kg)</label>
                            <input type="number" name="target_weight_kg" class="form-input" min="30" max="300" step="0.1"
                                   value="<?php echo htmlspecialchars($_SESSION['old']['target_weight_kg'] ?? ($profile['target_weight_kg'] ?? '')); ?>"
                                   placeholder="Optionnel">
                            <p class="text-sm text-white text-opacity-60 mt-2">Laissez vide si pas d'objectif de poids spécifique</p>
                        </div>
                    </div>

                    <!-- Informations médicales -->
                    <h3 class="text-xl font-semibold text-white mb-6">Informations Médicales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Conditions Médicales</label>
                            <textarea name="medical_conditions" rows="4" class="form-textarea" 
                                      placeholder="Diabète, hypertension, problèmes cardiaques, etc."><?php echo htmlspecialchars($_SESSION['old']['medical_conditions'] ?? ($profile['medical_conditions'] ?? '')); ?></textarea>
                            <p class="text-sm text-white text-opacity-60 mt-2">Informations importantes pour le régime</p>
                        </div>
                        <div>
                            <label class="form-label">Allergies et Intolérances</label>
                            <textarea name="allergies" rows="4" class="form-textarea" 
                                      placeholder="Arachides, gluten, lactose, fruits de mer, etc."><?php echo htmlspecialchars($_SESSION['old']['allergies'] ?? ($profile['allergies'] ?? '')); ?></textarea>
                            <p class="text-sm text-white text-opacity-60 mt-2">Allergies alimentaires à prendre en compte</p>
                        </div>
                    </div>

                    <!-- IMC calculé -->
                    <div class="mt-6 p-4 bg-dark bg-opacity-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-white text-opacity-60">IMC calculé:</span>
                                <span id="bmiValue" class="text-2xl font-bold text-yellow-400 ml-2">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <?php if (isset($profile)): ?>
                            <a href="<?= base_url('profiles/show/' . $userId) ?>" class="btn btn-secondary">
                                Annuler
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url() ?>" class="btn btn-secondary">
                                Annuler
                            </a>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            <?php if (isset($profile)): ?>
                                Mettre à jour le profil
                            <?php else: ?>
                                Créer le profil
                            <?php endif; ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function calculateBMI() {
            const height = parseFloat(document.querySelector('input[name="height_cm"]').value);
            const weight = parseFloat(document.querySelector('input[name="weight_kg"]').value);
            
            if (height && weight) {
                const heightM = height / 100;
                const bmi = weight / (heightM * heightM);
                
                const bmiElement = document.getElementById('bmiValue');
                if (bmiElement) {
                    bmiElement.textContent = bmi.toFixed(1);
                    
                    // Ajouter une classe de couleur selon l'IMC
                    bmiElement.className = 'text-2xl font-bold text-yellow-400 ml-2';
                    if (bmi < 18.5) {
                        bmiElement.className += ' text-blue-400';
                    } else if (bmi >= 30) {
                        bmiElement.className += ' text-red-400';
                    } else {
                        bmiElement.className += ' text-green-400';
                    }
                }
            }
        }
        
        // Calculer l'IMC au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            calculateBMI();
        });
    </script>
</body>
</html>
