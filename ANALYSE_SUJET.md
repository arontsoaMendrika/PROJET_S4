# Analyse du sujet - Projet S4

## Resume
Le projet consiste a developper une application qui recommande un regime alimentaire adapte selon les objectifs de l'utilisateur.

L'utilisateur renseigne ses informations (genre, taille, poids), l'application calcule son IMC, puis propose un regime et une activite sportive sur une duree definie.

## Fonctionnalites Front Office (minimum)
- Inscription + connexion.
- Inscription en 2 pages:
  - infos utilisateur (nom, email, genre, etc.)
  - infos sante (taille, poids)
- Completion du profil.
- Choix d'objectif:
  - augmenter le poids
  - reduire le poids
  - atteindre l'IMC ideal
- Suggestion regime + activite sportive selon une duree.
- Export PDF des recommandations.
- Rechargement du portefeuille via un code.
- Option Gold (paiement unique) avec 15% de remise sur tous les regimes.

## Fonctionnalites Back Office (minimum)
- Authentification admin.
- Tableau de bord avec statistiques (graphes, tableaux croises).
- CRUD des regimes.
- Prix des regimes variable selon la duree.
- CRUD des activites sportives.
- Validation des codes de portefeuille.
- CRUD des parametres.
- Composition obligatoire d'un regime:
  - % viande
  - % poisson
  - % volaille

## Contraintes techniques
- PHP + CodeIgniter
- HTML / CSS
- JavaScript + AJAX
- MySQL ou PostgreSQL

## Donnees minimales
- 5 utilisateurs
- 15 codes portefeuille
- 5 regimes
- 5 activites sportives

## Livrables
- Formulaire de livraison Google Forms
- Lien du code source (GitLab/GitHub)
- Script SQL de la base
- Liste des membres du groupe
- Google Sheet de suivi des taches

## Regles Git
- Commits et push reguliers tout au long du projet
- `main` est la branche de reference
- Au moins un merge dans `main`

## Echeance
- Lundi 11 mai 2026
