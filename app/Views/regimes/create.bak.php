<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Régime - RégimeVIP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
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
                <li><a href="../../views/home.php">Accueil</a></li>
                <li><a href="index.php" class="text-yellow-400">Régimes</a></li>
                <li><a href="../recommendations/form.php">Recommandations</a></li>
                <li><a href="../profiles/form.php?user_id=1">Profils</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-8">
        <div class="mb-8">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="index.php" class="text-purple-600 hover:text-purple-800">Régimes</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-600">Créer un régime</span>
            </nav>
            <h1 class="text-3xl font-bold text-white mt-4">Créer un Nouveau Régime</h1>
            <p class="text-white text-opacity-80">Ajoutez un programme nutritionnel personnalisé</p>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Erreurs de validation:</strong>
                    <ul class="mt-2">
                        <?php foreach ($_SESSION['errors'] as $field => $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <!-- Form -->
        <div class="card">
            <form action="../index.php?controller=regime&action=store" method="POST" class="grid grid-2 gap-8">
                <!-- Informations générales -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Informations générales</h3>
                    
                    <div class="form-group">
                        <label for="name">Nom du régime *</label>
                        <input type="text" id="name" name="name" required
                               value="<?php echo $_SESSION['old']['name'] ?? ''; ?>"
                               placeholder="Ex: Keto Premium">
                        <?php if (isset($_SESSION['errors']['name'])): ?>
                            <div class="error-message"><?php echo $_SESSION['errors']['name']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="regime_type_id">Type de régime *</label>
                        <select id="regime_type_id" name="regime_type_id" required>
                            <option value="">Sélectionner un type</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?php echo $type['id']; ?>" 
                                        <?php echo (isset($_SESSION['old']['regime_type_id']) && $_SESSION['old']['regime_type_id'] == $type['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($type['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($_SESSION['errors']['regime_type_id'])): ?>
                            <div class="error-message"><?php echo $_SESSION['errors']['regime_type_id']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea id="description" name="description" required rows="4"
                                  placeholder="Décrivez le régime, ses bienfaits, pour qui il est adapté..."><?php echo $_SESSION['old']['description'] ?? ''; ?></textarea>
                        <?php if (isset($_SESSION['errors']['description'])): ?>
                            <div class="error-message"><?php echo $_SESSION['errors']['description']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="duration_days">Durée (jours) *</label>
                        <input type="number" id="duration_days" name="duration_days" required min="1" max="365"
                               value="<?php echo $_SESSION['old']['duration_days'] ?? '30'; ?>"
                               placeholder="30">
                        <?php if (isset($_SESSION['errors']['duration_days'])): ?>
                            <div class="error-message"><?php echo $_SESSION['errors']['duration_days']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="base_price">Prix de base (€) *</label>
                        <input type="number" id="base_price" name="base_price" required min="0" step="0.01"
                               value="<?php echo $_SESSION['old']['base_price'] ?? ''; ?>"
                               placeholder="49.00">
                        <?php if (isset($_SESSION['errors']['base_price'])): ?>
                            <div class="error-message"><?php echo $_SESSION['errors']['base_price']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Informations nutritionnelles -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Informations nutritionnelles</h3>
                    
                    <div class="form-group">
                        <label for="calories_per_day">Calories par jour *</label>
                        <input type="number" id="calories_per_day" name="calories_per_day" required min="800" max="5000"
                               value="<?php echo $_SESSION['old']['calories_per_day'] ?? '1800'; ?>"
                               placeholder="1800">
                        <?php if (isset($_SESSION['errors']['calories_per_day'])): ?>
                            <div class="error-message"><?php echo $_SESSION['errors']['calories_per_day']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="protein_percentage">Protéines (%) *</label>
                        <input type="number" id="protein_percentage" name="protein_percentage" required min="0" max="100" step="0.1"
                               value="<?php echo $_SESSION['old']['protein_percentage'] ?? '20'; ?>"
                               placeholder="20">
                    </div>

                    <div class="form-group">
                        <label for="carbs_percentage">Glucides (%) *</label>
                        <input type="number" id="carbs_percentage" name="carbs_percentage" required min="0" max="100" step="0.1"
                               value="<?php echo $_SESSION['old']['carbs_percentage'] ?? '50'; ?>"
                               placeholder="50">
                    </div>

                    <div class="form-group">
                        <label for="fat_percentage">Lipides (%) *</label>
                        <input type="number" id="fat_percentage" name="fat_percentage" required min="0" max="100" step="0.1"
                               value="<?php echo $_SESSION['old']['fat_percentage'] ?? '30'; ?>"
                               placeholder="30">
                    </div>

                    <?php if (isset($_SESSION['errors']['macros'])): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <?php echo $_SESSION['errors']['macros']; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Macro Calculator -->
                    <div class="card bg-gray-50">
                        <div class="card-header">
                            <h4 class="text-sm font-semibold">Vérification des macronutriments</h4>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-3 gap-4 text-center">
                                <div>
                                    <div id="proteinTotal" class="text-lg font-bold text-blue-600">20%</div>
                                    <div class="text-xs text-gray-600">Protéines</div>
                                </div>
                                <div>
                                    <div id="carbsTotal" class="text-lg font-bold text-green-600">50%</div>
                                    <div class="text-xs text-gray-600">Glucides</div>
                                </div>
                                <div>
                                    <div id="fatTotal" class="text-lg font-bold text-yellow-600">30%</div>
                                    <div class="text-xs text-gray-600">Lipides</div>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <div id="totalPercentage" class="text-xl font-bold">100%</div>
                                <div class="text-xs text-gray-600">Total</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-span-full">
                    <div class="flex space-x-4">
                        <a href="index.php" class="btn btn-outline">
                            <i class="fas fa-arrow-left mr-2"></i>Retour
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Créer le régime
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Macro calculator
        function updateMacroTotals() {
            const protein = parseFloat(document.getElementById('protein_percentage').value) || 0;
            const carbs = parseFloat(document.getElementById('carbs_percentage').value) || 0;
            const fat = parseFloat(document.getElementById('fat_percentage').value) || 0;
            
            const total = protein + carbs + fat;
            
            document.getElementById('proteinTotal').textContent = protein + '%';
            document.getElementById('carbsTotal').textContent = carbs + '%';
            document.getElementById('fatTotal').textContent = fat + '%';
            document.getElementById('totalPercentage').textContent = total + '%';
            
            // Color coding
            const totalElement = document.getElementById('totalPercentage');
            if (Math.abs(total - 100) < 0.1) {
                totalElement.className = 'text-xl font-bold text-green-600';
            } else {
                totalElement.className = 'text-xl font-bold text-red-600';
            }
        }

        // Add event listeners to macro inputs
        ['protein_percentage', 'carbs_percentage', 'fat_percentage'].forEach(id => {
            document.getElementById(id).addEventListener('input', updateMacroTotals);
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', updateMacroTotals);

        // Auto-balance macros
        function balanceMacros(changedField) {
            const protein = parseFloat(document.getElementById('protein_percentage').value) || 0;
            const carbs = parseFloat(document.getElementById('carbs_percentage').value) || 0;
            const fat = parseFloat(document.getElementById('fat_percentage').value) || 0;
            
            const total = protein + carbs + fat;
            
            if (total > 100) {
                const excess = total - 100;
                const otherFields = ['protein_percentage', 'carbs_percentage', 'fat_percentage']
                    .filter(id => id !== changedField);
                
                // Distribute excess proportionally
                const otherTotal = otherFields.reduce((sum, id) => {
                    return sum + (parseFloat(document.getElementById(id).value) || 0);
                }, 0);
                
                if (otherTotal > 0) {
                    otherFields.forEach(id => {
                        const currentValue = parseFloat(document.getElementById(id).value) || 0;
                        const reduction = (currentValue / otherTotal) * excess;
                        document.getElementById(id).value = Math.max(0, currentValue - reduction).toFixed(1);
                    });
                }
            }
            
            updateMacroTotals();
        }

        // Add auto-balance to macro inputs
        ['protein_percentage', 'carbs_percentage', 'fat_percentage'].forEach(id => {
            document.getElementById(id).addEventListener('change', () => balanceMacros(id));
        });
    </script>

    <?php unset($_SESSION['old']); ?>
</body>
</html>

