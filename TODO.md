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
### Distribution des tâches (proposition corrigée)

Objectif : clarifier les responsabilités pour une organisation efficace et des commits réguliers.

- **Mandresy (ETU004342)** — Front & Auth
    - Authentification (inscription en 2 pages, login, gestion mots de passe)
    - Gestion du profil utilisateur et du profil santé (taille, poids, calcul IMC)
    - Intégration client (HTML/CSS/JS) des formulaires et validation front-end

- **Itokiana (ETU004364)** — Régimes & Recommandation
    - Modélisation des régimes (composition % viande/poisson/volaille)
    - CRUD des régimes et tarification par durée
    - Moteur de recommandation (logique IMC → choix de régime + activité)
    - Jeux de données: préparation des 5 régimes et 5 activités

- **Mendrika (ETU004081)** — Back-Office, Wallet & Export
    - Back office : page admin, tableau de bord, statistiques (graphiques)
    - Gestion du portefeuille : génération/validation des codes et transactions
    - Option Gold : logique remise 15% et activation utilisateur
    - Export PDF des recommandations et préparation du script SQL

- **Tâches transverses (à partager)**
    - Base de données & migrations : créer schéma SQL (collaboration Mandresy+Mendrika)
    - Intégration et AJAX : appels asynchrones (Mandresy + Itokiana)
    - Tests manuels & jeu de données minimal (tous)
    - Documentation & livrables (Google Form, script SQL, lien repo, Google Sheet) (coordonné par Mendrika)

Consignes pratiques :
- Chaque membre doit faire des commits réguliers (au moins 1 commit par jour de travail) et ouvrir des branches de fonctionnalité.
- Faire une merge request vers `main` après revue et tests locaux.
- Indiquer dans le Google Sheet l'avancement (tâches, blocages, temps estimé).

Si vous validez cette répartition, j'applique la version finale dans le TODO et je peux générer une checklist par membre.
        
