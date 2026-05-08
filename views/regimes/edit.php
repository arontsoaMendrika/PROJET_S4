<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Régime - RégimeVIP</title>
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
                <li><a href="list.php" class="text-yellow-400">Régimes</a></li>
                <li><a href="../recommendations/form.php">Recommandations</a></li>
                <li><a href="../profiles/form.php?user_id=1">Profils</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-8">
        <div class="mb-6">
            <a href="list.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
            </a>
        </div>

        <?php if (isset($regime)): ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="text-2xl font-bold text-white">Modifier le régime: <?php echo htmlspecialchars($regime['name']); ?></h2>
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

                    <form method="POST" action="../index.php?controller=regime&action=update&id=<?php echo $regime['id']; ?>" class="space-y-6">
                        <!-- Informations de base -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label">Nom du régime *</label>
                                <input type="text" name="name" class="form-input" required
                                       value="<?php echo htmlspecialchars($_SESSION['old']['name'] ?? $regime['name']); ?>">
                            </div>
                            <div>
                                <label class="form-label">Type de régime *</label>
                                <select name="regime_type_id" class="form-select" required>
                                    <option value="">Sélectionner un type</option>
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?php echo $type['id']; ?>" 
                                                <?php echo (($_SESSION['old']['regime_type_id'] ?? $regime['regime_type_id']) == $type['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($type['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Description *</label>
                            <textarea name="description" rows="4" class="form-textarea" required><?php echo htmlspecialchars($_SESSION['old']['description'] ?? $regime['description']); ?></textarea>
                        </div>

                        <!-- Paramètres -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">Durée (jours) *</label>
                                <input type="number" name="duration_days" class="form-input" min="1" required
                                       value="<?php echo htmlspecialchars($_SESSION['old']['duration_days'] ?? $regime['duration_days']); ?>">
                            </div>
                            <div>
                                <label class="form-label">Prix de base (€) *</label>
                                <input type="number" name="base_price" class="form-input" min="0" step="0.01" required
                                       value="<?php echo htmlspecialchars($_SESSION['old']['base_price'] ?? $regime['base_price']); ?>">
                            </div>
                            <div>
                                <label class="form-label">Calories par jour *</label>
                                <input type="number" name="calories_per_day" class="form-input" min="1" required
                                       value="<?php echo htmlspecialchars($_SESSION['old']['calories_per_day'] ?? $regime['calories_per_day']); ?>">
                            </div>
                        </div>

                        <!-- Macronutriments -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-lg font-semibold text-white">Répartition des Macronutriments</h3>
                                <p class="text-sm text-white text-opacity-60">Le total doit être égal à 100%</p>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="form-label">Protéines (%) *</label>
                                        <input type="number" name="protein_percentage" class="form-input" min="0" max="100" step="0.1" required
                                               value="<?php echo htmlspecialchars($_SESSION['old']['protein_percentage'] ?? $regime['protein_percentage']); ?>"
                                               onchange="validateMacros()">
                                    </div>
                                    <div>
                                        <label class="form-label">Glucides (%) *</label>
                                        <input type="number" name="carbs_percentage" class="form-input" min="0" max="100" step="0.1" required
                                               value="<?php echo htmlspecialchars($_SESSION['old']['carbs_percentage'] ?? $regime['carbs_percentage']); ?>"
                                               onchange="validateMacros()">
                                    </div>
                                    <div>
                                        <label class="form-label">Lipides (%) *</label>
                                        <input type="number" name="fat_percentage" class="form-input" min="0" max="100" step="0.1" required
                                               value="<?php echo htmlspecialchars($_SESSION['old']['fat_percentage'] ?? $regime['fat_percentage']); ?>"
                                               onchange="validateMacros()">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-white">Total:</span>
                                        <span id="macroTotal" class="text-lg font-bold <?php echo (abs(($regime['protein_percentage'] + $regime['carbs_percentage'] + $regime['fat_percentage']) - 100) < 0.1) ? 'text-green-400' : 'text-red-400'; ?>">
                                            <?php echo $regime['protein_percentage'] + $regime['carbs_percentage'] + $regime['fat_percentage']; ?>%
                                        </span>
                                    </div>
                                    <div class="progress-bar mt-2">
                                        <div id="macroProgress" class="progress-fill <?php echo (abs(($regime['protein_percentage'] + $regime['carbs_percentage'] + $regime['fat_percentage']) - 100) < 0.1) ? 'bg-green-500' : 'bg-red-500'; ?>" 
                                             style="width: <?php echo min(100, $regime['protein_percentage'] + $regime['carbs_percentage'] + $regime['fat_percentage']); ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end space-x-4">
                            <a href="detail.php?id=<?php echo $regime['id']; ?>" class="btn btn-secondary">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-white mb-2">Régime non trouvé</h3>
                    <p class="text-white text-opacity-60 mb-4">Le régime demandé n'existe pas ou a été supprimé.</p>
                    <a href="list.php" class="btn btn-primary">
                        <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <script>
        function validateMacros() {
            const protein = parseFloat(document.querySelector('input[name="protein_percentage"]').value) || 0;
            const carbs = parseFloat(document.querySelector('input[name="carbs_percentage"]').value) || 0;
            const fat = parseFloat(document.querySelector('input[name="fat_percentage"]').value) || 0;
            const total = protein + carbs + fat;
            
            const totalElement = document.getElementById('macroTotal');
            const progressElement = document.getElementById('macroProgress');
            
            totalElement.textContent = total.toFixed(1) + '%';
            
            if (Math.abs(total - 100) < 0.1) {
                totalElement.className = 'text-lg font-bold text-green-400';
                progressElement.className = 'progress-fill bg-green-500';
            } else {
                totalElement.className = 'text-lg font-bold text-red-400';
                progressElement.className = 'progress-fill bg-red-400';
            }
            
            progressElement.style.width = Math.min(100, total) + '%';
        }

        // Initial validation
        validateMacros();
    </script>
</body>
</html>
