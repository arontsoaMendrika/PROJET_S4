<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription - Formulaire UX</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="page">
    <section class="card">
      <h1>Creer un compte</h1>
      <p class="subtitle">Tous les champs marques * sont obligatoires.</p>

      <form id="signup-form" novalidate>
        <fieldset>
          <legend>Informations personnelles</legend>

          <label for="nom">Nom *</label>
          <input type="text" id="nom" name="nom" autocomplete="family-name" required>
          <p class="error" id="error-nom" aria-live="polite"></p>

          <label for="prenom">Prenom *</label>
          <input type="text" id="prenom" name="prenom" autocomplete="given-name" required>
          <p class="error" id="error-prenom" aria-live="polite"></p>

          <label for="naissance">Date de naissance *</label>
          <input type="date" id="naissance" name="naissance" required>
          <p class="error" id="error-naissance" aria-live="polite"></p>
        </fieldset>

        <fieldset>
          <legend>Coordonnees</legend>

          <label for="email">Email *</label>
          <input type="email" id="email" name="email" autocomplete="email" required>
          <p class="error" id="error-email" aria-live="polite"></p>

          <label for="telephone">Telephone *</label>
          <input type="tel" id="telephone" name="telephone" placeholder="032 12 345 67" required>
          <p class="hint">Format accepte: chiffres, espaces, +, -</p>
          <p class="error" id="error-telephone" aria-live="polite"></p>

          <label for="pays">Pays *</label>
          <select id="pays" name="pays" required>
            <option value="">Selectionnez votre pays</option>
            <option value="Madagascar">Madagascar</option>
            <option value="France">France</option>
            <option value="Maurice">Maurice</option>
            <option value="Reunion">La Reunion</option>
          </select>
          <p class="error" id="error-pays" aria-live="polite"></p>
        </fieldset>

        <fieldset>
          <legend>Securite du compte</legend>

          <label for="password">Mot de passe *</label>
          <div class="password-row">
            <input type="password" id="password" name="password" autocomplete="new-password" required>
            <button type="button" id="toggle-password" class="secondary">Afficher</button>
          </div>
          <p class="hint">Minimum 8 caracteres, dont 1 majuscule et 1 chiffre.</p>
          <p class="error" id="error-password" aria-live="polite"></p>


        </fieldset>

        <label class="checkbox-line" for="conditions">
          <input type="checkbox" id="conditions" name="conditions" required>
          J'accepte les conditions d'utilisation *
        </label>
        <p class="error" id="error-conditions" aria-live="polite"></p>

        <div class="actions">
          <button type="submit">Creer mon compte</button>
          <button type="reset" class="secondary">Reinitialiser le formulaire</button>
        </div>

        <p id="global-message" class="global-message" aria-live="polite"></p>
      </form>
    </section>
  </main>

  <script src="script.js"></script>
</body>
</html>
