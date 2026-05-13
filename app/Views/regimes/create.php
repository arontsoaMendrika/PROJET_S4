<?= $this->extend('layouts/elegance') ?>
<?= $this->section('content') ?>
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 style="font-family:'Playfair Display',serif; color:var(--el-black);">Créer un Programme</h2>
        <div style="width: 50px; height: 2px; background-color: var(--el-gold); margin: 10px auto;"></div>
        <p class="text-muted">Élaborez une nouvelle formule nutritionnelle exclusive.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Messages -->
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger rounded-0 border-0 border-start border-4"
                    style="border-color: var(--el-gold) !important;">
                    <i class="fas fa-exclamation-circle me-2"></i><strong>Erreurs de validation:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm rounded-0 p-4" style="background:#fff;">
                <form action="<?= base_url('regimes/store') ?>" method="POST">

                    <h5 class="text-uppercase mb-4 mt-2"
                        style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Informations Générales
                    </h5>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">Nom de la Formule *</label>
                            <input type="text" name="name" class="form-control rounded-0 border-dark" required
                                placeholder="Ex: Keto Premium" value="<?= esc($_SESSION['old']['name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Type de Régime *</label>
                            <select name="regime_type_id" class="form-select rounded-0 border-dark" required>
                                <option value="">Sélectionner une catégorie</option>
                                <?php if (isset($types) && is_array($types)): ?>
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?= esc($type['id']) ?>" <?= (isset($_SESSION['old']['regime_type_id']) && $_SESSION['old']['regime_type_id'] == $type['id']) ? 'selected' : '' ?>>
                                            <?= esc($type['name']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted text-uppercase">Description *</label>
                        <textarea name="description" class="form-control rounded-0 border-dark" rows="4" required
                            placeholder="Description détaillée du programme..."><?= esc($_SESSION['old']['description'] ?? '') ?></textarea>
                    </div>

                    <hr class="text-muted opacity-25 mb-4">
                    <h5 class="text-uppercase mb-4"
                        style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Paramètres
                        Nutritionnels</h5>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">Calories par Jour *</label>
                            <input type="number" name="calories_per_day" class="form-control rounded-0 border-dark"
                                required value="<?= esc($_SESSION['old']['calories_per_day'] ?? '2000') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Durée recommandée (Jours)
                                *</label>
                            <input type="number" name="duration_days" class="form-control rounded-0 border-dark"
                                required value="<?= esc($_SESSION['old']['duration_days'] ?? '30') ?>">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="form-label small text-muted text-uppercase">% Protéines *</label>
                            <input type="number" step="0.01" name="protein_percentage"
                                class="form-control rounded-0 border-dark" required
                                value="<?= esc($_SESSION['old']['protein_percentage'] ?? '30') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small text-muted text-uppercase">% Glucides *</label>
                            <input type="number" step="0.01" name="carbs_percentage"
                                class="form-control rounded-0 border-dark" required
                                value="<?= esc($_SESSION['old']['carbs_percentage'] ?? '50') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small text-muted text-uppercase">% Lipides *</label>
                            <input type="number" step="0.01" name="fat_percentage"
                                class="form-control rounded-0 border-dark" required
                                value="<?= esc($_SESSION['old']['fat_percentage'] ?? '20') ?>">
                        </div>
                    </div>

                    <hr class="text-muted opacity-25 mb-4">
                    <h5 class="text-uppercase mb-4"
                        style="font-size:0.9rem; letter-spacing:1px; color:var(--el-gold-dark);">Aspect Financier</h5>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Prix de base (€) *</label>
                            <div class="input-group rounded-0">
                                <input type="number" step="0.01" name="base_price"
                                    class="form-control rounded-0 border-dark border-end-0" required
                                    value="<?= esc($_SESSION['old']['base_price'] ?? '') ?>">
                                <span
                                    class="input-group-text bg-white border-dark rounded-0 border-start-0 text-muted"><i
                                        class="fas fa-euro-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="<?= base_url('regimes') ?>"
                            class="btn btn-outline-dark rounded-0 py-2 px-4 text-uppercase"
                            style="letter-spacing: 1px; font-size: 0.85rem;">Annuler</a>
                        <button type="submit" class="btn btn-elegant py-2 px-5 text-uppercase"
                            style="letter-spacing: 1px; font-size: 0.85rem;">
                            Enregistrer la formule
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
