// Application JavaScript pour Régimes - Itokiana ETU004364

class RegimeApp {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
        this.initAnimations();
        this.loadInitialData();
    }

    bindEvents() {
        // Formulaire de calcul IMC
        const bmiForm = document.getElementById('bmiForm');
        if (bmiForm) {
            bmiForm.addEventListener('submit', (e) => this.calculateBMI(e));
        }

        // Bouton de recommandation
        const recommendBtn = document.getElementById('getRecommendation');
        if (recommendBtn) {
            recommendBtn.addEventListener('click', () => this.getRecommendation());
        }

        // Formulaire de recherche
        const searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => this.searchRegimes(e));
        }

        // Filtres
        const filterForm = document.getElementById('filterForm');
        if (filterForm) {
            filterForm.addEventListener('change', () => this.filterRegimes());
        }

        // Boutons "J'aime"
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-like')) {
                this.likeRegime(e.target);
            }
        });

        // Sauvegarde automatique
        const autoSaveElements = document.querySelectorAll('[data-autosave]');
        autoSaveElements.forEach(element => {
            element.addEventListener('change', () => this.autoSave(element));
        });
    }

    initAnimations() {
        // Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });
    }

    async loadInitialData() {
        try {
            // Charger les statistiques
            await this.loadStats();
            
            // Charger les recommandations récentes
            await this.loadRecentRecommendations();
        } catch (error) {
            console.error('Erreur lors du chargement initial:', error);
        }
    }

    async calculateBMI(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);
        
        // Validation client
        if (!data.height || !data.weight) {
            this.showNotification('Veuillez remplir tous les champs', 'error');
            return;
        }

        const height = parseFloat(data.height);
        const weight = parseFloat(data.weight);

        if (height <= 0 || weight <= 0) {
            this.showNotification('Les valeurs doivent être positives', 'error');
            return;
        }

        // Calcul IMC
        const bmi = weight / Math.pow(height / 100, 2);
        const category = this.getBMICategory(bmi);

        // Afficher le résultat
        this.displayBMIResult(bmi, category, data.goal);

        // Animation
        const resultDiv = document.getElementById('bmiResult');
        resultDiv.classList.add('pulse');
        setTimeout(() => resultDiv.classList.remove('pulse'), 2000);
    }

    displayBMIResult(bmi, category, goal) {
        const resultDiv = document.getElementById('bmiResult');
        const categoryColors = {
            'Insuffisance pondérale': 'underweight',
            'Poids normal': 'normal',
            'Surpoids': 'overweight',
            'Obésité': 'obese'
        };

        resultDiv.innerHTML = `
            <div class="bmi-calculator ${categoryColors[category]}">
                <div class="bmi-value">${bmi.toFixed(1)}</div>
                <div class="bmi-category">${category}</div>
                <div class="bmi-goal">Objectif: ${this.getGoalLabel(goal)}</div>
                <button class="btn btn-primary btn-lg" onclick="app.getRecommendation()">
                    <i class="fas fa-magic"></i> Obtenir ma recommandation
                </button>
            </div>
        `;
    }

    getBMICategory(bmi) {
        if (bmi < 18.5) return 'Insuffisance pondérale';
        if (bmi < 25) return 'Poids normal';
        if (bmi < 30) return 'Surpoids';
        return 'Obésité';
    }

    getGoalLabel(goal) {
        const labels = {
            'weight_loss': 'Perte de poids',
            'muscle_gain': 'Prise de masse',
            'maintenance': 'Maintien',
            'endurance': 'Endurance'
        };
        return labels[goal] || goal;
    }

    async getRecommendation() {
        const userId = document.getElementById('userId')?.value || 1;
        const button = document.getElementById('getRecommendation');
        
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Analyse en cours...';
        }

        try {
            const response = await fetch('index.php?controller=recommendation&action=generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId })
            });

            const data = await response.json();

            if (data.success) {
                this.displayRecommendations(data.recommendations);
                this.showNotification('Recommandations générées avec succès', 'success');
            } else {
                this.showNotification(data.error || 'Erreur lors de la génération', 'error');
            }
        } catch (error) {
            console.error('Erreur:', error);
            this.showNotification('Erreur de connexion au serveur', 'error');
        } finally {
            if (button) {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-magic"></i> Obtenir ma recommandation';
            }
        }
    }

    displayRecommendations(recommendations) {
        const container = document.getElementById('recommendationResults');
        
        if (!container) return;

        container.innerHTML = recommendations.map((rec, index) => `
            <div class="recommendation-card hover-lift" style="animation-delay: ${index * 0.1}s">
                <div class="match-score">${rec.score}%</div>
                <h3 class="regime-title">${rec.regime.name}</h3>
                <div class="regime-type">${rec.regime.type_name}</div>
                <p class="recommendation-text">${rec.recommendation_text}</p>
                
                <div class="regime-stats">
                    <div class="stat">
                        <div class="stat-value">${rec.regime.calories_per_day}</div>
                        <div class="stat-label">Calories/jour</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">${rec.regime.protein_percentage}%</div>
                        <div class="stat-label">Protéines</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">€${rec.regime.base_price}</div>
                        <div class="stat-label">Prix/mois</div>
                    </div>
                </div>

                <div class="regime-actions">
                    <button class="btn btn-outline btn-like" data-regime-id="${rec.regime.id}">
                        <i class="fas fa-heart"></i> J'aime
                    </button>
                    <button class="btn btn-primary" onclick="app.selectRegime(${rec.regime.id})">
                        <i class="fas fa-check"></i> Choisir
                    </button>
                </div>
            </div>
        `).join('');

        // Animation d'entrée
        container.querySelectorAll('.recommendation-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    async searchRegimes(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const query = formData.get('query');

        if (!query.trim()) {
            this.showNotification('Veuillez entrer un terme de recherche', 'warning');
            return;
        }

        try {
            const response = await fetch(`index.php?controller=regime&action=search&query=${encodeURIComponent(query)}`);
            const data = await response.json();

            if (data.success) {
                this.displayRegimes(data.regimes);
                this.showNotification(`${data.regimes.length} régime(s) trouvé(s)`, 'success');
            } else {
                this.showNotification(data.error || 'Erreur de recherche', 'error');
            }
        } catch (error) {
            console.error('Erreur:', error);
            this.showNotification('Erreur de connexion', 'error');
        }
    }

    async filterRegimes() {
        const formData = new FormData(document.getElementById('filterForm'));
        const filters = Object.fromEntries(formData);

        try {
            const response = await fetch('index.php?controller=regime&action=filter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(filters)
            });

            const data = await response.json();

            if (data.success) {
                this.displayRegimes(data.regimes);
            } else {
                this.showNotification(data.error || 'Erreur de filtrage', 'error');
            }
        } catch (error) {
            console.error('Erreur:', error);
            this.showNotification('Erreur de connexion', 'error');
        }
    }

    displayRegimes(regimes) {
        const container = document.getElementById('regimesList');
        
        if (!container) return;

        if (regimes.length === 0) {
            container.innerHTML = `
                <div class="col-span-full text-center py-8">
                    <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Aucun régime trouvé</p>
                </div>
            `;
            return;
        }

        container.innerHTML = regimes.map(regime => `
            <div class="regime-card hover-lift">
                ${regime.is_popular ? '<div class="regime-badge">POPULAIRE</div>' : ''}
                <h3 class="regime-title">${regime.name}</h3>
                <div class="regime-type">${regime.type_name}</div>
                <p class="regime-description">${regime.description}</p>
                
                <div class="regime-stats">
                    <div class="stat">
                        <div class="stat-value">${regime.calories_per_day}</div>
                        <div class="stat-label">Calories/jour</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">${regime.duration_days}</div>
                        <div class="stat-label">Jours</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">${regime.protein_percentage}%</div>
                        <div class="stat-label">Protéines</div>
                    </div>
                </div>

                <div class="regime-price">€${regime.base_price}/mois</div>

                <div class="regime-actions">
                    <button class="btn btn-outline btn-like" data-regime-id="${regime.id}">
                        <i class="fas fa-heart"></i> J'aime
                    </button>
                    <button class="btn btn-primary" onclick="app.viewRegime(${regime.id})">
                        <i class="fas fa-eye"></i> Voir
                    </button>
                </div>
            </div>
        `).join('');
    }

    likeRegime(button) {
        const regimeId = button.dataset.regimeId;
        const icon = button.querySelector('i');
        
        // Toggle animation
        icon.classList.toggle('fas');
        icon.classList.toggle('far');
        button.classList.toggle('btn-secondary');
        
        // Animation du cœur
        icon.style.transform = 'scale(1.3)';
        setTimeout(() => {
            icon.style.transform = 'scale(1)';
        }, 200);

        // Sauvegarder le like (simulation)
        this.saveLike(regimeId);
        
        const regimeName = button.closest('.regime-card').querySelector('.regime-title').textContent;
        this.showNotification(`Vous aimez ${regimeName}! ❤️`, 'success');
    }

    async saveLike(regimeId) {
        try {
            await fetch('index.php?controller=regime&action=like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ regime_id: regimeId })
            });
        } catch (error) {
            console.error('Erreur lors de la sauvegarde du like:', error);
        }
    }

    selectRegime(regimeId) {
        this.showNotification('Régime sélectionné! Redirection...', 'success');
        setTimeout(() => {
            window.location.href = `index.php?controller=regime&action=show&id=${regimeId}`;
        }, 1500);
    }

    viewRegime(regimeId) {
        window.location.href = `index.php?controller=regime&action=show&id=${regimeId}`;
    }

    async autoSave(element) {
        const data = {
            field: element.dataset.autosave,
            value: element.value
        };

        try {
            await fetch('index.php?action=autosave', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });
        } catch (error) {
            console.error('Erreur lors de la sauvegarde automatique:', error);
        }
    }

    async loadStats() {
        try {
            const response = await fetch('index.php?action=stats');
            const data = await response.json();
            
            if (data.success) {
                this.updateStats(data.stats);
            }
        } catch (error) {
            console.error('Erreur lors du chargement des statistiques:', error);
        }
    }

    updateStats(stats) {
        // Mettre à jour les éléments statistiques
        Object.keys(stats).forEach(key => {
            const element = document.getElementById(`stat-${key}`);
            if (element) {
                element.textContent = stats[key];
            }
        });
    }

    async loadRecentRecommendations() {
        // Charger les recommandations récentes pour l'affichage
        try {
            const response = await fetch('index.php?action=recent_recommendations');
            const data = await response.json();
            
            if (data.success) {
                // Afficher les recommandations récentes
                console.log('Recommandations récentes:', data.recommendations);
            }
        } catch (error) {
            console.error('Erreur lors du chargement des recommandations récentes:', error);
        }
    }

    showNotification(message, type = 'info') {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} notification`;
        notification.innerHTML = `
            <i class="fas fa-${this.getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button class="close-btn" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

        // Style
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideIn 0.3s ease;
        `;

        document.body.appendChild(notification);

        // Auto-suppression après 5 secondes
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }

    getNotificationIcon(type) {
        const icons = {
            'success': 'check-circle',
            'error': 'exclamation-circle',
            'warning': 'exclamation-triangle',
            'info': 'info-circle'
        };
        return icons[type] || 'info-circle';
    }
}

// Ajouter les animations CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes animateIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: animateIn 0.5s ease forwards;
    }

    .notification .close-btn {
        background: none;
        border: none;
        margin-left: 1rem;
        cursor: pointer;
        opacity: 0.7;
    }

    .notification .close-btn:hover {
        opacity: 1;
    }
`;
document.head.appendChild(style);

// Initialiser l'application
let app;
document.addEventListener('DOMContentLoaded', () => {
    app = new RegimeApp();
});

// Exporter pour utilisation globale
window.RegimeApp = RegimeApp;
window.app = app;
