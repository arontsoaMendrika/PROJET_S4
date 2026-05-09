<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion</title>
  <style>label{display:block;margin-top:.5rem}</style>
</head>
<body>
  <main>
    <h1>Connexion</h1>
    <form id="login-form" method="post" novalidate>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password" required>

      <div style="margin-top:.5rem">
        <button type="submit">Se connecter</button>
        <a href="/forgot-password" style="margin-left:1rem">Mot de passe oublié</a>
      </div>
    </form>

    <script>
      document.getElementById('login-form').addEventListener('submit', function(e){
        // Placeholder: client-side validation
        const email = document.getElementById('email').value;
        if (!email || !email.includes('@')) { e.preventDefault(); alert('Veuillez saisir un email valide'); }
      });
    </script>
  </main>
</body>
</html>
