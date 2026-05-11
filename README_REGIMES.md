# RégimeVIP - Application de Gestion de Régimes

**Développé par Itokiana ETU004364 - Projet S4 Trinôme**

## Description

RégimeVIP est une application web complète pour la gestion de régimes alimentaires personnalisés avec un système de recommandation intelligent basé sur l'IMC, les objectifs et le profil santé des utilisateurs.

## Fonctionnalités Implémentées

### ✅ Tâches d'Itokiana ETU004364

1. **Structure des régimes en base de données**
   - Tables `regimes`, `regime_types`, `pricing_plans`
   - Tables `activities`, `user_profiles`, `recommendations`
   - Relations et contraintes complètes

2. **CRUD complet des régimes**
   - Création, modification, suppression, consultation
   - Interface d'administration complète
   - Validation des données côté serveur

3. **Tarification des régimes**
   - Plans tarifaires selon la durée
   - Remises automatiques
   - Prix de base et calculs

4. **Moteur de recommandation**
   - Analyse de l'IMC
   - Prise en compte des objectifs utilisateur
   - Score de compatibilité personnalisé

5. **Association recommandations/régimes/activités**
   - Système de matching intelligent
   - 5 régimes pré-configurés
   - 5 activités sportives intégrées

6. **Appels AJAX**
   - Filtrage dynamique
   - Recherche en temps réel
   - Interactions fluides

7. **Cohérence métier**
   - Validation des pourcentages nutritionnels
   - Calculs IMC automatiques
   - Logique de recommandation

## Architecture Technique

### 📁 Structure des Fichiers

```
PROJET_S4/
├── index.php                    # Point d'entrée principal
├── schema_regimes.sql           # Base de données complète
├── includes/
│   └── fonctions.php           # Fonctions métier et utilitaires
├── controllers/
│   └── RegimeController.php    # Contrôleurs MVC
├── views/
│   ├── home.php               # Page d'accueil VIP
│   ├── regimes/
│   │   ├── list.php           # Liste des régimes
│   │   ├── create.php         # Formulaire création
│   │   └── detail.php         # Détail d'un régime
│   ├── recommendations/
│   │   └── form.php           # Générateur de recommandations
│   └── profiles/
│       └── form.php           # Gestion des profils
├── assets/
│   ├── css/
│   │   ├── style.scss         # Styles SCSS
│   │   └── style.css          # Styles compilés
│   └── js/
│       └── app.js             # JavaScript applicatif
└── README_REGIMES.md          # Documentation
```

### 🛠 Technologies Utilisées

- **Backend**: PHP 8.0+ (POO)
- **Base de données**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3/SCSS, JavaScript ES6+
- **Architecture**: MVC (Model-View-Controller)
- **API**: RESTful avec JSON
- **Styling**: SCSS avec variables et mixins
- **JavaScript**: Vanilla JS avec classes ES6

## Installation

### Prérequis

- PHP 8.0 ou supérieur
- MySQL/MariaDB 5.7 ou supérieur
- Serveur web (Apache/Nginx)
- Extension PHP PDO et PDO_MySQL
- Node.js (pour compiler SCSS) ou SASS Ruby

### Étapes d'Installation

1. **Cloner le projet**
   ```bash
   cd /home/sanda/Documents/S4/tri/PROJET_S4
   ```

2. **Configurer la base de données**
   ```sql
   mysql -u root -p < schema_regimes.sql
   ```

3. **Configurer la connexion**
   Éditer `includes/fonctions.php` et modifier les identifiants:
   ```php
   $host = 'localhost';
   $dbname = 'regime';
   $username = 'root';
   $password = ''; // Votre mot de passe
   ```

4. **Compiler les styles SCSS**
   ```bash
   sass assets/css/style.scss assets/css/style.css --style compressed
   ```

5. **Configurer le serveur web**
   - Document root: `PROJET_S4/`
   - Autoriser les `.htaccess` si Apache
   - Configurer les permissions

6. **Accéder à l'application**
   ```
   http://localhost/PROJET_S4/
   ```

## Utilisation

### Pages Principales

1. **Accueil** (`/` ou `/index.php`)
   - Présentation VIP
   - Calculateur IMC
   - Accès rapide aux recommandations

