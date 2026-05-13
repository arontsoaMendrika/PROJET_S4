<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center py-4" style="background-color: var(--el-black);">
                    <h2 class="h3 mb-0" style="color: var(--el-gold); font-family: 'Playfair Display', serif;">Mes Informations Santé</h2>
                </div>
                <div class="card-body p-4 p-md-5">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
                    <?php endif; ?>

                    <form id="health-form" action="/register-health" method="post" novalidate>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="taille" class="form-label text-uppercase text-muted" style="font-size: 0.85rem; font-weight: 600;">Taille (cm) *</label>
                                <input type="number" class="form-control form-control-lg rounded-0" id="taille" name="taille" min="30" max="300" required>
                            </div>
                            <div class="col-md-6">
                                <label for="poids" class="form-label text-uppercase text-muted" style="font-size: 0.85rem; font-weight: 600;">Poids (kg) *</label>
                                <input type="number" class="form-control form-control-lg rounded-0" id="poids" name="poids" min="2" max="500" step="0.1" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="activite" class="form-label text-uppercase text-muted" style="font-size: 0.85rem; font-weight: 600;">Niveau d'activité</label>
                            <select class="form-select form-control-lg rounded-0" id="activite" name="activite" required>
                                <option value="" disabled selected>-- Sélectionnez votre niveau --</option>
                                <option value="faible">Sédentaire / Faible</option>
                                <option value="moyen">Modéré (1-3 fois/semaine)</option>
                                <option value="eleve">Élevé (4+ fois/semaine)</option>
                            </select>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="button" id="calc-imc" class="btn btn-outline-elegant py-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Calculer mon IMC</button>
                        </div>

                        <div id="imc-result" class="alert alert-secondary text-center mb-4 d-none" role="alert" style="font-size: 1.1rem;"></div>

                        <div class="d-grid pt-2 border-top">
                            <button type="submit" class="btn btn-elegant btn-lg py-3 mt-4 text-uppercase">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById('calc-imc')?.addEventListener('click', function() {
        const taille = document.getElementById('taille').value;
        const poids = document.getElementById('poids').value;
        const resultDiv = document.getElementById('imc-result');
        if (taille > 0 && poids > 0) {
            const imc = (poids / Math.pow(taille / 100, 2)).toFixed(1);
            resultDiv.classList.remove('d-none');
            resultDiv.innerHTML = '<strong>Votre IMC estimé :</strong> ' + imc;
        } else {
            resultDiv.classList.remove('d-none');
            resultDiv.innerHTML = '<span class="text-danger">Veuillez remplir correctement la taille et le poids.</span>';
        }
    });
</script>
<?= $this->endSection() ?>