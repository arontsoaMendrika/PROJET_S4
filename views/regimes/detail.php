<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Régime - RégimeVIP</title>
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-2xl font-bold text-white"><?php echo htmlspecialchars($regime['name']); ?></h2>
                            <span class="badge badge-primary"><?php echo htmlspecialchars($regime['type_name']); ?></span>
                        </div>
                        <div class="card-body">
                            <p class="text-white text-opacity-80 mb-6"><?php echo nl2br(htmlspecialchars($regime['description'])); ?></p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="stat-card">
                                    <div class="stat-value"><?php echo $regime['duration_days']; ?></div>
                                    <div class="stat-label">Jours</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value"><?php echo $regime['calories_per_day']; ?></div>
                                    <div class="stat-label">Calories/jour</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value"><?php echo number_format($regime['base_price'], 2); ?>€</div>
                                    <div class="stat-label">Prix de base</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value"><?php echo $regime['is_active'] ? 'Actif' : 'Inactif'; ?></div>
                                    <div class="stat-label">Statut</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Répartition macronutriments -->
                    <div class="card mt-6">
                        <div class="card-header">
                            <h3 class="text-xl font-semibold text-white">Répartition des Macronutriments</h3>
                        </div>
                        <div class="card-body">
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-white mb-2">
                                        <span>Protéines</span>
                                        <span><?php echo $regime['protein_percentage']; ?>%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill bg-blue-500" style="width: <?php echo $regime['protein_percentage']; ?>%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-white mb-2">
                                        <span>Glucides</span>
                                        <span><?php echo $regime['carbs_percentage']; ?>%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill bg-green-500" style="width: <?php echo $regime['carbs_percentage']; ?>%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-white mb-2">
                                        <span>Lipides</span>
                                        <span><?php echo $regime['fat_percentage']; ?>%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill bg-yellow-500" style="width: <?php echo $regime['fat_percentage']; ?>%"></div>
                                    </div>
                                </div>
                            </div>
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
                            <a href="edit.php?id=<?php echo $regime['id']; ?>" class="btn btn-primary w-full">
                                <i class="fas fa-edit mr-2"></i>Modifier
                            </a>
                            <a href="#" onclick="confirmDelete(<?php echo $regime['id']; ?>)" class="btn btn-danger w-full">
                                <i class="fas fa-trash mr-2"></i>Supprimer
                            </a>
                        </div>
                    </div>

                    <!-- Plans de tarification -->
                    <?php if (isset($pricingPlans) && !empty($pricingPlans)): ?>
                        <div class="card mt-6">
                            <div class="card-header">
                                <h3 class="text-lg font-semibold text-white">Plans de Tarification</h3>
                            </div>
                            <div class="card-body">
                                <?php foreach ($pricingPlans as $plan): ?>
                                    <div class="pricing-plan">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="font-medium text-white"><?php echo $plan['duration_days']; ?> jours</div>
                                                <div class="text-sm text-white text-opacity-60">
                                                    <?php if ($plan['discount_percentage'] > 0): ?>
                                                        Économisez <?php echo $plan['discount_percentage']; ?>%
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-bold text-yellow-400"><?php echo number_format($plan['price'], 2); ?>€</div>
                                                <?php if ($plan['is_popular']): ?>
                                                    <span class="badge badge-gold text-xs">Populaire</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-white">Confirmer la suppression</h3>
                <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-white text-opacity-80">Êtes-vous sûr de vouloir supprimer ce régime ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="delete.php">
                    <input type="hidden" name="id" id="deleteId">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