2. **Gestion des Régimes** (`/?page=regimes`)
   - Liste complète des régimes
   - CRUD complet
   - Filtrage et recherche

3. **Générateur de Recommandations** (`/?page=recommendations`)
   - Sélection utilisateur
   - Calcul IMC intégré
   - Recommandations personnalisées

4. **Gestion des Profils** (`/?page=profiles`)
   - Profil utilisateur complet
   - Données santé
   - Objectifs personnels

### Fonctionnalités Clés

#### 🎯 Moteur de Recommandation

Le système analyse:
- **IMC**: Calcul automatique et catégorisation
- **Objectifs**: Perte de poids, prise de masse, maintien, endurance
- **Niveau d'activité**: Sédentaire à extrêmement actif
- **Préférences**: Type de régime, budget, calories

#### 💰 Tarification Dynamique

- Plans 30, 60, 90 jours
- Remises automatiques jusqu'à 25%
- Prix de base par régime
- Indicateurs "POPULAIRE"

#### 🔍 Recherche et Filtrage

- Recherche par nom/description
- Filtre par type de régime
- Filtre par prix maximum
- Filtre par calories maximum

#### 📊 Statistiques

- Nombre total de régimes
- Régimes économiques disponibles
- Options faibles calories
- Plans tarifaires moyens

## Base de Données

### Tables Principales

#### `regimes`
- Informations nutritionnelles complètes
- Macros (protéines, glucides, lipides)
- Prix et durée
- Relations avec types et tarifs

#### `user_profiles`
- Données anthropométriques
- Objectifs et niveau d'activité
- Conditions médicales et allergies

#### `recommendations`
- Scores de compatibilité
- Textes explicatifs personnalisés
- Historique des recommandations

#### `activities`
- 5 activités sportives pré-configurées
- Calories brûlées par heure
- Niveaux d'intensité

### Données Initiales

L'application inclut:
- **5 types de régimes**: Cétogène, Méditerranéen, Végétarien, Vegan, Équilibré
- **5 régimes pré-configurés** avec tarification complète
- **5 activités sportives**: Course, Yoga, Musculation, Natation, Cyclisme
- **Plans tarifaires**: 30/60/90 jours avec remises

## API Endpoints

### GET `/index.php?page=api&action=stats`
Retourne les statistiques générales

### GET `/index.php?page=api&action=search&query=terme`
Recherche de régimes

### POST `/index.php?page=api&action=filter`
Filtrage des régimes avec critères

### POST `/index.php?page=api&action=like`
Enregistrement des "j'aime"

### POST `/index.php?page=api&action=autosave`
Sauvegarde automatique des données

## Personnalisation

### Styles SCSS

Variables principales dans `assets/css/style.scss`:
```scss
$primary-color: #6B46C1;
$secondary-color: #EC4899;
$accent-color: #F59E0B;
```

### Logique Métier

Modifier `includes/fonctions.php`:
- `calculateRecommendationScore()`: Ajuster l'algorithme
- `generateRecommendationText()`: Personnaliser les messages
- `validateRegimeData()`: Ajouter des validations

## Sécurité

- Validation des entrées utilisateur
- Protection XSS avec `htmlspecialchars()`
- Préparation des requêtes SQL avec PDO
- Contrôle d'accès basique par sessions

## Performance

- Compilation SCSS en CSS compressé
- Requêtes SQL optimisées
- JavaScript modulaire et lazy loading
- Mise en cache côté client

## Développement Future

### Améliorations Possibles

1. **Authentification complète**
2. **Système de paiement intégré**
3. **Export PDF des recommandations**
4. **Mobile app (React Native)**
5. **Machine Learning pour les recommandations**
6. **API REST complète**
7. **Tests automatisés**

### Évolution Technique

- Passage à PHP 8.2+
- Framework Symfony/Laravel
- Base de données PostgreSQL
- Dockerisation
- CI/CD avec GitHub Actions

## Support

**Développeur**: Itokiana ETU004364  
**Projet**: S4 Trinome - Mise en place d'une application pour sélectionner un régime alimentaire adapté selon ses objectifs

---

## Licence

Ce projet est réalisé dans le cadre du projet S4 de l'Université.
