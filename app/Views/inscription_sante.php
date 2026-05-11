<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription Santé</title>
  <style>label{display:block;margin-top:.5rem} .result{font-weight:bold;margin-top:.5rem}</style>
</head>
<body>
  <main>
    <h1>Informations santé</h1>
    <form id="health-form" action="/register-health" method="post" novalidate>
      <label for="taille">Taille (cm) *</label>
      <input type="number" id="taille" name="taille" min="30" max="300" required>

      <label for="poids">Poids (kg) *</label>
      <input type="number" id="poids" name="poids" min="2" max="500" step="0.1" required>

      <label for="activite">Niveau d'activité</label>
      <select id="activite" name="activite">
        <option value="">--</option>
        <option value="faible">Faible</option>
        <option value="moyen">Moyen</option>
        <option value="eleve">Élevé</option>
      </select>

      <button type="button" id="calc-imc">Calculer IMC</button>
      <p class="result" id="imc-result" aria-live="polite"></p>
    </form>

    <script src="/assets/js/auth.js"></script>
  </main>
</body>
</html>
