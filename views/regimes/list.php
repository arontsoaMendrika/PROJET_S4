<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Régimes - RégimeVIP</title>
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
                <li><a href="index.php" class="text-yellow-400">Régimes</a></li>
                <li><a href="../recommendations/form.php">Recommandations</a></li>
                <li><a href="../profiles/form.php?user_id=1">Profils</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Gestion des Régimes</h1>
                <p class="text-white text-opacity-80">Administration des programmes nutritionnels</p>
            </div>
            <a href="../index.php?controller=regime&action=create" class="btn btn-gold">
                <i class="fas fa-plus mr-2"></i>Nouveau Régime
            </a>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Search and Filter -->
        <div class="card mb-8">
            <form id="searchForm" class="grid grid-4 gap-4">
                <div class="form-group mb-0">
                    <input type="text" name="query" placeholder="Rechercher un régime..." value="<?php echo $_GET['search'] ?? ''; ?>">
                </div>
                <div class="form-group mb-0">
                    <select name="type">
                        <option value="">Tous les types</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type['id']; ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $type['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($type['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <select name="max_price">
                        <option value="">Prix max</option>
                        <option value="30">€30 max</option>
                        <option value="40">€40 max</option>
                        <option value="50">€50 max</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistics -->
        <div class="grid grid-4 mb-8">
            <div class="card text-center">
                <div class="stat-value"><?php echo count($regimes); ?></div>
                <div class="stat-label">Total Régimes</div>
            </div>
            <div class="card text-center">
                <div class="stat-value"><?php echo count(array_filter($regimes, fn($r) => $r['base_price'] <= 30)); ?></div>
                <div class="stat-label">Régimes Économiques</div>
            </div>
            <div class="card text-center">
                <div class="stat-value"><?php echo count(array_filter($regimes, fn($r) => $r['calories_per_day'] <= 1600)); ?></div>
                <div class="stat-label">Faible Calories</div>
            </div>
            <div class="card text-center">
                <div class="stat-value"><?php echo array_sum(array_column($regimes, 'pricing_count')) / count($regimes); ?></div>
                <div class="stat-label">Plans Tarifaires Moyens</div>
            </div>
        </div>

        <!-- Regimes Table -->
        <div class="card">
            <div class="card-header">
                <h2>Liste des Régimes</h2>
                <p class="text-gray-600"><?php echo count($regimes); ?> régime(s) trouvé(s)</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-3 px-4">Nom</th>
                            <th class="text-left py-3 px-4">Type</th>
                            <th class="text-left py-3 px-4">Calories/jour</th>
                            <th class="text-left py-3 px-4">Macros</th>
                            <th class="text-left py-3 px-4">Prix</th>
                            <th class="text-left py-3 px-4">Durée</th>
                            <th class="text-left py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($regimes as $regime): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div>
                                        <div class="font-semibold"><?php echo htmlspecialchars($regime['name']); ?></div>
                                        <div class="text-sm text-gray-600"><?php echo htmlspecialchars(substr($regime['description'], 0, 50)); ?>...</div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                        <?php echo htmlspecialchars($regime['type_name']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-semibold"><?php echo $regime['calories_per_day']; ?></span> kcal
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        <div>P: <?php echo $regime['protein_percentage']; ?>%</div>
                                        <div>G: <?php echo $regime['carbs_percentage']; ?>%</div>
                                        <div>L: <?php echo $regime['fat_percentage']; ?>%</div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-semibold text-green-600">€<?php echo $regime['base_price']; ?></span>
                                </td>
                                <td class="py-3 px-4">
                                    <?php echo $regime['duration_days']; ?> jours
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2">
                                        <a href="../index.php?controller=regime&action=show&id=<?php echo $regime['id']; ?>" 
                                           class="btn btn-sm btn-outline" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="../index.php?controller=regime&action=edit&id=<?php echo $regime['id']; ?>" 
                                           class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $regime['id']; ?>, '<?php echo htmlspecialchars($regime['name']); ?>')" 
                                                class="btn btn-sm btn-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (empty($regimes)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-utensils text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Aucun régime trouvé</p>
                        <a href="../index.php?controller=regime&action=create" class="btn btn-primary mt-4">
                            <i class="fas fa-plus mr-2"></i>Créer le premier régime
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="card max-w-md w-full mx-4">
            <div class="card-header">
                <h3 class="text-xl font-bold text-red-600">Confirmation de suppression</h3>
            </div>
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer le régime "<span id="deleteRegimeName"></span>" ?</p>
                <p class="text-sm text-gray-600 mt-2">Cette action est réversible (le régime sera désactivé).</p>
            </div>
            <div class="card-footer flex space-x-2">
                <button onclick="closeDeleteModal()" class="btn btn-outline flex-1">Annuler</button>
                <button id="confirmDeleteBtn" class="btn btn-danger flex-1">
                    <i class="fas fa-trash mr-2"></i>Supprimer
                </button>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            document.getElementById('deleteRegimeName').textContent = name;
            document.getElementById('confirmDeleteBtn').onclick = () => deleteRegime(id);
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        function deleteRegime(id) {
            window.location.href = `../index.php?controller=regime&action=delete&id=${id}`;
        }

        // Search functionality
        document.getElementById('searchForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams();
            
            for (let [key, value] of formData.entries()) {
                if (value) params.append(key, value);
            }
            
            window.location.href = '../index.php?' + params.toString();
        });
    </script>
</body>
</html>
