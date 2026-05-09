<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil utilisateur</title>
  <style>dl{display:grid;grid-template-columns:150px 1fr;gap:.25rem 1rem}</style>
</head>
<body>
  <main>
    <h1>Mon profil</h1>
    <?php if (!empty($flash['error'])): ?>
      <div style="color:#b00"><?= esc($flash['error']) ?></div>
    <?php endif; ?>
    <?php if (!empty($flash['success'])): ?>
      <div style="color:#0a0"><?= esc($flash['success']) ?></div>
    <?php endif; ?>

    <dl>
      <dt>Nom</dt><dd><?= isset($user['full_name']) ? esc($user['full_name']) : '—' ?></dd>
      <dt>Email</dt><dd><?= isset($user['email']) ? esc($user['email']) : '—' ?></dd>
      <dt>Dernier poids (kg)</dt><dd><?= isset($measures['weight_kg']) ? esc($measures['weight_kg']) : '—' ?></dd>
      <dt>Dernier relevé</dt><dd><?= isset($measures['measured_at']) ? esc($measures['measured_at']) : '—' ?></dd>
      <dt>Notes</dt><dd><?= isset($measures['notes']) ? esc($measures['notes']) : '—' ?></dd>
    </dl>
    <p>
      <a href="/register">Éditer profil</a>
      <a href="/register-health" style="margin-left:1rem">Éditer infos santé</a>
    </p>
  </main>
</body>
</html>
