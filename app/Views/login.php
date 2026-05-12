<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <main class="container" style="padding-top:3rem;padding-bottom:3rem;max-width:640px;">
    <section class="card">
      <div class="card-header">
        <h1>Connexion</h1>
      </div>

      <form id="login-form" action="/login" method="post" novalidate>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" autocomplete="email" required>
        </div>

        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" autocomplete="current-password" required>
        </div>

        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:center;">
          <button type="submit" class="btn">Se connecter</button>
          <a href="/forgot-password" class="btn btn-outline">Mot de passe oublié</a>
          <a href="/register" class="btn btn-secondary">Créer un compte</a>
        </div>
      </form>
    </section>
  </main>

  <script src="/assets/js/auth.js"></script>
</body>
</html>
