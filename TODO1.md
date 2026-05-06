## Projet Trinome S4 
## Mise en place d’une application pour sélectionner un régime alimentaire adapté selon ses objectifs

### Membre:
    -Mandresy ETU004342
    -Itokiana ETU004364
    -Mendrika ETU004081 

###  Objectifs:
    .Input:
        -entrée des informations : genre,taille,poids
    .Output:
        -affichage indice du poids corporelle

### Technologies utilisées:
    -PHP + codeIgniter
    -html/css
    -js/ajax
    -Base:Mysql

### Restriction des données: (en minimale)
    -5 utilisateurs
    -15 codes
    -5 régimes
    -5 activités sportives 

### Distribution des taches :
### Distribution des tâches (version détaillée)

Objectif : clarifier les responsabilités, découper le travail en sous-tâches concrètes et faciliter les commits réguliers.

- **Mandresy (ETU004342)** — Front & Auth
    - Concevoir les pages d'inscription en 2 étapes avec une expérience utilisateur claire et des champs obligatoires bien définis.
    - Développer le login, la déconnexion et la gestion du mot de passe oublié ou du changement de mot de passe.
    - Mettre en place le profil utilisateur avec les informations de base : nom, genre, taille, poids et objectifs.
    - Intégrer le profil santé et le calcul de l’IMC côté application, avec affichage du résultat et de son interprétation.
    - Réaliser les formulaires HTML/CSS/JS, les validations front-end et les messages d’erreur associés.
    - Brancher les appels AJAX liés à l’authentification et à la mise à jour des données utilisateur.
    - Prévoir les tests fonctionnels sur les formulaires, les cas d’erreur et la navigation entre les pages.

- **Itokiana (ETU004364)** — Régimes & Recommandation
    - Concevoir la structure des régimes en base de données : nom, description, composition nutritionnelle et durée.
    - Développer le CRUD complet des régimes : création, modification, suppression, consultation et affichage détaillé.
    - Définir la tarification des régimes selon la durée choisie et les règles de calcul associées.
    - Implémenter le moteur de recommandation à partir de l’IMC, de l’objectif de l’utilisateur et du profil santé.
    - Associer chaque recommandation à un régime adapté et à une activité sportive cohérente.
    - Préparer les 5 régimes et les 5 activités sportives demandés pour le jeu de données minimal.
    - Gérer les appels AJAX pour le filtrage, la recherche et l’affichage dynamique des recommandations.
    - Vérifier la cohérence métier entre les valeurs IMC, les objectifs et les régimes proposés.

- **Mendrika (ETU004081)** — Back-Office, Wallet & Export
    - Concevoir la page administrateur et le tableau de bord de suivi du projet avec les informations principales.
    - Mettre en place les statistiques de base et les graphiques utiles pour visualiser l’activité et les données du système.
    - Développer la gestion du portefeuille : génération des codes, validation des codes et suivi des transactions.
    - Implémenter la logique Gold avec remise de 15 % et activation d’un utilisateur après validation du paiement.
    - Préparer l’export PDF des recommandations avec les informations essentielles : profil, IMC, objectif, régime et activité.
    - Rédiger et maintenir le script SQL de création et de peuplement de la base de données.
    - Centraliser la documentation finale et les livrables à remettre.
    - Vérifier le bon fonctionnement du back-office avec des tests de validation sur les données saisies.

- **Tâches transverses (à partager)**
    - Concevoir le schéma global de la base de données et les migrations initiales avec validation croisée.
    - Vérifier l’intégration entre le front, les contrôleurs, la base de données et les traitements AJAX.
    - Créer et tester le jeu de données minimal : 5 utilisateurs, 15 codes, 5 régimes et 5 activités sportives.
    - Réaliser les tests manuels de bout en bout sur l’inscription, l’IMC, la recommandation, le wallet et l’espace admin.
    - Mettre à jour la documentation de projet, le Google Sheet de suivi et les livrables demandés.
    - Organiser les branches de fonctionnalité et les merge requests avant l’intégration finale dans `main`.

Consignes pratiques :
- Chaque membre doit faire des commits réguliers (au moins 1 commit par jour de travail) et ouvrir des branches de fonctionnalité.
- Faire une merge request vers `main` après revue et tests locaux.
- Indiquer dans le Google Sheet l'avancement (tâches, blocages, temps estimé).

Si vous validez cette répartition, j'applique la version finale dans le TODO et je peux générer une checklist par membre.