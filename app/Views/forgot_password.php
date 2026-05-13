<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<main>
    <h1>Réinitialiser le mot de passe</h1>
    <form id="forgot-form" method="post" novalidate>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
      <div style="margin-top:.5rem">
        <button type="submit">Envoyer le lien de réinitialisation</button>
      </div>
    </form>

    <script>
      document.getElementById('forgot-form').addEventListener('submit', function(e){
        const email = document.getElementById('email').value;
        if (!email || !email.includes('@')) { e.preventDefault(); alert('Veuillez saisir un email valide'); }
      });
    </script>
  </main>
<?= $this->endSection() ?>