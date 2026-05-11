<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RégimeVIP - Votre Programme Personnalisé</title>
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
                <span class="vip-badge">PREMIUM</span>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Accueil</a></li>
                <li><a href="#regimes">Régimes</a></li>
                <li><a href="#recommendations">Recommandations</a></li>
                <li><a href="#bmi">Calcul IMC</a></li>
                <li><a href="#profile">Profil</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="container py-16">
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-4">
                Votre Programme <span class="text-yellow-400">VIP</span>
            </h1>
            <p class="text-xl text-white text-opacity-90 max-w-2xl mx-auto mb-8">
                Découvrez votre régime personnalisé avec notre système de recommandation exclusif par Itokiana ETU004364
            </p>
            <button id="getRecommendation" class="btn btn-gold btn-lg pulse">
                <i class="fas fa-magic mr-3"></i>
                Obtenir Ma Recommandation VIP
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-3 mb-12">
            <div class="card hover-lift text-center">
                <div class="text-4xl mb-3">💎</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">5 Régimes VIP</h3>
                <p class="text-gray-600">Programmes exclusifs personnalisés</p>
            </div>
            <div class="card hover-lift text-center">
                <div class="text-4xl mb-3">🎯</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Recommandation IA</h3>
                <p class="text-gray-600">Analyse intelligente de vos objectifs</p>
            </div>
            <div class="card hover-lift text-center">
                <div class="text-4xl mb-3">⭐</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Accès Premium</h3>
                <p class="text-gray-600">Fonctionnalités exclusives membres</p>
            </div>
        </div>
    </section>

    <!-- Recommendations Section -->
    <section id="recommendations" class="container py-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-4">Recommandations Personnalisées</h2>
            <p class="text-white text-opacity-80">Basées sur votre IMC, vos objectifs et votre profil</p>
        </div>
        
        <div id="recommendationResults" class="grid grid-3">
            <!-- Les recommandations seront chargées ici -->
            <div class="col-span-full text-center py-12">
                <i class="fas fa-magic text-6xl text-white text-opacity-50 mb-4"></i>
                <p class="text-white text-opacity-70">Cliquez sur "Obtenir Ma Recommandation VIP" pour commencer</p>
            </div>
        </div>
    </section>

    <!-- BMI Calculator Section -->
    <section id="bmi" class="container py-16">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="text-3xl font-bold text-gray-800">Calculateur IMC VIP</h2>
                <p class="text-gray-600">Calculez votre Indice de Masse Corporelle</p>
            </div>
            
            <form id="bmiForm" class="grid grid-2 gap-8">
                <div>
                    <div class="form-group">
                        <label for="height">Taille (cm)</label>
                        <input type="number" id="height" name="height" placeholder="170" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Poids (kg)</label>
                        <input type="number" id="weight" name="weight" placeholder="70" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="goal">Objectif</label>
                        <select id="goal" name="goal" required>
                            <option value="weight_loss">Perte de poids</option>
                            <option value="maintenance">Maintien</option>
                            <option value="muscle_gain">Prise de masse</option>
                            <option value="endurance">Endurance</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        <i class="fas fa-calculator mr-2"></i>Calculer mon IMC
                    </button>
                </div>
                <div id="bmiResult" class="flex-center">
                    <div class="text-center">
                        <i class="fas fa-chart-line text-6xl text-purple-600 mb-4"></i>
                        <p class="text-gray-600">Entrez vos informations pour voir votre résultat</p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Featured Regimes -->
    <section id="regimes" class="container py-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-4">Régimes VIP Disponibles</h2>
            <p class="text-white text-opacity-80">Découvrez nos programmes exclusifs</p>
        </div>

        <!-- Search and Filter -->
        <div class="card mb-8">
            <form id="searchForm" class="grid grid-3 gap-4">
                <div class="form-group mb-0">
                    <input type="text" name="query" placeholder="Rechercher un régime...">
                </div>
                <div class="form-group mb-0">
                    <select name="type">
                        <option value="">Tous les types</option>
                        <option value="1">Cétogène</option>
                        <option value="2">Méditerranéen</option>
                        <option value="3">Végétarien</option>
                        <option value="4">Vegan</option>
                        <option value="5">Équilibré</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-search mr-2"></i>Rechercher
                    </button>
                </div>
            </form>
        </div>

        <div id="regimesList" class="grid grid-3">
            <!-- Les régimes seront chargés ici -->
        </div>
    </section>

    <!-- Profile Section -->
    <section id="profile" class="container py-16">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="text-3xl font-bold text-gray-800">Profil Utilisateur</h2>
                <p class="text-gray-600">Complétez votre profil pour des recommandations précises</p>
            </div>

            <form id="profileForm" class="grid grid-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Informations de base</h3>
                    <div class="form-group">
                        <label for="profile-age">Âge</label>
                        <input type="number" id="profile-age" name="age" placeholder="25">
                    </div>
                    <div class="form-group">
                        <label for="profile-gender">Genre</label>
                        <select id="profile-gender" name="gender">
                            <option value="male">Homme</option>
                            <option value="female">Femme</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile-activity">Niveau d'activité</label>
                        <select id="profile-activity" name="activity_level">
                            <option value="sedentary">Sédentaire</option>
                            <option value="lightly_active">Légèrement actif</option>
                            <option value="moderately_active">Modérément actif</option>
                            <option value="very_active">Très actif</option>
                            <option value="extremely_active">Extrêmement actif</option>
                        </select>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Santé et objectifs</h3>
                    <div class="form-group">
                        <label for="profile-objective">Objectif principal</label>
                        <select id="profile-objective" name="objective">
                            <option value="weight_loss">Perte de poids</option>
                            <option value="maintenance">Maintien</option>
                            <option value="muscle_gain">Prise de masse</option>
                            <option value="endurance">Endurance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile-target">Poids cible (kg)</label>
                        <input type="number" id="profile-target" name="target_weight" placeholder="65" step="0.1">
                    </div>
                    <div class="form-group">
                        <label for="profile-medical">Conditions médicales</label>
                        <textarea id="profile-medical" name="medical_conditions" placeholder="Décrivez toute condition médicale pertinente..."></textarea>
                    </div>
                </div>
                <div class="col-span-full">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save mr-2"></i>Sauvegarder mon profil
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content container">
            <div class="flex items-center space-x-2">
                <i class="fas fa-crown text-yellow-400"></i>
                <span class="font-bold">RégimeVIP</span>
                <span class="vip-badge">PREMIUM</span>
            </div>
            <p class="text-white text-opacity-70">© 2024 RégimeVIP - Développé par Itokiana ETU004364</p>
            <div class="flex space-x-4">
                <a href="#" class="text-white text-opacity-70 hover:text-white">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-white text-opacity-70 hover:text-white">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white text-opacity-70 hover:text-white">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Hidden user ID for demo -->
    <input type="hidden" id="userId" value="1">

    <!-- JavaScript -->
    <script src="../assets/js/app.js"></script>
    
    <script>
        // Charger les régimes au chargement de la page
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                // Simuler le chargement des régimes depuis l'API
                const regimes = [
                    {
                        id: 1,
                        name: 'Keto Premium',
                        type_name: 'Cétogène',
                        description: 'Régime cétogène personnalisé pour perte de poids rapide',
                        calories_per_day: 1500,
                        duration_days: 30,
                        protein_percentage: 25,
                        base_price: 49,
                        is_popular: true
                    },
                    {
                        id: 2,
                        name: 'Méditerranéen Classique',
                        type_name: 'Méditerranéen',
                        description: 'Diète méditerranéenne équilibrée pour la santé',
                        calories_per_day: 1800,
                        duration_days: 30,
                        protein_percentage: 18,
                        base_price: 39,
                        is_popular: false
                    },
                    {
                        id: 3,
                        name: 'Végétarien Proteïné',
                        type_name: 'Végétarien',
                        description: 'Régime végétarien riche en protéines végétales',
                        calories_per_day: 1700,
                        duration_days: 30,
                        protein_percentage: 20,
                        base_price: 35,
                        is_popular: false
                    },
                    {
                        id: 4,
                        name: 'Vegan Sportif',
                        type_name: 'Vegan',
                        description: 'Régime vegan optimisé pour les sportifs',
                        calories_per_day: 2000,
                        duration_days: 30,
                        protein_percentage: 22,
                        base_price: 38,
                        is_popular: false
                    },
                    {
                        id: 5,
                        name: 'Balance Complet',
                        type_name: 'Équilibré',
                        description: 'Régime équilibré pour maintien et bien-être',
                        calories_per_day: 1600,
                        duration_days: 30,
                        protein_percentage: 17,
                        base_price: 29,
                        is_popular: false
                    }
                ];

                app.displayRegimes(regimes);
            } catch (error) {
                console.error('Erreur lors du chargement des régimes:', error);
            }
        });

        // Gestion du formulaire de profil
        document.getElementById('profileForm')?.addEventListener('submit', (e) => {
            e.preventDefault();
            app.showNotification('Profil sauvegardé avec succès!', 'success');
        });

        // Smooth scrolling pour les liens de navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
