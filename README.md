# PROJET S4 - Analyse du Sujet

## 1) Contexte
Ce projet consiste à développer une application qui aide un utilisateur à sélectionner un regime alimentaire adapte a ses objectifs.

L'utilisateur saisit des informations personnelles et de sante (genre, taille, poids), et le systeme calcule et affiche son IMC (Indice de Masse Corporelle).

## 2) Objectif Metier
Construire une plateforme avec:
- Un espace utilisateur (Front Office) pour:
  - s'inscrire, se connecter, completer son profil,
  - choisir un objectif de poids/sante,
  - recevoir des suggestions de regime + activites sportives sur une duree,
  - exporter les recommandations en PDF,
  - gerer un portefeuille via des codes,
  - beneficier d'une option Gold avec remise.
- Un espace administration (Back Office) pour:
  - gerer les donnees (CRUD),
  - piloter les prix selon la duree,
  - valider les codes portefeuille,
  - consulter statistiques/tableau de bord.

## 3) Contraintes Equipe et Livraison
- Groupe de 3 personnes (mixte fille/garcon).
- Date de rendu: lundi 11 mai 2026.
- Livrables attendus:
  - formulaire de livraison Google Forms,
  - lien du code source (GitLab ou GitHub),
  - script SQL de la base,
  - liste des membres du groupe,
  - Google Sheet de suivi des taches.
- Regles Git:
  - commits/push regulierement pendant le projet,
  - la branche `main` est la reference,
  - il faut au moins un merge dans `main`.

## 4) Analyse Fonctionnelle

### 4.1 Front Office (minimum)
1. Inscription et login.
2. Inscription en 2 etapes:
   - page 1: infos utilisateur (nom, email, genre, etc.),
   - page 2: infos sante (taille, poids).
3. Completion/modification du profil utilisateur.
4. Choix d'un objectif parmi:
   - augmenter son poids,
   - reduire son poids,
   - atteindre son IMC ideal.
5. Suggestion de regimes + activites sportives sur une duree.
6. Export PDF des recommandations.
7. Rechargement du portefeuille via un code.
8. Option Gold (paiement unique) avec 15% de remise sur tous les regimes.

### 4.2 Back Office (minimum)
1. Authentification admin au demarrage.
2. Dashboard/statistiques (graphes, tableaux croises).
3. CRUD des regimes.
4. Prix des regimes variable selon la duree.
5. Chaque regime fait varier le poids (gain ou perte) sur une duree.
6. CRUD des activites sportives.
7. Validation des codes de portefeuille utilisateur.
8. CRUD des parametres necessaires.
9. Composition nutritionnelle d'un regime:
   - % viande,
   - % poisson,
   - % volaille.

## 5) Regles Metier a Clarifier (points d'analyse)
Voici les zones qui doivent etre precisees tres tot pour eviter les ambiguities:
1. Formule et seuils IMC:
   - IMC = poids(kg) / (taille(m)^2),
   - categories d'interpretation retenues (maigreur, normal, surpoids, etc.).
2. Logique de recommandation:
   - regles de choix d'un regime selon objectif + IMC,
   - lien entre regime et activites sportives,
   - duree et impact estime sur le poids.
3. Option Gold:
   - prix final propose,
   - duree de validite (a vie ou limitee),
   - methode de paiement (simulee ou reellement integree).
4. Portefeuille/codes:
   - format du code,
   - montant associe,
   - code usage unique,
   - date d'expiration ou non.
5. Export PDF:
   - contenu minimal (profil, IMC, objectif, plan regime/sport, cout).

## 6) Proposition de Modele de Donnees (SQL)
Tables minimales recommandees:
- `users`:
  - id, nom, email, mot_de_passe_hash, genre, role, gold_active, created_at.
- `health_profiles`:
  - id, user_id, taille_cm, poids_kg, imc_courant, updated_at.
- `objectifs`:
  - id, code (`prise`, `perte`, `imc_ideal`), libelle.
- `regimes`:
  - id, nom, description, variation_poids_par_periode, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, actif.
- `regime_tarifs`:
  - id, regime_id, duree_jours, prix.
- `activites_sportives`:
  - id, nom, intensite, description, calories_estimees.
- `recommandations`:
  - id, user_id, objectif_id, regime_id, activite_id, duree_jours, estimation_resultat, cout_total, created_at.
- `wallets`:
  - id, user_id, solde.
- `wallet_codes`:
  - id, code, montant, est_utilise, utilisateur_id, date_utilisation.
- `transactions_wallet`:
  - id, wallet_id, type_transaction (`credit`/`debit`), montant, reference, created_at.

## 7) Parcours Utilisateur Cible
1. Inscription en 2 pages.
2. Connexion.
3. Completion profil sante.
4. Calcul IMC + affichage interpretation.
5. Choix objectif.
6. Suggestion plan (regime + sport + duree + prix).
7. Paiement (wallet) avec remise Gold si active.
8. Export PDF du plan.

## 8) Technologies Imposes
- PHP + Framework CodeIgniter.
- HTML/CSS.
- JavaScript + AJAX.
- Base de donnees MySQL ou PostgreSQL.

## 9) Jeu de Donnees Minimal Requis
- 5 utilisateurs.
- 15 codes portefeuille.
- 5 regimes.
- 5 activites sportives.

## 10) Critere de Reussite (Definition of Done)
Le projet est valide si:
1. Toutes les fonctionnalites minimales Front Office sont operationnelles.
2. Toutes les fonctionnalites minimales Back Office sont operationnelles.
3. Le calcul IMC est correct et exploite pour la recommandation.
4. Le schema SQL est livre et executable.
5. Les donnees minimales de test sont inserees.
6. Le suivi Git montre des commits progressifs + merge dans main.

## 11) Plan de Realisation Recommande
### Phase 1 - Cadrage
- Valider les regles metier manquantes.
- Finaliser MCD/MLD et flux ecrans.

### Phase 2 - Base Technique
- Initialiser projet CodeIgniter.
- Configurer base, migrations, seeders.
- Mettre en place authentification user/admin.

### Phase 3 - Fonctionnel Front
- Inscription 2 etapes + profil.
- Calcul IMC + objectifs.
- Suggestion regime/sport + export PDF.
- Wallet + code + option Gold.

### Phase 4 - Fonctionnel Back
- CRUD regimes/activites/parametres.
- Validation des codes.
- Dashboard statistiques.

### Phase 5 - Stabilisation
- Tests manuels par scenario.
- Correction bugs.
- Preparation livrables finaux.

## 12) Repartition Equipe (suggestion)
- Membre A: authentification, utilisateurs, profils, IMC.
- Membre B: regimes, activites, moteur de recommandation.
- Membre C: back office, dashboard, portefeuille/codes, export PDF.

Chaque membre doit faire des commits reguliers et des merge requests propres.

---

Document d'analyse redige a partir du sujet fourni (`ITU-S4-P18-PROJET.pdf`).
